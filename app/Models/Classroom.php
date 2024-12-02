<?php

namespace App\Models;

use App\Enums\ThemeTypes;
use App\Enums\UserRole;
use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Nette\Utils\Random;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;
    const DISK = 'public';
    protected $fillable = [
        'name',
        'code',
        'section',
        'room',
        'subject',
        'cover_image_path',
        'theme',
        'status',
        'user_id',
    ];
    protected $casts = [
        'theme' => ThemeTypes::class
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at',
        'cover_image_path',
        'user_id',
    ];
    protected $appends = [
        'join_student_link',
        'classroom_cover_image',
    ];
    protected static function booted(): void
    {
        static::creating(function (Classroom $classroom) {
            $classroom->code = Random::generate(8);
            // $classroom->cover_image_path = asset('assets/images/img_code.jpg');
            $classroom->user_id = Auth::id();
        });
        static::addGlobalScope(new UserClassroomScope);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'unKnow'
        ]);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'classroom_user', 'classroom_id', 'user_id', 'id', 'id')->withPivot(['user_id'])->using(ClassroomUser::class);
    }
    public function teachers(): BelongsToMany
    {
        return $this->users()->wherePivot('role', UserRole::TEACHER->value);
    }
    public function students(): BelongsToMany
    {
        return $this->users()->wherePivot('role', UserRole::STUDENT->value);
    }
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }
    public function classworks(): HasMany
    {
        return $this->hasMany(Classwork::class, 'classroom_id');
    }
    protected function classroomCoverImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->cover_image_path) {
                    // dd('assets/images/img_code.jpg');
                    return asset('assets/images/img_code.jpg');
                }
                return Storage::disk('public')->url($this->cover_image_path);
            }
        );
    }
    protected function joinStudentLink(): Attribute
    {
        return Attribute::make(
            get: fn () => URL::signedRoute('classroom.join', $this->id),
        );
    }
    protected function joinTeacherLink(): Attribute
    {
        // dd(URL::signedRoute('classroom.join', ['classroom' => $this->id, 'role' => UserRole::TEACHER->value]));
        return Attribute::make(
            get: fn () => URL::signedRoute('classroom.join', ['classroom' => $this->id, 'role' => UserRole::TEACHER->value]),
        );
    }
}

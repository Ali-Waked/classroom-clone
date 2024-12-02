<?php

namespace App\Models;

use App\Enums\GenderType;
use App\Enums\ThemeTypes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'locale',
        'timezone',
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'avatar',
        'recive_email_notification',
        'recive_sms_notification',
        'recive_broadcast_notification',
    ];
    // protected static function booted(): void
    // {
    //     static::creating(function (Profile $profile) {
    //         $profile->user_id = Auth::id();
    //     });
    // }
    protected $casts = [
        'birthday' => 'datetime',
        'gender' => GenderType::class,
        'recive_email_notification' => 'boolean',
        'recive_sms_notification' => 'boolean',
        'recive_broadcast_notification' => 'boolean',
    ];
    protected function logoImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->avatar) {
                    return "https://ui-avatars.com/api/?name={$this->first_name}+{$this->last_name}";
                }
                return Storage::disk('public')->url($this->avatar);
            }
        );
    }
}

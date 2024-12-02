<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Classroom;
use App\Models\ClassroomUser;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClassroomService
{
    /**
     * Create New Classroom
     *
     * @param array $data
     * @return Classroom
     * @throws Exception 
     */
    public function createClassroom(array $data): Classroom
    {
        DB::beginTransaction();
        try {
            $classroom = Classroom::create($data);
            ClassroomUser::create([
                'role' => UserRole::TEACHER->value,
                'classroom_id' => $classroom->id,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $classroom;
    }

    /**
     * Update Classroom
     *
     * @param Classroom $classroom
     * @param array $data
     * @return boolean
     */
    public function updateClassroom(Classroom $classroom, array $data): bool
    {
        return $classroom->update($data);
    }

    /**
     * Delete Classroom
     *
     * @param Classroom $classroom
     * @return boolean
     */
    public function deleteClassroom(Classroom $classroom): bool
    {
        return $classroom->delete();
    }

    /**
     * Restore Deleted Classroom
     *
     * @param string $classroom
     * @return Classroom
     */
    public function restoreClassroom(string $classroom): Classroom
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($classroom);
        $classroom->restore();
        return $classroom;
    }
    /**
     * Force Deleting Classsroom And Can't Restore
     *
     * @param string $classroom
     * @return Classroom
     */
    public function forceDelteClassroom(string $classroom): Classroom
    {
        $classroom  = Classroom::withTrashed()->findOrFail($classroom);
        $classroom->forceDelete();
        return $classroom;
    }

    /**
     * Update Customise Apperance Classroom
     *
     * @param Classroom $classroom
     * @param array $data
     * @return void
     */
    public function UpdateCustomiseApperanceClassroom(Classroom $classroom, array $data): void
    {
        $path = $classroom->cover_image_path;
        if (Arr::exists($data, 'upload-photo')) {
            $data['cover_image_path'] = Storage::disk(Classroom::DISK)->append('/classroom-cover-image', $data['upload-photo']);
        }
        $bool = $classroom->update($data);
        if ($path && isset($data['cover_image_path'])) {
            Storage::disk('public')->delete($path);
        }
    }
}

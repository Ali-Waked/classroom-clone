<?php

namespace App\Actions\Profiles;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateMyProfile
{
    /**
     * Update My Profile
     *
     * @param array $data
     * @return void
     */
    public function handle(array $data): void
    {
        $user = Auth::user();
        $profile = $user->profile;
        $avatar = $user->profile->avatar;
        if ($exists_avatar = Arr::exists($data, 'avatar')) {
            $data['avatar'] = Storage::disk('public')->append('/avatar', $data['avatar']);
        }
        $profile->update($data);
        if ($avatar && $exists_avatar) {
            Storage::disk('public')->delete($avatar);
        }
    }
}

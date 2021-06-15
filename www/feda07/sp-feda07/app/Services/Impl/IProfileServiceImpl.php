<?php


namespace App\Services\Impl;


use App\Models\User;
use App\Services\IProfileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class IProfileServiceImpl implements IProfileService
{

    public function updateProfile(int $id, ?string $name, ?string $surname, ?string $phone, ?string $aboutMe, ?UploadedFile $avatar): User
    {
        $user = User::query()->find($id);
        if (isset($name))
            $user->name = $name;
        if (isset($surname))
            $user->surname = $surname;
        if (isset($phone))
            $user->phone = $phone;
        if (isset($aboutMe))
            $user->about_me = $aboutMe;
        if (isset($avatar)) {
            if (isset($user->avatar)) {
                File::delete(public_path('images/' . $user->avatar));
            }
            $avatarName = 'avatar_' . $id . '.' . $avatar->extension();
            $avatar->move(public_path('images'), $avatarName);
            $user->avatar = 'images/' . $avatarName;
        }

        $user->save();
        return $user;
    }
}

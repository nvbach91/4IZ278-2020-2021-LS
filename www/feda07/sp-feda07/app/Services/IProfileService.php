<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Http\UploadedFile;

interface IProfileService
{
    public function updateProfile(int $id, ?string $name, ?string $surname, ?string $phone, ?string $aboutMe, ?UploadedFile $avatar): User;
}

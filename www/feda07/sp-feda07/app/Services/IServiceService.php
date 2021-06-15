<?php


namespace App\Services;


use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

interface IServiceService
{
    public function searchService(string $query): LengthAwarePaginator;

    public function getListOfServicesOfLoginUser(): LengthAwarePaginator;

    public function saveNewService(string $name, string $description, int $duration);

    public function getById(int $id): Service;


    public function getOpeningHours(int $id): array;


}

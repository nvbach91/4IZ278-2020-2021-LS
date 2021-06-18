<?php


namespace App\Services;


use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

interface IServiceService
{
    /**
     * @param string $query
     * @return LengthAwarePaginator
     */
    public function searchService(string $query): LengthAwarePaginator;

    /**
     * @return LengthAwarePaginator
     */
    public function getListOfServicesOfLoginUser(): LengthAwarePaginator;

    /**
     * @param string $name
     * @param string $description
     * @param int $duration
     * @param array $openingHours
     * @return mixed
     */
    public function saveNewService(string $name, string $description, int $duration, array $openingHours);

    /**
     * @param int $id
     * @return Service
     */
    public function getById(int $id): Service;

    /**
     * @param int $id
     * @return array
     */
    public function getOpeningHours(int $id): array;

    /**
     * @param int $id
     */
    public function deleteService(int $id): void;

}

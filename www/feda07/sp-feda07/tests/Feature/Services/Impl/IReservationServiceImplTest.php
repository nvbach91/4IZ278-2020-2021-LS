<?php

namespace Services\Impl;

use App\Models\OpeningHours;
use App\Models\Service;
use App\Models\User;
use App\Services\Impl\IReservationServiceImpl;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class IReservationServiceImplTest extends TestCase
{

    use RefreshDatabase;

    private $serviceImpl;

    public function testGetListOfAllReservationsWithOccupation()
    {
        //set up
        $this->serviceImpl =  $this->serviceImpl = new IReservationServiceImpl;
        $user = User::query()->create([
            'name' => 'Alexandra',
            'surname' => 'Fedina',
            'email' => 'feda07@gmail.com',
            'phone' => '+420987654321',
            'password' => 'password',
        ]);
        $service = $user->services()->create([
            "name" => "name 13",
            "description" => "description",
            "duration" => 15,

        ]);
        $user->services()->create([
            "name" => "nsme",
            "description" => "description",
            "duration" => 15,

        ]);

        $openningHours = OpeningHours::query()->create([
            "time_from" => Carbon::create(2021, 6, 14, 10),
            "time_to" => Carbon::create(2021, 6, 14, 10, 30),
            "day" => Carbon::MONDAY,
            "service_id" => $service->id,
        ]);

        // call
        $data = $this->serviceImpl->getListOfAllReservationsWithOccupation($service->id, Carbon::create(2021, 6, 14));

        // control
        self::assertCount(2, $data);

        self::assertEquals(Carbon::create(2021, 6, 14, 10,0,0), $data[0]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 10,15,0), $data[0]->to);
        self::assertFalse($data[0]->isOccupated);

        self::assertEquals(Carbon::create(2021, 6, 14, 10,15,0), $data[1]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 10,30,0), $data[1]->to);
        self::assertFalse($data[1]->isOccupated);

    }

    public function testGetListOfAllReservationsWhereMoreOpeningHoursThanOne()
    {
        //set up
        $this->serviceImpl = $this->serviceImpl = new IReservationServiceImpl;
        $user = User::query()->create([
            'name' => 'Alexandra',
            'surname' => 'Fedina',
            'email' => 'feda07@gmail.com',
            'phone' => '+420987654321',
            'password' => 'password',
        ]);
        $service = $user->services()->create([
            'name' => 'name 13',
            'description' => 'description',
            'duration' => 15,

        ]);
        $user->services()->create([
            'name' => 'nsme',
            'description' => 'description',
            'duration' => 15,

        ]);

        $openningHours = OpeningHours::query()->create([
            'time_from' => Carbon::create(2021, 6, 14, 10),
            'time_to' => Carbon::create(2021, 6, 14, 10, 30),
            'day' => Carbon::MONDAY,
            'service_id' => $service->id,
        ]);

        $openningHours = OpeningHours::query()->create([
            'time_from' => Carbon::create(2021, 6, 14, 13),
            'time_to' => Carbon::create(2021, 6, 14, 13, 30),
            'day' => Carbon::MONDAY,
            'service_id' => $service->id,
        ]);

        // call
        $data = $this->serviceImpl->getListOfAllReservationsWithOccupation($service->id, Carbon::create(2021, 6, 14));

        // control
        self::assertCount(4, $data);

        self::assertEquals(Carbon::create(2021, 6, 14, 10, 0, 0), $data[0]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 10, 15, 0), $data[0]->to);
        self::assertFalse($data[0]->isOccupated);

        self::assertEquals(Carbon::create(2021, 6, 14, 10, 15, 0), $data[1]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 10, 30, 0), $data[1]->to);
        self::assertFalse($data[1]->isOccupated);

        self::assertEquals(Carbon::create(2021, 6, 14, 13, 0, 0), $data[2]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 13, 15, 0), $data[2]->to);
        self::assertFalse($data[2]->isOccupated);

        self::assertEquals(Carbon::create(2021, 6, 14, 13, 15, 0), $data[3]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 13, 30, 0), $data[3]->to);
        self::assertFalse($data[3]->isOccupated);


    }

    public function testGetListOfAllReservationsWhereFreeDay()
    {
        //set up
        $this->serviceImpl = $this->serviceImpl = new IReservationServiceImpl;
        $user = User::query()->create([
            'name' => 'Alexandra',
            'surname' => 'Fedina',
            'email' => 'feda07@gmail.com',
            'phone' => '+420987654321',
            'password' => 'password',
        ]);
        $service = $user->services()->create([
            'name' => 'name 13',
            'description' => 'description',
            'duration' => 15,

        ]);
        $user->services()->create([
            'name' => 'nsme',
            'description' => 'description',
            'duration' => 15,

        ]);

        $openningHours = OpeningHours::query()->create([
            'time_from' => Carbon::create(2021, 6, 14, 10),
            'time_to' => Carbon::create(2021, 6, 14, 10, 30),
            'day' => Carbon::MONDAY,
            'service_id' => $service->id,
        ]);

        $openningHours = OpeningHours::query()->create([
            'time_from' => Carbon::create(2021, 6, 14, 13),
            'time_to' => Carbon::create(2021, 6, 14, 13, 30),
            'day' => Carbon::MONDAY,
            'service_id' => $service->id,
        ]);

        // call
        $data = $this->serviceImpl->getListOfAllReservationsWithOccupation($service->id, Carbon::create(2021, 6, 15));

        // control
        self::assertCount(0, $data);

    }


    public function testGetListOfAllReservationsWithOccupationOneReservation()
    {
        //set up
        $this->serviceImpl = $this->serviceImpl = new IReservationServiceImpl;
        $user = User::query()->create([
            'name' => 'Alexandra',
            'surname' => 'Fedina',
            'email' => 'feda07@gmail.com',
            'phone' => '+420987654321',
            'password' => 'password',
        ]);
        $user2 = User::query()->create([
            'name' => 'Alexandra',
            'surname' => 'Fedina',
            'email' => 'feda071@gmail.com',
            'phone' => '+420987654321',
            'password' => 'password',
        ]);
        $service = $user->services()->create([
            'name' => 'name 13',
            'description' => 'description',
            'duration' => 15,

        ]);
        $user->services()->create([
            'name' => 'nsme',
            'description' => 'description',
            'duration' => 15,

        ]);

        $openningHours = OpeningHours::query()->create([
            'time_from' => Carbon::create(2021, 6, 14, 10),
            'time_to' => Carbon::create(2021, 6, 14, 10, 30),
            'day' => Carbon::MONDAY,
            'service_id' => $service->id,
        ]);

        $reservation = $service->reservations()->create([
            'date_from' => Carbon::create(2021, 6, 14, 10),
            'date_to' => Carbon::create(2021, 6, 14, 10, 15),
            'user_id'=>$user2->id,
        ]);

        // call
        $data = $this->serviceImpl->getListOfAllReservationsWithOccupation($service->id, Carbon::create(2021, 6, 14));

        // control
        self::assertCount(2, $data);

        self::assertEquals(Carbon::create(2021, 6, 14, 10, 0, 0), $data[0]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 10, 15, 0), $data[0]->to);
        self::assertTrue($data[0]->isOccupated);

        self::assertEquals(Carbon::create(2021, 6, 14, 10, 15, 0), $data[1]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 10, 30, 0), $data[1]->to);
        self::assertFalse($data[1]->isOccupated);

    }

    public function testGetListOfAllReservationsWithOccupationOneReservationNextWeek()
    {
        //set up
        $this->serviceImpl = $this->serviceImpl = new IReservationServiceImpl;
        $user = User::query()->create([
            'name' => 'Alexandra',
            'surname' => 'Fedina',
            'email' => 'feda07@gmail.com',
            'phone' => '+420987654321',
            'password' => 'password',
        ]);
        $user2 = User::query()->create([
            'name' => 'Alexandra',
            'surname' => 'Fedina',
            'email' => 'feda071@gmail.com',
            'phone' => '+420987654321',
            'password' => 'password',
        ]);
        $service = $user->services()->create([
            'name' => 'name 13',
            'description' => 'description',
            'duration' => 15,

        ]);
        $user->services()->create([
            'name' => 'nsme',
            'description' => 'description',
            'duration' => 15,

        ]);

        $openningHours = OpeningHours::query()->create([
            'time_from' => Carbon::create(2021, 6, 14, 10),
            'time_to' => Carbon::create(2021, 6, 14, 10, 30),
            'day' => Carbon::MONDAY,
            'service_id' => $service->id,
        ]);

        $reservation = $service->reservations()->create([
            'date_from' => Carbon::create(2021, 6, 21, 10),
            'date_to' => Carbon::create(2021, 6, 21, 10, 15),
            'user_id'=>$user2->id,
        ]);

        // call
        $data = $this->serviceImpl->getListOfAllReservationsWithOccupation($service->id, Carbon::create(2021, 6, 14));

        // control
        self::assertCount(2, $data);

        self::assertEquals(Carbon::create(2021, 6, 14, 10, 0, 0), $data[0]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 10, 15, 0), $data[0]->to);
        self::assertFalse($data[0]->isOccupated);

        self::assertEquals(Carbon::create(2021, 6, 14, 10, 15, 0), $data[1]->from);
        self::assertEquals(Carbon::create(2021, 6, 14, 10, 30, 0), $data[1]->to);
        self::assertFalse($data[1]->isOccupated);

    }
}

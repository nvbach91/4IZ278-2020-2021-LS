<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ReservationDeleteRequest;
use App\Services\IProfileService;
use App\Services\IReservationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{


    /**
     * ProfileController constructor.
     * @param IReservationService $reservationService
     * @param IProfileService $profileService
     */
    public function __construct(private IReservationService $reservationService, private IProfileService $profileService)
    {

        $this->middleware('auth');
    }

    public function index(): Factory|View|Application
    {

        return view('profile', [
            'user' => Auth::user(),

            'reservations' => $this->reservationService->getReservationOfLoginUser()
        ]);
    }

    public function edit(EditProfileRequest $request)
    {
        $name = $request->get('name');
        $surname = $request->get('surname');
        $phone = $request->get('phoneNumber');
        $aboutMe = $request->get('aboutMe');
        $avatar = $request->file('avatar');
        $id = Auth::id();
        Log::info( $phone);
        $this->profileService->updateProfile($id, $name, $surname, $phone, $aboutMe, $avatar);
        return redirect()->route('profile.index');
    }

    public function editView()
    {
        return view('profile-edit');
    }

    public function delete(ReservationDeleteRequest $request)
    {
        $id = $request->get('reservationId');
        $this->reservationService->deleteReservation($id);
        return $this->index();
    }
}

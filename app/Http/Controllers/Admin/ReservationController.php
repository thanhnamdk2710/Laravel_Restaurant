<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\ReservationConfirmed;
use App\Reservation;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function status($id)
    {
        Reservation::findOrFail($id)->update([
            'status' => true
        ]);

        $reservation = Reservation::findOrFail($id);
        Notification::route('mail', $reservation->email)->notify(new ReservationConfirmed());
        Toastr::success('Reservation successfully confirmed!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        Toastr::success('Deleted reservation successfully!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}

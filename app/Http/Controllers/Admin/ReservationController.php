<?php

namespace App\Http\Controllers\Admin;

use App\Reservation;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

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

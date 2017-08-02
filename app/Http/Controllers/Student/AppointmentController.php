<?php

namespace App\Http\Controllers\Student;

use App\Appointment;
use App\Http\Requests\Appointment\BookRequest;
use App\Http\Requests\Appointment\CancelRequest;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class AppointmentController extends BaseController
{
    public function __construct()
    {
    }

    public function book(BookRequest $request)
    {
        $id = $request->get('id');
        $now = Carbon::now();
        Auth::user()->availabilities()->attach($id, [
            'created_at' => $now,
            'updated_at' => $now,
            'reason' => $request->get('reason'),
            'level' => $request->get('level')
        ]);
        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function index(Request $request)
    {
        $type = $request->query('type', 'upcoming');
        $model = Auth::user()->availabilities();

        $successful = $pending = $past = $cancel = [];
        switch ($type) {
            case 'upcoming':
                $successful = $model->wherePivot('status', Appointment::STATUS['booked'])->where('availabilities.date', '>=', Carbon::now())->get();
                $pending = $model->wherePivot('status', Appointment::STATUS['pending'])->where('availabilities.date', '>=', Carbon::now())->get();
                break;
            case 'past':
                $past = $model->where('availabilities.date', '<', Carbon::now())->get();
                break;
            case 'cancel':
                $cancel = $model->wherePivot('status', Appointment::STATUS['booked'])->where('availabilities.date', '>=', Carbon::now())->get();
                break;
        }

        return view('student.appointments.list', compact('successful', 'pending', 'past', 'type', 'cancel'));
    }

    public function cancel(CancelRequest $request)
    {
        $id = $request->get('id');
        $now = Carbon::now();
        Auth::user()->availabilities()->updateExistingPivot($id, ['updated_at' => $now, 'status' => Appointment::STATUS['cancel']]);
        return response()->json(['status' => 1, 'message' => 'success']);
    }
}
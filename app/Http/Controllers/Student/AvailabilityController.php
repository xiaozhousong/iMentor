<?php

namespace App\Http\Controllers\Student;

use App\Availability;
use Illuminate\Http\Request;
use Auth;

class AvailabilityController extends BaseController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if (!$tutorId = $request->query('tutor_id', 0)) {
            $availabilities = null;
        }

        $userAvailabilities = Auth::user()->availabilities()->get()->pluck('id');

        $model = new Availability();
        $model = $model->with('tutor')->where('tutor_id', $tutorId)->whereNotIn('id', $userAvailabilities);

        if ($dataFrom = $request->query('date_from', 0)) {
            $model = $model->where('date', '>=', $dataFrom);
        }

        if ($dataTo = $request->query('date_to', 0)) {
            $model = $model->where('date', '<=', $dataTo);
        }

        if ($length = $request->query('length')) {
            $model = $model->where('length', $length);
        }

        if ($time = $request->query('time_range')) {
            $time = explode(',', $time);
            $model = $model->whereBetween('time_start', $time, 'or')->whereBetween('time_end', $time, 'or');
        }

        $availabilities = $model->paginate(7);
        $query = $request->query();
        return view('student.availabilities.list', compact('availabilities', 'query'));
    }

    public function show($id)
    {
        $id = intval($id);
        $userAvailabilities = Auth::user()->availabilities()->get()->pluck('id');

        if ($userAvailabilities->contains($id)) {
            abort(404);
        }

        $availability = with(new Availability())->with('tutor')->find(intval($id));
        if (!$availability) {
            abort(404);
        }

        return view('student.availabilities.show', compact('availability'));
    }
}
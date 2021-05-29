<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $standards = Student::select('standard')
            ->groupBy('standard')
            ->get();

        $results = Student::select('result')
            ->groupBy('result')
            ->get();

        return view('students', compact('standards', 'results'));
    }

    public function getStandard(Request $request)
    {
        if ($request->ajax()) {
            $standards = Student::select('standard')
                ->groupBy('standard')
                ->get();

            return response()->json($standards);
        }
    }

    public function getResult(Request $request)
    {
        if ($request->ajax()) {

            $results = Student::select('result')
                ->groupBy('result')
                ->get();

            return response()->json($results);
        }
    }

    public function records(Request $request)
    {
        if ($request->ajax()) {

            if (request('std') && request('res')) {
                $students = Student::where('standard', '=', request('std'))->where('result', '=', request('res'))
                    ->latest()
                    ->get();
            } else {
                $students = Student::when(request('std'), function ($query) {
                    $query->where('standard', '=', request('std'));
                })
                    ->when(request('res'), function ($query) {
                        $query->where('result', '=', request('res'));
                    })
                    ->latest()
                    ->get();
            }

            return response()->json([
                'students' => $students
            ]);
        } else {
            abort(403);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\InvMonths;
use App\Models\invDetails;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;


class Income2pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income2page = invDetails::latest()->paginate();

        return view('income2page.index', compact('income2page'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function records(Request $request)
    {
        if ($request->ajax()) {


            if ($request->input('start_date') && $request->input('end_date')) {
                $from = $request->input('start_date');
                $to = $request->input('end_date');
                $students = invDetails::whereBetween('date', [$from, $to])->get();

                $total = 0;
                $total_income = 0;
                $sum_buy = 0;


                foreach ($students as $sum) {
                    if ($sum->note == "รายรับ") {
                        $total_income +=  $sum->price;
                    }
                    if ($sum->note == "รายจ่าย") {
                        $sum_buy +=  $sum->price;
                    }
                    $total +=  $sum->price;
                }

                return response()->json([
                    'students' => $students,
                    "sum_filter" => $total,
                    "sum_buy" => $sum_buy,
                    "sum_income" => $total_income
                ]);
            }

            // $students = Income2::whereBetween("created_at", ["2022-06-07 00:00:00","2022-06-17 00:00:00"])->get();
            // $students = Income2::whereBetween("date", ["2022-06-25","2022-06-28"])->get();

            $students = DB::table('inv_details')->get();
            $sum = invDetails::sum('price');

            return response()->json([
                'students' => $students,
                "sum" => $sum
            ]);
        } else {
            abort(403);
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Models\InvMonths;
use App\Models\invDetails;
use Illuminate\Http\Request;
use App\Models\invDetailExpenses;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $chart_year = !empty($request->chart_year) ? $request->chart_year - 543 : date('Y');
        $inv_detail_expenses = DB::table('inv_detail_expenses')
            ->select(DB::raw('(sum(price)) as price'), DB::raw('MONTH(created_at) as month'))
            ->whereYear('created_at', $chart_year)
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        $inv_detail = DB::table('inv_details')
            ->select(DB::raw('(sum(price)) as price'), DB::raw('MONTH(created_at) as month'))
            ->whereYear('created_at', $chart_year)
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        $inv_price = [];
        $inv_month = [];
        $inv_expenses_price = [];
        $inv_expenses_month = [];

        $strMonthCut = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];

        // inv_detail
        foreach ($inv_detail as $inv_key => $inv) {
            $inv_price[$inv_key] = $inv->price;
            $inv_month[$inv_key] = $strMonthCut[$inv->month];
        }

        // inv_detail_expenses
        foreach ($inv_detail_expenses as $inv_key => $inv_expenses) {
            $inv_expenses_price[$inv_key] =  $inv_expenses->price;
            $inv_expenses_month[$inv_key] = $strMonthCut[$inv_expenses->month];
        }

        // result
        $result['inv_expenses_price'] = $inv_expenses_price;
        $result['inv_price'] = $inv_price;
        $result['month'] = collect([...$inv_month, ...$inv_expenses_month])->unique();

        return response()->json($result);
    }

    public function records(Request $request)
    {
        $from = !empty($request->start_date) ? $request->start_date : date('1-m-Y');
        $to = !empty($request->end_date) ? $request->end_date : date('t-m-Y');

        $inv = invDetails::whereBetween('date', [$from, $to])->get();
        $inv_expenses = invDetailExpenses::whereBetween('date', [$from, $to])->get();

        if ($request->note == 'รายรับ') {
            $students = $inv;
        } elseif ($request->note == 'รายจ่าย') {
            $students = $inv_expenses;
        } else {
            $students = collect([...$inv, ...$inv_expenses]);
        }

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
}
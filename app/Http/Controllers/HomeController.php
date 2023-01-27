<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $staff = DB::table('staff')->count();
        $users = DB::table('users')->count();
        $user_activity_logs = DB::table('user_activity_logs')->count();
        $activity_logs = DB::table('activity_logs')->count();
        return view('home', compact('staff', 'users', 'user_activity_logs', 'activity_logs'));
    }
    public function deshboard(Request $request)
    {
        //dd($request->all());



        //$income2 = \App\Models\Income2::where([['id_income02_lists', '=', $income1->id]])->get();
        $results = [];
        for ($i = 0; $i < 12; $i++) {
            $income1 = \App\Models\InvMonths::where([['name', '=', $i + 1]])->first();
            if (!$income1) {
                continue;
            }
            $income1_id = $income1->id;
            $expense = \App\Models\invDetails::where([
                ['id_income02_lists', '=', $income1_id],
                ['note', '=', 'รายจ่าย']
            ])->get();
            $income = \App\Models\invDetails::where([
                ['id_income02_lists', '=', $income1_id],
                ['note', '=', 'รายรับ']
            ])->get();
            $results[$i] = ['รายจ่าย' => $expense, 'รายรับ' => $income];
        }

        return response()->json($results);


        $Qury = DB::table('income2s')
            ->selectRaw('id_income02_lists,note ,SUM(price) as result')
            ->groupBy(['id_income02_lists', 'note'])
            ->orderByDesc('id_income02_lists')
            ->limit(24)
            ->get()
            ->groupBy(['id_income02_lists', 'note'])

            // ->orderBy('id_income02_lists','desc')

        ;
        // ->groupBy(['id_income02_lists', 'note']);

        $temp = [$month => $Qury[8]];
        return $Qury;
    }
}
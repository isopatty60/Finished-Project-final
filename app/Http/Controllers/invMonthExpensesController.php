<?php

namespace App\Http\Controllers;

use App\Models\invFiscalYearExpenses;
use App\Models\invMonthExpenses;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class invMonthExpensesController extends Controller
{
    public function index()
    {
        $invMonthExpenses = invMonthExpenses::latest();

        return view('invMonthExpenses.index', compact('invMonthExpenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // public function create()
    // {
    //     return view('invMonthExpenses.create');
    // }

    public function createInvMonthsExpenses($id)
    {
        return view('invMonthExpenses.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'fiscal_year_id_expenses' => 'required',
        ]);
        invMonthExpenses::create($request->all());

        return redirect('/invMonthExpenses/' . $request->fiscal_year_id_expenses)->with('success', ' create successfully');
    }
    public function show($id)
    {
        $monthsName = invFiscalYearExpenses::find($id);
        $invMonthExpenses = DB::table('inv_month_expenses')->where('fiscal_year_id_expenses', $id)->paginate(20);
        return view('invMonthExpenses.index', compact(['invMonthExpenses', 'id', 'monthsName']));
    }

    public function edit($id)
    {
        $income1 = invMonthExpenses::find($id);
        return view('invMonthExpenses.edit', compact('income1'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'fiscal_year_id_expenses' => 'required',
        ]);

        invMonthExpenses::find($id)->update($request->all());
        $inv = invMonthExpenses::find($id);

        return redirect('/invMonthExpenses/' . $inv->fiscal_year_id_expenses);
    }
    public function destroy($id)
    {
        invMonthExpenses::find($id)->delete();
        return back()->with('success', 'invMonthExpenses deleted successfully');
    }
}
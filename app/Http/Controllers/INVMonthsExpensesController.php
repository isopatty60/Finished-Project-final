<?php

namespace App\Http\Controllers;

use App\Models\INV_Fiscal_years_expenses;
use App\Models\INV_Months_expenses;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class INVMonthsExpensesController extends Controller
{
    public function index()
    {
        $InvMonths_expenses = INV_Months_expenses::latest()->paginate();

        return view('InvMonths_expenses.index', compact('InvMonths_expenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('InvMonths_expenses.create');
    }

    public function createInvMonthsExpenses($id)
    {
        return view('InvMonths_expenses.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'Fiscal_year_id' => 'required',
        ]);
        INV_Months_expenses::create($request->all());

        return redirect('/InvMonths_expenses/' . $request->Fiscal_year_id)
            ->with('success', ' create successfully');
    }
    public function show($id)
    {
        $monthsName = INV_Fiscal_years_expenses::find($id);
        $months = DB::table('inv_months')->where('Fiscal_year_id', $id)->paginate(5);
        return view('InvMonths_expenses.index', compact(['months', 'id', 'monthsName']));
    }

    public function edit($id)
    {
        $income1 = INV_Months_expenses::find($id);
        return view('InvMonths_expenses.edit', compact('income1'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'Fiscal_year_id' => 'required',
        ]);

        INV_Months_expenses::find($id)->update($request->all());
        $inv = INV_Months_expenses::find($id);

        return redirect('/InvMonths_expenses/' . $inv->Fiscal_year_id);
    }
    public function destroy($id)

    {
        INV_Months_expenses::find($id)->delete();
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
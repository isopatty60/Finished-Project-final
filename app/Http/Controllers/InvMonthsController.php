<?php

namespace App\Http\Controllers;

use App\Models\InvFiscalYears;
use App\Models\InvMonths;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class InvMonthsController extends Controller
{
    public function index()
    {
        $InvMonths = InvMonths::latest()->paginate();

        return view('InvMonths.index', compact('InvMonths'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('InvMonths.create');
    }

    public function create001($id)
    {
        return view('InvMonths.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'Fiscal_year_id' => 'required',
        ]);
        InvMonths::create($request->all());

        return redirect('/InvMonths/' . $request->Fiscal_year_id)
            ->with('success', ' create successfully');
    }
    public function show($id)
    {
        $monthsName = InvFiscalYears::find($id);
        $months = DB::table('inv_months')->where('Fiscal_year_id', $id)->paginate(5);
        return view('InvMonths.index', compact(['months', 'id', 'monthsName']));
    }

    public function edit($id)
    {
        $income1 = InvMonths::find($id);
        return view('InvMonths.edit', compact('income1'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'Fiscal_year_id' => 'required',
        ]);

        InvMonths::find($id)->update($request->all());
        $inv = InvMonths::find($id);

        return redirect('/InvMonths/' . $inv->Fiscal_year_id);
    }
    public function destroy($id)

    {
        InvMonths::find($id)->delete();
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
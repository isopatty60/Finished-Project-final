<?php

namespace App\Http\Controllers;

use App\Models\INV_Fiscal_years_expenses;
use Illuminate\Http\Request;


class INVFiscalYearsExpensesController extends Controller
{
    public function index()
    {
        $INV_fiscal_years_expenses = INV_Fiscal_years_expenses::latest()->paginate();

        return view('INV_fiscal_years_expenses.index ', compact('INV_fiscal_years_expenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('INV_fiscal_years_expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        INV_Fiscal_years_expenses::create($request->all());

        return redirect()->route('INV_fiscal_years_expenses.index')
            ->with('success', 'fiscal_years created successfully.');
    }

    public function show(INV_Fiscal_years_expenses $INV_Fiscal_years_expenses)
    {
        return view('INV_fiscal_years_expenses.show', compact('INV_fiscal_years_expenses'));
    }

    public function edit(INV_Fiscal_years_expenses $INV_fiscal_years_expenses)
    {
        return view('INV_fiscal_years_expenses.edit', compact('INV_fiscal_years_expenses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        INV_Fiscal_years_expenses::find($id)->update($request->all());
        return redirect()->route('INV_fiscal_years_expenses.index')
            ->with('success', 'fiscal_years updated successfully');
    }

    public function destroy(INV_Fiscal_years_expenses $INV_fiscal_years_expenses)
    {
        $INV_fiscal_years_expenses->delete();

        return redirect()->route('INV_fiscal_years_expenses.index')
            ->with('success', 'fiscal_years deleted successfully');
    }
}
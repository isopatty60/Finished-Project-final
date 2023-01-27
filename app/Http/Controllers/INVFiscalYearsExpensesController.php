<?php

namespace App\Http\Controllers;

use App\Models\invFiscalYearsExpenses;
use Illuminate\Http\Request;


class invFiscalYearsExpensesController extends Controller
{
    public function index()
    {
        $invFiscalYearsExpenses = invFiscalYearsExpenses::latest()->paginate();

        return view('invFiscalYearsExpenses.index ', compact('invFiscalYearsExpenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('invFiscalYearsExpenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        invFiscalYearsExpenses::create($request->all());

        return redirect()->route('invFiscalYearsExpenses.index')
            ->with('success', 'invFiscalYearsExpenses created successfully.');
    }

    public function show(invFiscalYearsExpenses $invFiscalYearsExpenses)
    {
        return view('invFiscalYearsExpenses.show', compact('invFiscalYearsExpenses'));
    }

    public function edit(invFiscalYearsExpenses $invFiscalYearsExpenses)
    {
        return view('invFiscalYearsExpenses.edit', compact('invFiscalYearsExpenses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        invFiscalYearsExpenses::find($id)->update($request->all());
        return redirect()->route('invFiscalYearsExpenses.index')
            ->with('success', 'invFiscalYearsExpenses updated successfully');
    }

    public function destroy(invFiscalYearsExpenses $invFiscalYearsExpenses)
    {
        $invFiscalYearsExpenses->delete();

        return redirect()->route('invFiscalYearsExpenses.index')
            ->with('success', 'fiscal_years deleted successfully');
    }
}
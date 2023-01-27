<?php

namespace App\Http\Controllers;

use App\Models\invFiscalYearExpenses;
use Illuminate\Http\Request;


class invFiscalYearExpensesController extends Controller
{
    public function index()
    {
        $invFiscalYearExpenses = invFiscalYearExpenses::latest()->paginate();

        return view('invFiscalYearExpenses.index ', compact('invFiscalYearExpenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('invFiscalYearExpenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        invFiscalYearExpenses::create($request->all());

        return redirect()->route('invFiscalYearExpenses.index')
            ->with('success', 'invFiscalYearExpenses created successfully.');
    }

    public function show(invFiscalYearExpenses $invFiscalYearExpenses)
    {
        return view('invFiscalYearExpenses.show', compact('invFiscalYearExpenses'));
    }

    public function edit(invFiscalYearExpenses $invFiscalYearExpenses)
    {
        return view('invFiscalYearExpenses.edit', compact('invFiscalYearExpenses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        invFiscalYearExpenses::find($id)->update($request->all());
        return redirect()->route('invFiscalYearExpenses.index')
            ->with('success', 'invFiscalYearExpenses updated successfully');
    }

    public function destroy(invFiscalYearExpenses $invFiscalYearExpenses)
    {
        $invFiscalYearExpenses->delete();

        return redirect()->route('invFiscalYearExpenses.index')
            ->with('success', 'fiscal_years deleted successfully');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\InvFiscalYears;
use Illuminate\Http\Request;

class InvFiscalYearsController extends Controller
{
    public function index()
    {
        $InvFiscalYears = InvFiscalYears::latest()->paginate();

        return view('InvFiscalYears.index', compact('InvFiscalYears'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('InvFiscalYears.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        InvFiscalYears::create($request->all());

        return redirect()->route('fiscal_years.index')
            ->with('success', 'fiscal_years created successfully.');
    }

    public function show(InvFiscalYears $InvFiscalYear)
    {
        return view('InvFiscalYears.show', compact('InvFiscalYear'));
    }

    public function edit(InvFiscalYears $fiscal_year)
    {
        dd($fiscal_year);
        return view('InvFiscalYears.edit', compact('fiscal_year'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        InvFiscalYears::find($id)->update($request->all());
        return redirect()->route('fiscal_years.index')
            ->with('success', 'fiscal_years updated successfully');
    }

    public function destroy(InvFiscalYears $fiscal_year)
    {
        $fiscal_year->delete();

        return redirect()->route('fiscal_years.index')
            ->with('success', 'fiscal_years deleted successfully');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income = Income::latest()->paginate();
    
        return view('income.index',compact('income'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
     public function create()
    {
        return view('income.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);
    
        Income::create($request->all());
     
        return redirect()->route('incomes.index')
                        ->with('success','Income created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $Income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $Income)
    {
        return view('income.show',compact('Income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $Income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $Income)
    {
        return view('income.edit',compact('Income'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $Income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $Income)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);
    
        $Income->update($request->all());
    
        return redirect()->route('incomes.index')
                        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $Income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $Income)
    {
        $Income->delete();
    
        return redirect()->route('incomes.index')
                        ->with('success','Income deleted successfully');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Income1;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class Income1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income1s = Income1::latest()->paginate();

        return view('income1.index',compact('income1s'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function create()
    {
        return view('income1.create');
    }

    public function create001($id)
    {
        //return response()->json($id);
        return view('income1.create',compact('id'));

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
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'id_income01_lists' => 'required',
        ]);


        Income1::create($request->all());

        return redirect('/income1/'.$request->id_income01_lists)
                    ->with('success',' create successfully');

        // Income1::create($request->all());

        // return redirect()->route('incomes.index')
        //                 ->with('success','Income1 created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income1  $Income1
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('income1.show',compact('Income1'));

        $income1Name = Income::find($id);
        $income1=DB::table('income1s')->where('id_income01_lists',$id)->paginate(5);
        return view('income1.index',compact(['income1','id','income1Name']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income1  $Income1
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('income1.edit',compact('Income1'));

        $income1=Income1::find($id);
        return view('income1.edit',compact('income1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income1  $Income1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'id_income01_lists' => 'required',
        ]);

        income1::find($id)->update($request->all());
        $inv = income1::find($id);

        return redirect('/income1/'.$inv->id_income01_lists);

        // $Income1->update($request->all());

        // return redirect()->route('incomes.index')
        //                 ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income1  $Income1
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)

    {
        Income1::find($id)->delete();
        return back()->with('success','Product_subdata deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Income1;
use App\Models\Income2;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;


class Income2Controller extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income2s = Income2::latest()->paginate();
    
        return view('income2.index',compact('income2s'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
     public function create()
    {
        return view('income2.create');
    }

    public function create002($id)
    {
        //return response()->json($id);
        return view('income2.create',compact('id'));

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
            'id_income02_lists' => 'required',
        ]);

        
        Income2::create($request->all());

        return redirect('/income2/'.$request->id_income02_lists)
                    ->with('success',' create successfully');
    
        // Income2::create($request->all());
     
        // return redirect()->route('incomes.index')
        //                 ->with('success','Income2 created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income2  $Income2
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('income2.show',compact('Income2'));
        $income2Name = Income1::find($id);
        $income2=DB::table('income2s')->where('id_income02_lists',$id)->paginate(5);
        return view('income2.index',compact(['income2','id','income2Name']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income2  $Income2
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('income2.edit',compact('Income2'));

        $income2=Income2::find($id);
        return view('income2.edit',compact('income2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income2  $Income2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            
        ]);
    
        income2::find($id)->update($request->all());
        $inv = income2::find($id); 
                        
        return redirect('/income2/'.$inv->id_income02_lists);

        // $Income2->update($request->all());
    
        // return redirect()->route('incomes.index')
        //                 ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income2  $Income2
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    
    {
        Income2::find($id)->delete();
        // return response()->json($id);
        return back()->with('success','Product_subdata deleted successfully');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\INV_Details_expenses;
use App\Models\INV_Months_expenses;
use Illuminate\support\Facades\DB;

class INVDetailsExpensesController extends Controller
{
    public function index()
    {

        $invDetails = INV_Details_expenses::latest()->paginate();
        $invDetailsName = "";
        return view('invDetails.index', compact(['invDetails', 'invDetailsName']))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }


    public function create()
    {
        return view('invDetails.create');
    }

    public function create002($id)
    {
        //return response()->json($id);
        return view('invDetails.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'Month_id' => 'required',
        ]);


        INV_Details_expenses::create($request->all());

        return redirect('/invDetails/' . $request->Month_id)
            ->with('success', ' create successfully');

        // Income2::create($request->all());

        // return redirect()->route('incomes.index')
        //                 ->with('success','Income2 created successfully.');
    }

    public function show($id)
    {
        // return view('income2.show',compact('Income2'));
        $sum = INV_Details_expenses::sum('price');
        // return response()->json($sum);
        $invDetailsName = INV_Months_expenses::find($id);
        $invDetails = DB::table('inv_details')->where('Month_id', $id)->paginate(5);
        return view('invDetails.index', compact(['invDetails', 'id', 'invDetailsName', 'sum']));
    }

    public function edit($id)
    {
        // return view('income2.edit',compact('Income2'));

        $invDetails = INV_Details_expenses::find($id);
        return view('invDetails.edit', compact('invDetails'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',

        ]);

        INV_Details_expenses::find($id)->update($request->all());
        $inv = INV_Details_expenses::find($id);

        return redirect('/invDetails/' . $inv->Month_id);

        // $Income2->update($request->all());

        // return redirect()->route('incomes.index')
        //                 ->with('success','Post updated successfully');
    }

    public function destroy($id)

    {
        INV_Details_expenses::find($id)->delete();
        // return response()->json($id);
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
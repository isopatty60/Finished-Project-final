<?php

namespace App\Http\Controllers;

use App\Models\InvMonths;
use App\Models\invDetails;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;


class invDetailController extends Controller
{

    public function index()
    {

        $invDetails = invDetails::latest()->paginate();
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


        invDetails::create($request->all());

        return redirect('/invDetails/' . $request->Month_id)
            ->with('success', ' create successfully');

        // Income2::create($request->all());

        // return redirect()->route('incomes.index')
        //                 ->with('success','Income2 created successfully.');
    }

    public function show($id)
    {
        // return view('income2.show',compact('Income2'));
        $sum = invDetails::sum('price');
        // return response()->json($sum);
        $invDetailsName = InvMonths::find($id);
        $invDetails = DB::table('inv_details')->where('Month_id', $id)->paginate(5);
        return view('invDetails.index', compact(['invDetails', 'id', 'invDetailsName', 'sum']));
    }

    public function edit($id)
    {
        // return view('income2.edit',compact('Income2'));

        $invDetails = invDetails::find($id);
        return view('invDetails.edit', compact('invDetails'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',

        ]);

        invDetails::find($id)->update($request->all());
        $inv = invDetails::find($id);

        return redirect('/invDetails/' . $inv->Month_id);

        // $Income2->update($request->all());

        // return redirect()->route('incomes.index')
        //                 ->with('success','Post updated successfully');
    }

    public function destroy($id)

    {
        invDetails::find($id)->delete();
        // return response()->json($id);
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
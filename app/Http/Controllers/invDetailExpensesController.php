<?php

namespace App\Http\Controllers;

use App\Models\invDetailExpenses;
use App\Models\invMonthExpenses;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;

class invDetailExpensesController extends Controller
{
    public function index()
    {
        $invDetailExpenses = invDetailExpenses::latest()->paginate();
        $invDetailsName = "";
        return view('invDetailExpenses.index', compact(['invDetailExpenses', 'invDetailsName']))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function createInvDetailExpenses($id)
    {
        //return response()->json($id);
        return view('invDetailExpenses.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'month_expenses_id' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'detail' => $request->detail,
            'price' => $request->price,
            'note' => $request->note,
            'date' => date('Y-m-d', strtotime($request->date)),
            'month_expenses_id' => $request->month_expenses_id,
        ];
        invDetailExpenses::create($data);

        return redirect('/invDetailExpenses/' . $request->month_expenses_id)
            ->with('success', ' create successfully');
    }

    public function show($id)
    {
        $sum = invDetailExpenses::sum('price');
        $invDetailsName = invMonthExpenses::find($id);
        $invDetailExpenses = DB::table('inv_detail_expenses')->where('month_expenses_id', $id)->paginate(5);
        return view('invDetailExpenses.index', compact(['invDetailExpenses', 'id', 'invDetailsName', 'sum']));
    }

    public function edit($id)
    {
        // return view('income2.edit',compact('Income2'));

        $invDetails = invDetailExpenses::find($id);
        return view('invDetailExpenses.edit', compact('invDetails'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',

        ]);
        $data = [
            'name' => $request->name,
            'detail' => $request->detail,
            'price' => $request->price,
            'note' => $request->note,
            'date' => date('Y-m-d', strtotime($request->date))
        ];
        invDetailExpenses::find($id)->update($data);
        $inv = invDetailExpenses::find($id);
        return redirect('/invDetailExpenses/' . $inv->month_expenses_id);

        // $Income2->update($request->all());

        // return redirect()->route('incomes.index')
        //                 ->with('success','Post updated successfully');
    }

    public function destroy($id)

    {
        invDetailExpenses::find($id)->delete();
        // return response()->json($id);
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
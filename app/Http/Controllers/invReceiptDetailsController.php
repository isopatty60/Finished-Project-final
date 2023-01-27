<?php

namespace App\Http\Controllers;

use App\Models\invReceiptLists;
use App\Models\invReceiptDetails;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class invReceiptDetailsController extends Controller
{
    public function index()
    {
        $invReceiptDetails = invReceiptDetails::latest()->paginate();

        return view('invReceiptDetails.index', compact('invReceiptDetails'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('invReceiptDetails.create');
    }


    public function create004($id)
    {
        return view('invReceiptDetails.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'price' => 'required',
            'note' => 'required',
            'address' => 'required',
            'Receipt_lists_id' => 'required',
        ]);

        invReceiptDetails::create($request->all());
        return redirect('/invReceiptDetails/' . $request->Receipt_lists_id)
            ->with('success', ' create successfully');
    }

    public function show($id)
    {
        $invReceiptDetailsName = invReceiptLists::find($id);
        $invReceiptDetails = DB::table('inv_receipt_details')->where('Receipt_lists_id', $id)->paginate();
        return view('invReceiptDetails.index', compact(['invReceiptDetailsName', 'id', 'invReceiptDetails']));
    }

    public function edit($id)
    {
        $invReceiptDetails = invReceiptDetails::find($id);
        return view('invReceiptDetails.edit', compact('invReceiptDetails'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'price' => 'required',
            'address' => 'required',
            'note' => 'required',
            'Receipt_lists_id' => 'required',
        ]);
        invReceiptDetails::find($id)->update($request->all());
        $inv = invReceiptDetails::find($id);
        // return response()->json($request);

        return redirect('/invReceiptDetails/' . $inv->Receipt_lists_id);
    }


    public function destroy($id)
    {
        invReceiptDetails::find($id)->delete();
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
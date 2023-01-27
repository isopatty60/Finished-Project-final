<?php

namespace App\Http\Controllers;

use App\Models\invItemExpenses;
use App\Models\INV_Details_expenses;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;


class invItemExpensesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invItemExpenses = invItemExpenses::latest()->paginate();

        return view('invItemExpenses.index', compact('invItemExpenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('invItemExpenses.create');
    }

    public function createInvItemExpenses($id)
    {
        //return response()->json($id);
        return view('invItemExpenses.create', compact('id'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'price' => 'required',
            'note' => 'required',
            'detail_expenses_id' => 'required',
            'image_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input = $request->all();

        // => $input['name', 'detail','date', ...]

        if ($image = $request->file('image_product')) {
            $destinationPath = 'image_product/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image_product'] = "$profileImage";
        } else {
            unset($input['image']);
        }


        invItemExpenses::create($input);
        return redirect('/invItemExpenses/' . $input['detail_expenses_id'])->with('success', ' create successfully');
    }
    public function show($id)
    {
        $invDetailsName = invItemExpenses::find($id);
        $invItemExpenses = DB::table('inv_item_expenses')->where('detail_expenses_id', $id)->paginate();
        return view('invItemExpenses.index', compact(['invItemExpenses', 'id', 'invDetailsName']));
    }
    public function edit($id)
    {
        $invItemExpenses = invItemExpenses::find($id);
        return view('invItemExpenses.edit', compact('invItemExpenses'));
    }
    public function updateInvItemExpenses(Request $request,  $id)
    {
        $inv = invItemExpenses::find($id);
        $inv->name = $request->input("name");
        $inv->detail = $request->input("detail");
        $inv->date = $request->input("date");
        $inv->price = $request->input("price");


        $input = $request->all();

        if ($request->file('image_product')) {
            $image = $request->file('image_product');
            $destinationPath = 'image_product/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image_product'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $inv->update($input);
        $inv->update();

        return redirect('/invItemExpenses/' . $inv->detail_expenses_id)->with('success', ' update successfully');
    }
    public function destroy($id)

    {
        invItemExpenses::find($id)->delete();
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
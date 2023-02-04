<?php

namespace App\Http\Controllers;

use App\Models\invDetails;
use App\Models\invItems;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class invItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invItems = invItems::latest()->paginate();

        return view('invItems.index', compact('invItems'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('invItems.create');
    }

    public function createInvItems($id)
    {
        //return response()->json($id);
        return view('invItems.create', compact('id'));
    }
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            // 'price' => 'required',
            'note' => 'required',
            'detail_id' => 'required',
            'image_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = [
            // 'name' => $request->name,
            'detail' => $request->detail,
            // 'price' => $request->price,
            'note' => $request->note,
            'date' => date('Y-m-d', strtotime($request->date)),
            'detail_id' => $request->detail_id,
        ];
        if ($image = $request->file('image_product')) {
            $destinationPath = 'image_product/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image_product'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        invItems::create($input);
        return redirect('/invItems/' . $input['detail_id'])->with('success', ' create successfully');
    }
    public function show($id)
    {
        $sum = invDetails::sum('price');
        $invDetailsName = invDetails::find($id);
        $invItems = DB::table('inv_items')->where('detail_id', $id)->paginate();
        return view('invItems.index', compact(['invItems', 'id', 'invDetailsName']));
    }
    public function edit($id)
    {
        $invItems = invItems::find($id);
        return view('invItems.edit', compact('invItems'));
    }
    public function update(Request $request,  $id)
    {
        $inv = invItems::find($id);
        $input = [
            'detail' => $request->detail,
            'note' => $request->note,
            'date' => date('Y-m-d', strtotime($request->date)),
            'detail_id' => $request->detail_id,
        ];

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
        return redirect('/invItems/' . $inv->detail_id)->with('success', ' update successfully');
    }
    public function destroy($id)
    {
        invItems::find($id)->delete();
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
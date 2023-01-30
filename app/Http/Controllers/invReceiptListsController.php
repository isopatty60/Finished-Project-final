<?php

namespace App\Http\Controllers;

use App\Models\invReceiptLists;
use Illuminate\Http\Request;



class invReceiptListsController extends Controller
{
    public function index()
    {
        $invReceiptLists = invReceiptLists::latest()->paginate();

        return view('invReceiptLists.index', compact('invReceiptLists'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('invReceiptLists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'date'  => 'required',
            'tel'  => 'required',
            'postcode'  => 'required',

        ]);
        $data = [
            'title' => $request->title,
            'address' => $request->address,
            'price' => $request->price,
            'tel' => $request->tel,
            'postcode' => $request->postcode,
            'date' => date('Y-m-d', strtotime($request->date)),
        ];
        invReceiptLists::create($data);
        return redirect()->route('invReceiptLists.index')
            ->with('success', 'invReceiptLists created successfully.');
    }
    public function show(invReceiptLists $invReceiptLists)
    {
        return view('invReceiptLists.show', compact('invReceiptLists'));
    }

    public function edit($id)
    {
        $invReceiptLists = invReceiptLists::find($id);
        return view('invReceiptLists.edit', compact('invReceiptLists'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'date'  => 'required',
            'tel'  => 'required',
            'postcode'  => 'required'
        ]);
        $data = [
            'title' => $request->title,
            'address' => $request->address,
            'price' => $request->price,
            'tel' => $request->tel,
            'postcode' => $request->postcode,
            'date' => date('Y-m-d', strtotime($request->date)),
        ];
        invReceiptLists::find($id)->update($data);
        return redirect()->route('invReceiptLists.index')
            ->with('success', 'invReceiptLists updated successfully');
    }
    public function destroy($id)
    {
        invReceiptLists::find($id)->delete();
        return redirect()->route('invReceiptLists.index')
            ->with('success', 'invReceiptLists deleted successfully');
    }
}

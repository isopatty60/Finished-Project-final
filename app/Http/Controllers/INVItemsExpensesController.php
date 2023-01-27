<?php

namespace App\Http\Controllers;

use App\Models\INV_Items_expenses;
use App\Models\INV_Details_expenses;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;


class INVItemsExpensesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invItems_expenses = INV_Items_expenses::latest()->paginate();

        return view('invItems_expenses.index', compact('invItems_expenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('invItems_expenses.create');
    }

    public function create003($id)
    {
        //return response()->json($id);
        return view('invItems_expenses.create', compact('id'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'price' => 'required',
            'note' => 'required',
            'detail_id' => 'required',
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


        INV_Items_expenses::create($input);
        // return redirect()->route('incomes.index')
        //                 ->with('success','Product created successfully.');
        // return back()->with('success','Product_subdata deleted successfully');

        return redirect('/invItems_expenses/' . $input['detail_id'])->with('success', ' create successfully');

        // success V1
        // return redirect('/income3/'.$request->id_income03_lists)->with('success',' create successfully');

        // $product->update($input);

        // return redirect()->route('products.index')
        //                 ->with('success','Product updated successfully');

        // $input = $request->all();

        // if ($image = $request->file('image_product')) {
        //     $name =  time()."_".$request->name. '.jpg';
        //     Storage::disk('local')->putFileAs(
        //         'public/image_product',
        //         request()->file('image_product'),
        //         $name
        //     );

        //     $input['image_product'] = $name;
        // }



        // Storage::putFile('image_product', $request->file('image_product'));


        // Income3::create($input);



        // return redirect()->back()->with('success',' create successfully');
        return back()->with('success', 'Product_subdata deleted successfully');

        // Income3::create($request->all());

        // return redirect()->route('incomes.index')
        //                 ->with('success','Income3 created successfully.');
    }
    public function show($id)
    {
        // return view('income3.show',compact('Income3'));
        $invDetailsName = INV_Details_expenses::find($id);
        $invItems_expenses = DB::table('inv_items')->where('detail_id', $id)->paginate();
        return view('invItems_expenses.index', compact(['invItems_expenses', 'id', 'invDetailsName']));
    }
    public function edit($id)
    {
        // return view('income3.edit',compact('Income3'));

        $invItems_expenses = INV_Items_expenses::find($id);
        return view('invItems_expenses.edit', compact('invItems_expenses'));
    }
    public function update(Request $request,  $id)
    {
        $inv = INV_Items_expenses::find($id);
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

        return redirect('/invItems_expenses/' . $inv->detail_id)->with('success', ' update successfully');
    }
    public function destroy($id)

    {
        INV_Items_expenses::find($id)->delete();
        return back()->with('success', 'Product_subdata deleted successfully');
    }
}
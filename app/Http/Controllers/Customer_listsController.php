<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Customer_lists;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class Customer_listsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_lists = Customer_lists::latest()->paginate();
    
        return view('customer_lists.index',compact('customer_lists'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
     public function create()
    {
        return view('customer_lists.create');
    }

    
    public function create004($id)
    {
        return view('customer_lists.create',compact('id'));

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
            'price' => 'required',
            'note' => 'required',
            'address'=>'required',
            'id_customer_lists' => 'required',
        ]);
    

        Customer_lists::create($request->all());

        return redirect('/customer_lists/'.$request->id_customer_lists)
                    ->with('success',' create successfully');

        // Customer_lists::create($request->all());
     
        // return redirect()->route('customer_lists.index')
        //                 ->with('success',' created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer_lists  $Customer_lists
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('customer_lists.show',compact('customer_lists'));

        $customerName = Post::find($id);
        $customer=DB::table('customer_lists')->where('id_customer_lists',$id)->paginate();
        return view('customer_lists.index',compact(['customer','id','customerName']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer_lists  $Customer_lists
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('customer_lists.edit',compact('Customer_lists'));

        // return response()->json($id);
        $customer_lists=Customer_lists::find($id);
        return view('customer_lists.edit',compact('customer_lists'));
    }

    
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
            'price' => 'required',
            'address'=>'required',
            'id_customer_lists' => 'required',
        ]);

        $request->input("note");
        Customer_lists::find($id)->update($request->all());
    
        // return redirect()->route('customer_lists.index')
        //                 ->with('success',' updated successfully');

        // Customer_lists::find($id)->update($request->all());
        $inv = Customer_lists::find($id); 
                        
        return redirect('/customer_lists/'.$inv->id_customer_lists);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer_lists  $Customer_lists
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer_lists $customer_lists , $id)
    {
        // $customer_lists->delete();
    
        // return redirect()->route('customer_lists.index')
        //                 ->with('success',' deleted successfully');

                        Customer_lists::find($id)->delete();
        // $product_subdatas->delete();
    
        return back()->with('success','Product_subdata deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Income2;
use App\Models\Income3;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Income3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income3s = Income3::latest()->paginate();
    
        return view('income3.index',compact('income3s'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
     public function create()
    {
        return view('income3.create');
    }

    public function create003($id)
    {
        //return response()->json($id);
        return view('income3.create',compact('id'));

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
            'id_income03_lists' => 'required',
            'image_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',        
        ]);

  
        $input = $request->all();

        // => $input['name', 'detail','date', ...]
      
        if ($image = $request->file('image_product')) {
            $destinationPath = 'image_product/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image_product'] = "$profileImage";
        }else{
            unset($input['image']);
        }

          
        Income3::create($input);
        // return redirect()->route('incomes.index')
        //                 ->with('success','Product created successfully.');
        // return back()->with('success','Product_subdata deleted successfully');
        
        return redirect('/income3/'.$input['id_income03_lists'])->with('success',' create successfully');

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
        return back()->with('success','Product_subdata deleted successfully');
    
        // Income3::create($request->all());
     
        // return redirect()->route('incomes.index')
        //                 ->with('success','Income3 created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income3  $Income3
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('income3.show',compact('Income3'));
        $income3Name = Income2::find($id);
        $income3=DB::table('income3s')->where('id_income03_lists',$id)->paginate();
        return view('income3.index',compact(['income3','id','income3Name']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income3  $Income3
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('income3.edit',compact('Income3'));

        $income3=Income3::find($id);
        return view('income3.edit',compact('income3'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income3  $Income3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $inv = income3::find($id); 
    
       // $request->validate([
       //     'name' => 'required',
      //      'detail' => 'required',
       //     'date' => 'required',
       //     'price' => 'required',
       //     'note' => 'required',
       // ]);

     
        $inv->name =$request->input("name");
        $inv->detail=$request->input("detail");
        $inv->date=$request->input("date");
        $inv->price=$request->input("price");


        $input = $request->all();

        if ($request->file('image_product')) {
            $image =$request->file('image_product');
            $destinationPath = 'image_product/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image_product'] = "$profileImage";
        }else{
            unset($input['image']);
        }     

        $inv->update($input);
        $inv->update();
        // return response()->json([
        //     'name' => $input['image_product'],
        // ]);
        
       
                        
       return redirect('/income3/'.$inv->id_income03_lists)->with('success',' update successfully');


       //-------------------------------------------------
    //    $post = income3::find($id);

    
    //    if($request->hasFile('image_product')){
    //     $request->validate([
    //       'image_product' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    //     ]);
    //     $path = $request->file('image_product')->store('public/image_product');
    //     $post->image = $path;
    // }

    // $post->save();
    //    return redirect('/income3/'.$post->id_income03_lists)->with('success',' update successfully');

       //-------------------------------------------------

        // return redirect('/income3/'.$input['id_income03_lists'])->with('success',' update successfully');

        // return redirect()->route('incomes.index')
        //                 ->with('success','Post updated successfully');

        // return back()->with('success','Product_subdata deleted successfully');
        
        // income3::find($id)->update($request->all());
        

        // $Income3->update($request->all());
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income3  $Income3
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    
    {
        Income3::find($id)->delete();
        return back()->with('success','Product_subdata deleted successfully');
    }


    
    
}
<?php
    
namespace App\Http\Controllers;
    
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\support\Facades\DB;
use Charts;

    
class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'date' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
    

        // public function search(Request $product)
        // {
        //     $search = $product->get('search');
        //     $products = DB::table('products')->where('name','like','%'.$search.'%')->paginate(5);
        
        //     // return view('products.index',compact('products'));
        //     // return response()->json($products ) ;
        //     // return view('/products.index', compact('products'));
        //     return view('products.index',['products' => 'products']);
        // }
    // }

    function search(){

       
        // if( isset($_GET['query']) && strlen($_GET['query']) > 1){

        //     $search_text = $_GET['query'];
        //     $countries = DB::table('country')->where('Name','LIKE','%'.$search_text.'%')->paginate(2);
        //     // $countries->appends($request->all());
        //     return view('search',['countries'=>$countries]);
            
        // }else{
        //      return view('search');
        // }
        return view('welcome');
       
    }

    function find(Request $request){
            $request->validate([
              'query'=>'required|min:2'
           ]);
  
           $search_text = $request->input('query');
           $product = DB::table('products')
                      ->where('name','LIKE','%'.$search_text.'%')
                    //   ->orWhere('SurfaceArea','<', 10)
                    //   ->orWhere('LocalName','like','%'.$search_text.'%')
                      ->paginate(2);
                    //   return response()->json($product ) ;
            return view('welcome',['products'=>$product]);

    }

   


}
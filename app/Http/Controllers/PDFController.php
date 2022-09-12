<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer_lists;
use PDF;

class PDFController extends Controller
{
    // public function pdf()
    // {
    //     $posts = Post::all();
    //     $pdf = PDF::loadView('pdf', ['posts' => $posts]);
    //     return @$pdf->stream(); 
    //     // return $pdf->download('test.pdf');
    // return @$pdf->stream(); 
    // }

    public function pdf($id)
    {
        // $product_subdatas = Product_subdata::all();
        $Customer_lists = customer_lists::where('id_customer_lists',$id)->get();
        $pdf = PDF::loadView('pdf', ['Customer_lists' => $Customer_lists]);
        return @$pdf->stream(); 
        // return $pdf->download('test.pdf');

        
    }

    
}

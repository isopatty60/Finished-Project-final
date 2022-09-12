<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income2;
use PDF;

class PDFIncome2Controller extends Controller
{
   // public function pdf()
    // {
    //     $posts = Post::all();
    //     $pdf = PDF::loadView('pdf', ['posts' => $posts]);
    //     return @$pdf->stream(); 
    //     // return $pdf->download('test.pdf');
    // }

    public function pdfIncome2($id)
    {
        // $product_subdatas = Product_subdata::all();
        $income2s = Income2::where('id_income02_lists',$id)->get();
        $PDFIncome2 = PDF::loadView('PDFIncome2', ['income2s' => $income2s]);
        return @$PDFIncome2->stream(); 

        
    }

    
}
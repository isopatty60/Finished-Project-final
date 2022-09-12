<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income2;
use App\Models\Income3;
use Illuminate\support\Facades\DB;

use PDF;

class PDFIncome3Controller extends Controller
{
   // public function pdf()
    // {
    //     $posts = Post::all();
    //     $pdf = PDF::loadView('pdf', ['posts' => $posts]);
    //     return @$pdf->stream(); 
    //     // return $pdf->download('test.pdf');
    // }

    public function pdfIncome3($id)
    {
      
        // $product_subdatas = Product_subdata::all();
        
        $income3s = Income3::where('id_income03_lists',$id)->get();
        $income3Name = Income2::find($id);
        $pdfIncome3 = PDF::loadView('pdfIncome3', ['income3s' => $income3s, 'income3Name' => $income3Name]);
       
       
        return @$pdfIncome3->stream(); 
        // dd($income3s);
        // return $pdfIncome3->download('test.pdf');

        

        
    }

    
}
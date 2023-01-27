<?php

namespace App\Http\Controllers;

use App\Models\invDetails;
use PDF;

class PDFinvDetailsController extends Controller
{
    // public function pdf()
    // {
    //     $posts = Post::all();
    //     $pdf = PDF::loadView('pdf', ['posts' => $posts]);
    //     return @$pdf->stream();
    //     // return $pdf->download('test.pdf');
    // }

    public function PDFInvDetails($id)
    {
        $invDetails = invDetails::where('Month_id', $id)->get();
        $invDetailsName = invDetails::find($id);
        $pdfinvDetails = PDF::loadView('pdfInvDetails', ['invDetails' => $invDetails, 'invDetailsName' => $invDetailsName]);
        return @$pdfinvDetails->stream();
    }
}
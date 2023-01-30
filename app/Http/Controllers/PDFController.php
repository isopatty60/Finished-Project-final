<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invReceiptDetails;
use App\Models\invReceiptLists;
use PDF;

class PDFController extends Controller
{
    public function pdf($id)
    {
        $invDetailsName = invReceiptLists::find($id);
        $invReceiptDetails = invReceiptDetails::where('Receipt_lists_id', $id)->get();
        $pdf = PDF::loadView('pdf', ['inv_receipt_details' => $invReceiptDetails , 'invDetailsName' => $invDetailsName]);
        return @$pdf->stream();
    }
}

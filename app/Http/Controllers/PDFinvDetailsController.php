<?php

namespace App\Http\Controllers;

use App\Models\invDetails;
use App\Models\InvMonths;

use PDF;

class PDFinvDetailsController extends Controller
{
    public function PDFInvDetails($id)
    {
        $invDetails = invDetails::where('Month_id', $id)->get();
        $invDetailsName = InvMonths::find($id);
        $pdfinvDetails = PDF::loadView('pdfInvDetails', ['invDetails' => $invDetails, 'invDetailsName' => $invDetailsName]);
        return @$pdfinvDetails->stream();
    }
}
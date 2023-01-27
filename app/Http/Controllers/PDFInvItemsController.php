<?php

namespace App\Http\Controllers;

use App\Models\invDetails;
use App\Models\invItems;
use Illuminate\support\Facades\DB;


use PDF;

class PDFInvItemsController extends Controller
{
    public function pdfInvItems($id)
    {
        $invItems = invItems::where('detail_id', $id)->get();
        $invDetailsName = invDetails::find($id);
        $pdfinvItems = PDF::loadView('pdfInvItems', ['invItems' => $invItems, 'invDetailsName' => $invDetailsName]);
        return @$pdfinvItems->stream();
    }
}
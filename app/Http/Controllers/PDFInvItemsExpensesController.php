<?php

namespace App\Http\Controllers;

use App\Models\invDetailExpenses;
use App\Models\invItemExpenses;
use Illuminate\support\Facades\DB;
use PDF;

class PDFInvItemsExpensesController extends Controller
{
    public function pdfInvItemExpenses($id)
    {
        $invItemExpenses = invItemExpenses::where('detail_expenses_id', $id)->get();
        $invDetailsName = invDetailExpenses::find($id);
        $pdfInvItemsExpenses = PDF::loadView('pdfInvItemsExpenses', ['invItemExpenses' => $invItemExpenses, 'invDetailsName' => $invDetailsName]);
        return @$pdfInvItemsExpenses->stream();
    }
}
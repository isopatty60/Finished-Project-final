<?php

namespace App\Http\Controllers;

use App\Models\invDetailExpenses;
use App\Models\invMonthExpenses;


use PDF;

class PDFinvDetailExpensesController extends Controller
{
    public function pdfInvDetailExpenses($id)
    {
        $invDetailExpenses = invDetailExpenses::where('month_expenses_id', $id)->get();
        $invDetailsName = invMonthExpenses::find($id);
        $pdfinvDetailExpenses = PDF::loadView('pdfinvDetailsExpenses', ['invDetailExpenses' => $invDetailExpenses, 'invDetailsName' => $invDetailsName]);
        return @$pdfinvDetailExpenses->stream();
    }
}
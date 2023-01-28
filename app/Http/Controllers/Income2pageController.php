<?php

namespace App\Http\Controllers;

use App\Models\InvMonths;
use App\Models\invDetails;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;


class Income2pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income2page = invDetails::latest()->paginate();

        return view('income2page.index', compact('income2page'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
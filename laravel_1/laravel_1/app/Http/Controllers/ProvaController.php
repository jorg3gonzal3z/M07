<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvaController extends Controller
{

    public function prova()
    {
        //$users = App\Users::all();
        $users = DB::table('users')->get();

        return view('prova', compact('users'));
    }
}

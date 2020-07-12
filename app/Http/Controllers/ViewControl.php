<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PubCompany;
use App\Book;
use App\Writer;
use App\CompBookWriter;

class ViewControl extends Controller
{

    public function index()
    {
        $clicks = DB::table('books')->orderBy('clicks', 'desc')->take(6)->get();
        return view('index', compact('clicks'));
    }

    public function writer()
    {
        return view('writers');
    }

    public function book()
    {
        return view('books');
    }

    public function pub()
    {
        return view('pub');
    }
}

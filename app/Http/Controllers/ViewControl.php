<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PubCompany;
use App\Book;
use App\Writer;
use App\CompBookWriter;

class ViewControl extends Controller
{

    public function index()
    {
        return view('index');
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

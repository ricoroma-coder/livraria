<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PubCompany;
use App\Book;
use App\Writer;
use App\CompBookWriter;
require_once __DIR__."/../../Functions.php";

class ViewControl extends Controller
{

    public function index()
    {
        $books = Book::prepareToIndex();
        $pubs = PubCompany::prepareToIndex();
        $writers = Writer::prepareToIndex();

        return view('index', compact('books', 'pubs', 'writers'));
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

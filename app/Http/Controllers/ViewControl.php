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

        $content = [
            'books' => $books,
            'pubs' => $pubs,
            'writers' => $writers
        ];

        return view('index', compact('content'));
    }

    public function writer()
    {
        $content = Writer::prepareToIndex('all');
        return view('writers', compact('content'));
    }

    public function book()
    {
        $content = Book::prepareToIndex('all');
        return view('books', compact('content'));
    }

    public function pub()
    {
        $content = PubCompany::prepareToIndex('all');
        return view('pub', compact('content'));
    }
}

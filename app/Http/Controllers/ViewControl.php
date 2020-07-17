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

    public function showPub($id) {
        $obj = PubCompany::find($id);
        $obj->clicks+=1;
        $obj->save();
        $obj = PubCompany::newById($id);
        $content = [
            'obj' => $obj,
            'books' => Book::getAll()->where('id_pub', $id)
        ];

        $modify = false;

        $content['obj']->getSlogan();
        $content['obj']->getAddress();
        $extends = 'layout.main';
        return view('pub_company.show', compact('content', 'modify', 'extends'));
    }

    public function showBook($id) {

        $obj = Book::find($id);
        $obj->clicks++;
        $obj->save();
        $obj = Book::newById($id);
        $content = [
            'obj' => $obj,
            'pub' => PubCompany::newById($obj->id_pub),
            'writer' => Writer::newById($obj->id_writer)
        ];

        $modify = false;
        $extends = 'layout.main';
        return view('book.show', compact('content','modify','extends'));
    }

    public function showWriter($id) {
        $obj = Writer::find($id);
        $obj->clicks+=1;
        $obj->save();
        $obj = Writer::newById($id);
        $content = [
            'obj' => $obj,
            'books' => Book::getAll()->where('id_writer', $id)
        ];

        $modify = false;
        $extends = 'layout.main';
        return view('writer.show', compact('content', 'modify', 'extends'));
    }
}

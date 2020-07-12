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
        $clicks = DB::table('books')->orderBy('clicks', 'desc')->take(6)->get();
        $writers_hall = DB::table('writers')->get();
        $array = [];
        foreach ($writers_hall as $value) {
            $array[] = [
                'obj' => $value,
                'count' => DB::table('books')->where('id_writer', $value->id)->count()
            ];
        }
        $array = orderArraysByKey($array, 'count');
        $writers_hall = maxIndex($array, 3);
        return view('index', compact('clicks', 'writers_hall'));
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

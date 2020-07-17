<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Writer;
use App\PubCompany;
use DB;

class DashControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function ajaxSearch(Request $request) {
        $content = [];
        $get = $request->input();

        foreach ($get['require'] as $value) {
            $route = '';
            $collection = DB::table($value)->select('id', 'name', 'rate')->where('name', 'like', '%'.$get['content'].'%')->get();
            foreach ($collection as $v) {
                if ($value == 'pub_companies')
                    $v->route = 'dashPubs '.$v->id;
                else if ($value == 'books')
                    $v->route = 'dashBooks '.$v->id;
                else if ($value == 'writers')
                    $v->route = 'dashWriters '.$v->id;
            }
            $content[] = $collection;
        }

        return json_encode($content);
    }

    public function redirect(Request $request) {
        $route = $request->input('route');
        $id = $request->input('id');

        return route($route.'.show', $id);
    }

    public function search(Request $request, $require) {
        $modify = $request->input('modify');

        $data = explode(' ', $require);
        $content = [];
        $obj = '';

        foreach ($data as $value) {
            $route = '';
            $collection = DB::table($value)->select('id')->where('name', 'like', '%'.$request->input('search').'%')->get();
            foreach ($collection as $v) {
                if ($value == 'pub_companies') {
                    $obj = PubCompany::newById($v->id);
                    $obj->route = 'dashPubs';
                    $obj->class = 'Editora';
                    $obj->imgDefault = 'pubs';
                }
                else if ($value == 'books') {
                    $obj = Book::newById($v->id);
                    $obj->route = 'dashBooks';
                    $obj->class = 'Livro';
                    $obj->imgDefault = $value;
                }
                else if ($value == 'writers') {
                    $obj = Writer::newById($v->id);
                    $obj->route = 'dashWriters';
                    $obj->class = 'Escritor';
                    $obj->imgDefault = $value;
                }
                $content[] = $obj;
            }
            
        }


        return view('search-content', compact('content', 'modify'));
    }

    public function searchContent($content, $modify) {
        return view('search-content');
    }

}

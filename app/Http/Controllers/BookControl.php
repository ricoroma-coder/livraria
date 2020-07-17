<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\PubCompany;
use App\Writer;

class BookControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = [
            'books' => Book::getAll(true),
            'writers' => Writer::all(),
            'pubs' => PubCompany::all()
        ];
        return view('book.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $content = [
            'writers' => Writer::all(),
            'pubs' => PubCompany::all()
        ];
        return view('book.register', compact('content'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'isbn' => 'required|integer|unique:users',
            'year' => 'required|integer',
            'id_writer' => 'required',
            'id_pub' => 'required'
        ]);
        $post = $request->input();
        unset($post['_token']);
        $obj = new Book();
        $obj->clicks = 0;
        $obj->rate = 0;
        foreach ($post as $key => $value) {
            $obj->$key = $value;
        }
        $obj->save();
        if (!empty($request->file('image'))) {
            $request->file('image')->storeAs(
                '/public/img/books/'.$obj->id.'/', 'thumb.jpg'
            );
        }
        
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = Book::find($id);
        $obj->clicks++;
        $obj->save();
        $obj = Book::newById($id);
        $content = [
            'obj' => $obj,
            'pub' => PubCompany::newById($obj->id_pub),
            'writer' => Writer::newById($obj->id_writer)
        ];

        $modify = true;
        $extends = 'layout.dash_main';
        return view('book.show', compact('content','modify','extends')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = [
            'book' => Book::newById($id),
            'writers' => Writer::all(),
            'pubs' => PubCompany::all()
        ];

        return view('book.register', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'isbn' => 'required|integer|unique:users',
            'year' => 'required|integer',
            'id_writer' => 'required',
            'id_pub' => 'required'
        ]);
        $put = $request->input();
        unset($put['_token']);
        unset($put['_method']);
        $obj = Book::find($id);
        foreach ($put as $key => $value) {
            $obj->$key = $value;
        }
        if (!empty($request->file('image'))) {
            $request->file('image')->storeAs(
                '/public/img/books/'.$obj->id.'/', 'thumb.jpg'
            );
        }
        $obj->save();
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Book::newById($id);
        if (!empty($obj->image)){

            if (!$obj->removeImage()) {
                return 'Não foi possível deletar a imagem';
            }

        }
        if ($obj->forceDelete())
            return true;
        else
         return false;
    }

    public function rating(Request $request, $id) {

        $obj = Book::find($id);
        foreach ($request->input() as $value) {
            $rate = $value;
        }
        $rate = ($rate + $obj->rate) / 2;
        $obj->rate = number_format($rate, 1, '.', ' ');
        $obj->save();

        $rate = ($obj->rate/4)*100; 
        $status = ['rate' => $rate];
        if ($status['rate'] == 0) {
            $status['rate'] = 100;
            $status['title'] = 'Sem classificação';
            $status['bg'] = 'bg-light text-dark';
        }
        else if ($status['rate'] <= 25) {
            $status['title'] = 'Ruim';
            $status['bg'] = 'bg-danger';
        }
        else if ($status['rate'] <= 50) {
            $status['title'] = 'Razoável';
            $status['bg'] = 'bg-warning';
        }
        else if ($status['rate'] <= 75) {
            $status['title'] = 'Bom';
            $status['bg'] = 'bg-success';
        }
        else {
            $status['title'] = 'Muito bom';
            $status['bg'] = 'bg-primary';
        }

        return json_encode($status);

    }
}

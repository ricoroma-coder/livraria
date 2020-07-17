<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Writer;
use App\Book;
use DB;
use Illuminate\Support\Facades\Storage;

class WriterControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = Writer::getAll(true);
        return view('writer.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('writer.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->input();
        unset($post['_token']);
        $obj = new Writer();
        $obj->clicks = 0;
        $obj->rate = 0;
        foreach ($post as $key => $value) {
            $obj->$key = $value;
        }
        $obj->save();
        if (!empty($request->file('image'))) {
            $request->file('image')->storeAs(
                '/public/img/writers/'.$obj->id.'/', 'thumb.jpg'
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
        $obj = Writer::find($id);
        $obj->clicks+=1;
        $obj->save();
        $obj = Writer::newById($id);
        $content = [
            'obj' => $obj,
            'books' => Book::getAll()->where('id_writer', $id)
        ];

        return view('writer.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Writer::newById($id);
        return view('writer.register', compact('content'));
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
        $put = $request->input();
        unset($put['_token']);
        unset($put['_method']);
        $obj = Writer::find($id);
        foreach ($put as $key => $value) {
            $obj->$key = $value;
        }
        if (!empty($request->file('image'))) {
            $request->file('image')->storeAs(
                '/public/img/writers/'.$obj->id.'/', 'thumb.jpg'
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
        $obj = Writer::newById($id);
        if (!empty($obj->image)){

            if (!$obj->removeImage()) {
                return 'Não foi possível deletar a imagem';
            }

        }

        $query = DB::table('books')->where('id_writer', $obj->id)->get();
        foreach ($query as $value) {
            $book = Book::newById($value->id);
            if (!empty($book->image)){

                if (!$book->removeImage()) {
                    return 'Não foi possível deletar a imagem';
                }
    
            }
            $book->forceDelete();
        }

        if ($obj->forceDelete())
            return true;
        else
         return false;
    }

    public function rating(Request $request, $id) {

        $obj = Writer::find($id);
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

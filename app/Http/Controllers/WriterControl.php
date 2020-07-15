<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Writer;
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
        //
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
        if ($obj->forceDelete())
            return true;
        else
         return false;
    }
}

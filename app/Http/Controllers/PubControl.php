<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PubCompany;

class PubControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = PubCompany::getAll(true);
        return view('pub_company.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pub_company.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request->input();
        unset($content['_token']);
        $slogan = $content['slogan'];
        $address = $content['address'];
        unset($content['slogan']);
        unset($content['address']);
        // var_dump($content);
        $aux = '';
        if (!empty($slogan))
            $aux = $aux.'SLOGAN:'.$slogan.'S/';
        if (!empty($address))
            $aux = $aux.'ADDRESS:'.$address.'A/';
        $content['description'] = $aux.$content['description'];
        // echo $content['description'];
        $obj = new PubCompany();
        $obj->clicks = 0;
        $obj->rate = 0;
        foreach($content as $k => $v){
            $obj->$k = $v;
        }
        $obj->save();
        if (!empty($request->file('image'))) {
            $request->file('image')->storeAs(
                '/public/img/pubs/'.$obj->id.'/', 'thumb.jpg'
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
        $content = PubCompany::newById($id);
        
        $content->getSlogan();
        $content->getAddress();
        return view('pub_company.register', compact('content'));
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
        $slogan = $put['slogan'];
        $address = $put['address'];
        unset($put['slogan']);
        unset($put['address']);
        $aux = '';
        if (!empty($slogan))
            $aux = $aux.'SLOGAN:'.$slogan.'S/';
        if (!empty($address))
            $aux = $aux.'ADDRESS:'.$address.'A/';
        $put['description'] = $aux.$put['description'];
        $obj = PubCompany::find($id);
        foreach ($put as $key => $value) {
            $obj->$key = $value;
        }
        if (!empty($request->file('image'))) {
            $request->file('image')->storeAs(
                '/public/img/pubs/'.$obj->id.'/', 'thumb.jpg'
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
        $obj = PubCompany::newById($id);
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

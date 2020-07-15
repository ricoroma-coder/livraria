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
        $aux = '';
        if (!empty($slogan))
            $aux = $aux.'SLOGAN:'.$slogan.'S/';
        if (!empty($address))
            $aux = $aux.'ADDRESS:'.$address.'A/';
        $content['description'] = $aux.$content['description'];
        var_dump($content);
        exit;
        $p = new Produto();
        foreach($prod as $k => $v){
            $p->$k = $v;
        }
        $p->save();
        return redirect(route('produtos'));
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

        $content->description = "SLOGAN: Temos de Tudo!S/ADDRESS: Rua das AmoreirasA/Somos uma empresa de publicação de livros!";
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

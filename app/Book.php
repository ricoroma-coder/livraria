<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
require_once __DIR__."/Functions.php";

class Book extends Model
{
    use SoftDeletes;

    public function prepareToIndex() {
        // clicks
        $clicks = DB::table('books')->orderBy('clicks', 'desc')->take(6)->get();

        //hall
        $hall = DB::table('books')->get();
        $array = [];
        foreach ($hall as $value) {
            $array[] = [
                'obj' => $value,
                'count' => DB::table('books')->where('id_writer', $value->id)->count()
            ];
        }
        $array = orderArraysByKey($array, 'count');
        $hall = maxIndex($array, 3);

        //rank
        $clicks = DB::table('books')->orderBy('rate', 'desc')->take(6)->get();
    }
}

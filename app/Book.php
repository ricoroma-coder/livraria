<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
require_once __DIR__."/Functions.php";

class Book extends Model
{
    use SoftDeletes;

    public static function prepareToIndex() {
        // clicks
        $clicks = DB::table('books')->orderBy('clicks', 'desc')->take(6)->get();

        //rank
        $rank = DB::table('books')->orderBy('rate', 'desc')->take(6)->get();

        //hall
        $hall = Book::fillHall($rank);

        return compact('clicks','hall','rank');
    }

    public static function fillHall ($objects) {
        $array = [];
        foreach ($objects as $value) {
            $array[] = $value['clicks'] + $value['rate'];
        }
        $array = orderArrayValues($array);
        $hall = maxIndex($array, 3);

        return $hall;
    }

}

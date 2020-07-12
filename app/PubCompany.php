<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class PubCompany extends Model
{
    use SoftDeletes;

    public static function prepareToIndex() {
        // clicks
        $clicks = DB::table('pub_companies')->orderBy('clicks', 'desc')->take(6)->get();

        //hall
        $hall = PubCompany::fillHall();

        //rank
        $rank = DB::table('pub_companies')->orderBy('rate', 'desc')->take(6)->get();

        return compact('clicks','hall','rank');
    }

    public static function fillHall () {
        $hall = DB::table('pub_companies')->get();
        $array = [];
        foreach ($hall as $value) {
            $array[] = [
                'obj' => $value,
                'count' => DB::table('books')->where('id_pub', $value->id)->count()
            ];
        }
        $array = orderArraysByKey($array, 'count');
        $hall = maxIndex($array, 3);

        return $hall;
    }
}

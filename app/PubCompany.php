<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Storage;

class PubCompany extends Model
{
    use SoftDeletes;

    public static function getAll() {
        $collection = PubCompany::all();

        foreach ($collection as $value) {
            $path = 'img/pubs/'.$value->id.'/thumb.jpg';
            if (Storage::disk('public')->exists($path))
                $value->image = asset('/storage/'.$path);
            else
                $value->image = asset('/storage/img/pubs/thumb-default.jpg');
        }

        return $collection;

    }

    public static function prepareToIndex() {
        $pubs = PubCompany::getAll();

        $rank = $pubs->sortByDesc('rate')->all();
        $rank = maxIndex($rank, 6);

        $hall = PubCompany::fillHall();

        $clicks = $pubs->sortByDesc('rate')->all();
        $clicks = maxIndex($clicks, 6);

        return compact('clicks','hall','rank');
    }

    public static function fillHall () {
        $objs = PubCompany::all();

        foreach ($objs as $value) {
            $value->count = DB::table('books')->where('id_pub', $value->id)->count();
        }

        $hall = $objs->sortByDesc('count')->all();
        $hall = maxIndex($hall, 3);

        return $hall;
    }
}

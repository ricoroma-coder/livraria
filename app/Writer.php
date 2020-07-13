<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Storage;

class Writer extends Model
{
    use SoftDeletes;

    public static function getAll() {
        $collection = Writer::all();

        foreach ($collection as $value) {
            $path = 'img/writers/'.$value->id.'/thumb.jpg';
            if (Storage::disk('public')->exists($path))
                $value->image = asset('/storage/'.$path);
            else
                $value->image = asset('/storage/img/writers/thumb-default.jpg');
        }

        return $collection;

    }

    public static function prepareToIndex() {
        $writers = Writer::getAll();

        $rank = $writers->sortByDesc('rate')->all();
        $rank = maxIndex($rank, 6);

        $hall = Writer::fillHall($writers);

        $clicks = $writers->sortByDesc('rate')->all();
        $clicks = maxIndex($clicks, 6);

        return compact('clicks','hall','rank');
    }

    public static function fillHall ($all) {
        foreach ($all as $value) {
            $value->count = DB::table('books')->where('id_writer', $value->id)->count();
        }

        $hall = $all->sortByDesc('count')->all();
        $hall = maxIndex($hall, 3);

        return $hall;
    }
}

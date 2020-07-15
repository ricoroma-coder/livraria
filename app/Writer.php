<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Storage;

class Writer extends Model
{
    use SoftDeletes;

    public static function newById($id) {
        $collection = Writer::find($id);

        $path = 'img/writers/'.$collection->id.'/thumb.jpg';
        if (Storage::disk('public')->exists($path))
            $collection->image = asset('/storage/'.$path);

        return $collection;
    }

    public static function getAll($trashed = false) {
        if (!$trashed)
            $collection = Writer::all();
        else
            $collection = Writer::withTrashed()->get();

        foreach ($collection as $value) {
            $path = 'img/writers/'.$value->id.'/thumb.jpg';
            if (Storage::disk('public')->exists($path))
                $value->image = asset('/storage/'.$path);
            else
                $value->image = asset('/storage/img/writers/thumb-default.jpg');
        }

        return $collection;

    }

    public static function prepareToIndex($current = 'main') {
        $all = Writer::getAll();

        $rank = $all->sortByDesc('rate')->all();
        $rank = maxIndex($rank, 6);

        $hall = Writer::fillHall($all);

        $clicks = $all->sortByDesc('rate')->all();
        $clicks = maxIndex($clicks, 6);

        if ($current == 'main')
            return compact('clicks','hall','rank');
        else
            return compact('all','hall','rank');
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

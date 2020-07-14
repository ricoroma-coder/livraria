<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Storage;

class PubCompany extends Model
{
    use SoftDeletes;

    public static function getAll($trashed = false) {
        if (!$trashed)
            $collection = PubCompany::all();
        else
            $collection = PubCompany::withTrashed();

        foreach ($collection as $value) {
            $path = 'img/pubs/'.$value->id.'/thumb.jpg';
            if (Storage::disk('public')->exists($path))
                $value->image = asset('/storage/'.$path);
            else
                $value->image = asset('/storage/img/pubs/thumb-default.jpg');
        }

        return $collection;

    }

    public static function prepareToIndex($current = 'main') {
        $all = PubCompany::getAll();

        $rank = $all->sortByDesc('rate')->all();
        $rank = maxIndex($rank, 6);

        $hall = PubCompany::fillHall($all);

        $clicks = $all->sortByDesc('rate')->all();
        $clicks = maxIndex($clicks, 6);

        if ($current == 'main')
            return compact('clicks','hall','rank');
        else
            return compact('all','hall','rank');
    }

    public static function fillHall ($all) {
        foreach ($all as $value) {
            $value->count = DB::table('books')->where('id_pub', $value->id)->count();
        }

        $hall = $all->sortByDesc('count')->all();
        $hall = maxIndex($hall, 3);

        return $hall;
    }
}

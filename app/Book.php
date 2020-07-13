<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Storage;

require_once __DIR__."/Functions.php";

class Book extends Model
{
    use SoftDeletes;

    public static function getAll() {
        $collection = Book::all();

        foreach ($collection as $value) {
            $path = 'img/books/'.$value->id.'/thumb.jpg';
            if (Storage::disk('public')->exists($path))
                $value->image = asset('/storage/'.$path);
            else
                $value->image = asset('/storage/img/books/thumb-default.jpg');
        }

        return $collection;

    }

    public static function prepareToIndex($current = 'main') {
        $all = Book::getAll();

        $rank = $all->sortByDesc('rate')->take(6);

        $hall = Book::fillHall($all);

        $clicks = $all->sortByDesc('clicks')->take(6);

        if ($current == 'main')
            return compact('clicks','hall','rank');
        else
            return compact('all','hall','rank');
    }

    public static function fillHall ($objects) {
        foreach ($objects as $value) {
            $value->count = ($value->rate/$value->clicks)*100;
        }
        $hall = $objects->sortByDesc('count')->take(3);

        return $hall;
    }

}

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

    public static function prepareToIndex() {
        $books = Book::getAll();

        $rank = $books->sortByDesc('rate')->all();
        $rank = maxIndex($rank, 6);

        $hall = Book::fillHall($rank);

        $clicks = $books->sortByDesc('rate')->all();
        $clicks = maxIndex($clicks, 6);

        return compact('clicks','hall','rank');
    }

    public static function fillHall ($objects) {
        $array = [];
        foreach ($objects as $value) {
            $array[] = $value->clicks + $value->rate;
        }
        $array = orderArrayValues($array);
        $hall = maxIndex($array, 3);

        return $hall;
    }

}

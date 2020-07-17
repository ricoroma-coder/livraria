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

    public static function newById($id) {
        $collection = Book::find($id);

        $path = 'img/books/'.$collection->id.'/thumb.jpg';
        if (Storage::disk('public')->exists($path))
            $collection->image = asset('/storage/'.$path);

        return $collection;
    }

    public static function getAll($trashed = false) {
        if (!$trashed)
            $collection = Book::all();
        else
            $collection = Book::withTrashed()->get();

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

    public function removeImage() {
        $path = explode('storage', $this->image)[1];

        if (Storage::disk('public')->exists($path)) {
            if (Storage::disk('public')->delete($path)){
                $aux = explode('/', $path);
                array_pop($aux);
                $aux = implode('/', $aux);
                Storage::disk('public')->deleteDirectory($aux);
            }
            else {
                return "Não foi possível excluír a imagem";
                exit;
            }
        }

        return true;
    }

    public static function countDate() {
        $today = date('d');
        $thisMonth = date('m');
        $accToday = 0;
        $accMonth = 0;

        foreach (Book::all() as $value) {
            $aux = explode(' ', $value->created_at)[0];
            $day = explode('-', $aux)[2];
            $month = explode('-', $aux)[1];
            if ($day == $today)
                $accToday++;
            if ($month == $thisMonth)
                $accMonth++;
        }

        return [$accToday, $accMonth, Book::all()->count()];
    }

}

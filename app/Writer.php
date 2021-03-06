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

        $clicks = $all->sortByDesc('clicks')->all();
        $clicks = maxIndex($clicks, 6);

        $lasts = $all->sortByDesc('created_at')->take(3);

        if ($current == 'main')
            return compact('clicks','hall','rank','lasts');
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

        foreach (Writer::all() as $value) {
            $aux = explode(' ', $value->created_at)[0];
            $day = explode('-', $aux)[2];
            $month = explode('-', $aux)[1];
            if ($day == $today)
                $accToday++;
            if ($month == $thisMonth)
                $accMonth++;
        }

        return [$accToday, $accMonth, Writer::all()->count()];
    }
}

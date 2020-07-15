<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Storage;

class PubCompany extends Model
{
    use SoftDeletes;

    public static function newById($id) {
        $collection = PubCompany::find($id);

        $path = 'img/pubs/'.$collection->id.'/thumb.jpg';
        if (Storage::disk('public')->exists($path))
            $collection->image = asset('/storage/'.$path);

        return $collection;
    }

    public static function getAll($trashed = false) {
        if (!$trashed)
            $collection = PubCompany::all();
        else
            $collection = PubCompany::withTrashed()->get();

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

    public function getSlogan() {
        if (!empty($this->description)) {
            if (strstr($this->description, "SLOGAN:")) {
                $start = strpos($this->description, ":")+1;
                $end = strpos($this->description, "/")-1;
                $end -= $start;
                $this->slogan = substr($this->description, $start, $end);
                $this->description = str_replace("SLOGAN:".$this->slogan."S/", "", $this->description);
            }
            else
                $this->slogan = "";
        }
    }

    public function getAddress() {
        if (!empty($this->description)) {
            if (strstr($this->description, "ADDRESS:")) {
                $start = strpos($this->description, ":")+1;
                $end = strpos($this->description, "/")-1;
                $end -= $start;
                $this->address = substr($this->description, $start, $end);
                $this->description = str_replace("ADDRESS:".$this->address."A/", "", $this->description);
            }
            else
                $this->address = "";
        }
    }
}

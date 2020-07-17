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

        foreach (PubCompany::all() as $value) {
            $aux = explode(' ', $value->created_at)[0];
            $day = explode('-', $aux)[2];
            $month = explode('-', $aux)[1];
            if ($day == $today)
                $accToday++;
            if ($month == $thisMonth)
                $accMonth++;
        }

        return [$accToday, $accMonth, PubCompany::all()->count()];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Groups extends Model
{
    use HasFactory;

    public function getGroups() {
        $groups = DB::table('groups')
        ->orderBy('position', 'ASC')
        ->get();

        return $groups;
    }
}

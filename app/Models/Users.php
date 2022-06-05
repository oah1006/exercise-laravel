<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use DB;

class Users extends Model
{
    use HasFactory;

    public function getUsers() {
        return DB::table('users')
        ->select('users.*', 'groups.position as position')
        ->join('groups', 'users.group_id', '=', 'groups.id')
        ->orderBy('update_at', 'ASC')
        ->get();


    }

    public function getID($id) {
        return DB::table('users')
        ->select('users.id')
        ->where('id', $id)
        ->first();
    }

    public function addUser($data) {
        return DB::table('users')->insert($data);
    }

    public function getDetails($id) {
        return DB::table('users')
            ->select('users.*')
            ->where('id', $id)
            ->get();
    }

    public function updateUser($data, $id) {
        return DB::table('users')
                ->where('id', $id)
                ->update($data); 
    }

    public function deleteUser($id) {
        return DB::table('users')
                ->where('id', $id)
                ->delete();
    }
}

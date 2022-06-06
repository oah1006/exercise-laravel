<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use DB;

class Users extends Model
{
    use HasFactory;

    public function getUsers($filter = [], $keywords = null, $sortByArr = null) {
        $users = DB::table('users')
        ->select('users.*', 'groups.position as position')
        ->join('groups', 'users.group_id', '=', 'groups.id');

        $orderBy = 'users.update_at';
        $ordertype = 'DESC';

        if (! empty($sortByArr) && is_array($sortByArr)) {
            if (! empty($sortByArr['sortBy']) && ! empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $ordertype = trim($sortByArr['sortType']);
            }
        }

        $users = $users->orderBy($orderBy, $ordertype);

        if ($filter) {
            $users = $users->where($filter);
        }

        if ($keywords) {
            $users = $users->where(function ($query) use ($keywords) {
                $query->orWhere('fullname', 'like', '%'. $keywords .'%');
                $query->orWhere('email', 'like', '%'. $keywords .'%');
            });
        }

        $users = $users->get();

        return $users;      
    }

    public function getUser($id) {
        return DB::table('users')
        ->select('users.*')
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

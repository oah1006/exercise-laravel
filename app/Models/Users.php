<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Users extends Model
{
    use HasFactory;

    public function getUsers($filter = [], $keywords = null, $sortByArr = null, $perPage = null) {
        $users = DB::table('users')
        ->select('users.*', 'roles.role as role_name')
        ->join('roles', 'users.role_id', '=', 'roles.id', 'left outer');

        $orderBy = 'users.updated_at';
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
                $query->orWhere('name', 'like', '%'. $keywords .'%');
                $query->orWhere('email', 'like', '%'. $keywords .'%');
            });
        }
 
        // $users = $users->get();

        if($perPage) {
            $users = $users->paginate($perPage);
        } else {
            $users = $users->get();
        }
        
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

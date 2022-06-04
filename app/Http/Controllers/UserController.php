<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use DB;

class UserController extends Controller
{


    public function index() {
        $title = 'List Users';

        $usersList = DB::table('users')
        ->select('users.*', 'groups.position as position')
        ->join('groups', 'users.group_id', '=', 'groups.id')
        ->orderBy('update_at', 'ASC')
        ->get();

        return View('list-user', compact('title', 'usersList'));
    }

    public function add() {
        $title = 'Add Users';

        return view('components.users.add', compact('title'));
    }

    public function postAdd(UserRequest $request) {
        $addUsers = DB::table('users')->insert([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'state' => $request->state,
            'update_at' => date('Y-m-d H:i:s')
        ]);


        return redirect()->route('users.index')->with('msg', 'Add user successfully!');
    }

    public function getEdit(Request $request, $id = null) {
        $title = 'Edit Users';

        if (! empty($id)) {
            $users = DB::table('users')
            ->select('users.*')
            ->where('id', $id);
        } else {
            return redirect()->route('users.index')->with('msg', 'Users don\'t exist! Please select a new user!');

        }

        return view('components.users.edit', compact('title', 'users'));
    }

    public function update(UserRequest $request, $id = null) {
        DB::table('users')
        ->insert([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'group_id' => $request->group_id,
                'state' => $request->state,
                'update_at' => date('Y-m-d H:i:s')
        ], 
        DB::table('users')->select(
            'users.*'
        )->where('id', '=', $id));

        return back()->with('msg', 'Update user successfully!');
    }
}

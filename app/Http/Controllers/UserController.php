<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use App\Models\Groups;
use DB;

class UserController extends Controller
{
    public function __construct() {
        $this->users = new Users();
        $this->groups = new Groups();
    }

    public function index() {
        $title = 'List Users';

        $usersList = $this->users->getUsers();

        return View('list-user', compact('title', 'usersList'));
    }

    public function add() {
        $title = 'Add Users';

        $allGroups = $this->groups->getGroups();

        return view('components.users.add', compact('title', 'allGroups'));
    }

    public function postAdd(UserRequest $request) {
        $data = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'state' => $request->state,
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->users->addUser($data);
        
        return redirect()->route('users.index')->with('msg', 'Add user successfully!');
    }

    public function getEdit(Request $request, $id = null) {
        $title = 'Edit Users';

        if (! empty($id)) {
            $users = $this->users->getDetails($id);
            if (! empty($users)) {
                $request->session()->put('id', $id);
                $users = $users[0];
            } else {
                return redirect()->route('users.index')->with('msg', 'User does not exist!');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Users don\'t exist! Please select a new user!');
        }

        $allGroups = $this->groups->getGroups();
        $idUser = $this->users->getID($id);

        return view('components.users.edit', compact('title', 'users', 'allGroups', 'idUser'));
    }

    public function update(UserRequest $request, $id = null) {
        $id = session('id');

        if (empty($id)) {
            return back()->with('msg', 'User does not exist!');
        }

        $dataUpdate = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'state' => $request->state,
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->users->updateUser($dataUpdate, $id);


        return back()->with('msg', 'Update user successfully!');
    }

    public function delete($id = null) {

        if (! empty($id)) {
            $usersDetail = $this->users->getDetails($id);
            if (! empty($usersDetail)) {
                $deleteUser = $this->users->deleteUser($id);
                    
                if ($deleteUser) {
                    $msg = "Delete user successfully";
                } else {
                    $msg = "You don't delete the user. Please try again later!";
                }
            } else {
                $msg = "User don't have exits. Please try again later!";
            } 
        } else {
            $msg = "User don't have exits. Please try again later!";
        }

        return redirect()->route('users.index')->with('msg', $msg);
    }
}

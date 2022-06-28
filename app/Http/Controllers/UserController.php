<?php

namespace App\Http\Controllers;

use DB;

use App\Models\Users;
use App\Models\Roles;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    const _PER_PAGE = 3;

    public function __construct() {
        $this->users = new Users();
        $this->roles = new Roles();
    }

    public function index(Request $request) {
        $title = 'List Users';

        $filter = [];

        $keywords = null;


        // search state
        if ($request->state) {
            $state = $request->state;

            
            if ($state == 'active') {
                $state = 1;
            } else {
                $state = 0;
            }

            $filter[] = [
                'users.state', '=', $state
            ];
        }


        // search roles
        if ($request->role_id) {
            $roleId = $request->role_id;

            $filter[] = [
                'users.role_id', '=', $roleId
            ];
        }

        // search keywords
        if ($request->keywords) {
            $keywords = $request->keywords;

        }

        // Logic sort
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');

        $allowSort = ['ASC', 'DESC'];

        if (! empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'ASC') {
                $sortType = 'DESC';
            } else {
                $sortType = 'ASC';
            }
        } else {
            $sortType = 'ASC';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];

        

        $usersList = $this->users->getUsers($filter, $keywords, $sortArr, self::_PER_PAGE);
        $allRoles = $this->roles->getRoles();


        if (Auth::check()) {
            return View('list-user', compact('title', 'usersList', 'allRoles', 'sortType'));
        } else {
            return redirect()->route('auth.login');
        }
    }

    public function add() {
        $title = 'Add Users';

        $allRoles = $this->roles->getRoles();

        return view('components.users.add', compact('title', 'allRoles'));
    }

    public function postAdd(UserRequest $request) {
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'state' => $request->state,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->users->addUser($data);
        
        return redirect()->route('users.index')->with('msg', 'Add user successfully!');
    }

    public function getUpdate(Request $request, $id = null) {
        $title = 'Edit Users';

        if ($id) {
            $users = $this->users->getDetails($id);
        } else {
            return redirect()->route('users.index')->with('msg', 'Users don\'t exist! Please select a new user!');
        }

        $allRoles = $this->roles->getRoles();
        $user = $this->users->getUser($id);

        return view('components.users.update', compact('title', 'users', 'allRoles', 'user'));
    }

    public function update(UpdateUserRequest $request, $id = null) {
        $dataUpdate = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'state' => $request->state,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
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

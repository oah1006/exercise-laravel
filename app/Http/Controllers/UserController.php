<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
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


        // search groups
        if ($request->group_id) {
            $groupId = $request->group_id;

            $filter[] = [
                'users.group_id', '=', $groupId
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

        

        $usersList = $this->users->getUsers($filter, $keywords, $sortArr);
        $allGroups = $this->groups->getGroups();


        return View('list-user', compact('title', 'usersList', 'allGroups', 'sortType'));
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

    public function getUpdate(Request $request, $id = null) {
        $title = 'Edit Users';

        if ($id) {
            $users = $this->users->getDetails($id);
        } else {
            return redirect()->route('users.index')->with('msg', 'Users don\'t exist! Please select a new user!');
        }

        $allGroups = $this->groups->getGroups();
        $user = $this->users->getUser($id);

        return view('components.users.update', compact('title', 'users', 'allGroups', 'user'));
    }

    public function update(UpdateUserRequest $request, $id = null) {
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $title = 'List Users';

        return View('list-user', compact('title'));
    }

    public function add() {
        $title = 'Add Users';

        return view('components.users.add', compact('title'));
    }

    public function postAdd(UserRequest $request) {
        dd($request);
    }
}

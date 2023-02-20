<?php

namespace App\Http\Controllers;

use App\Models\DSDivision;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //User list function
    public function index()
    {

        $userList = DB::table('users')
            ->join('d_s_divisions', 'users.ds_division', '=', 'd_s_divisions.division_id')
            ->get();

        $divisionList = DSDivision::all();

        return view('accura_member_list', compact('userList', 'divisionList'));

    }

    //User insert view
    public function insert()
    {

        $divisionList = DSDivision::all();

        return view('accura_add_member', compact('divisionList'));

    }

    //User create function
    public function create(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'ds_division' => 'required',
            'dob' => 'required',
            'summary' => 'required|string|uppercase',
        ]);

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'ds_division' => $request['ds_division'],
            'dob' => $request['dob'],
            'summary' => $request['summary'],
        ]);

        return redirect('/');

    }

    //User delete function
    public function delete($userId)
    {

        $response = DB::delete('delete from users where id = ?', [$userId]);

        return $response;
    }

    //User edit function
    public function edit($id)
    {

        $divisionList = DSDivision::all();

        $user = DB::table('users')
            ->join('d_s_divisions', 'users.ds_division', '=', 'd_s_divisions.division_id')
            ->where('users.id', '=', $id)
            ->get();

        return view('accura_edit_member', compact('user', 'divisionList'));
    }

    //User update function
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'ds_division' => 'required',
            'dob' => 'required',
            'summary' => 'required|string|uppercase',
        ]);

        $user = User::where('id', $request['id'])->firstOrFail();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->ds_division = $request->input('ds_division');
        $user->dob = $request->input('dob');
        $user->summary = $request->input('summary');
        $user->save();

        return redirect('/');
    }

    //User search function
    public function search(Request $request)
    {
        $divisionList = DSDivision::all();
        $userList = DB::table('users')
            ->join('d_s_divisions', 'users.ds_division', '=', 'd_s_divisions.division_id')
            ->where('last_name', 'LIKE', '%' . $request['search'] . "%")->get();

        return view('accura_member_list', compact('userList', 'divisionList'))->withDetails($userList)->withQuery($request['search']);

    }
}

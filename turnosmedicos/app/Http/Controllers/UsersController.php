<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Role;

use DB;
use \Carbon\Carbon;
use Input, Redirect, Validator, Session;

class UsersController extends Controller
{
    public function usersnroles(Request $request)
    {
        $request->get('role_id')? $role_id = $request->get('role_id') : $role_id = 0;
        $roles = Role::orderBy('display_name')->lists('display_name', 'id')->prepend('--Todos--', 0);

        if($role_id != 0){
            $users = User::orderBy('name')->whereIn('id', function($query) use($role_id){
                        $query->select(DB::raw('user_id'))
                            ->from('role_user')
                            ->where('role_id', '=', $role_id);
                    })->get();
        }else{
            $users = User::orderBy('name')->get();
        }

        Carbon::setLocale('es');
        setlocale(LC_TIME, config('app.locale'));

        return view('auth.roles.index', ['users' => $users, 'roles' => $roles, 'role_id' => $role_id]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('display_name')->get();

        return view('auth.roles.create_user', ['roles' => $roles]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'email' => 'email|max:255|unique:users',
            'dni'   => 'required|numeric|min:6',
            'password' => 'required|min:6',
        );
        $input = $request->all();
        $input['password'] = bcrypt('123456');
        $validator = Validator::make($input, $rules);

        // process the errors
        if ($validator->fails()) {
            return Redirect::to('/users/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            DB::transaction(function () use ($request, $input) {
                $user = User::create($input);

                $role_admin = Role::where('name', '=', 'admin')->first();
                $user->attachRole($role_admin);
            });
            Session::flash('flash_message', 'Alta de usuario exitosa!');

            return redirect('/usersnroles');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();

        return redirect('usersnroles');
    }
}

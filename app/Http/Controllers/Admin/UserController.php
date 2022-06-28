<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = [
            'users' => User::all(),
        ];

        return view('dashboard.users.index',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if($request->hasFile('image')){
            $image = upload_image($request->file('image'),'users');
        }
        $password = Hash::make($request->password);
        User::create(array_merge($request->validated(), ['image' => $image, 'password' => $password  ]));
        return redirect()->route('dashboard.users.index')->with(['err'=>'0','alert'=>[
            'icon'  =>'success',
            'title' =>'Success',
            'text'  =>'User Added successfully',
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $input = [
            'user' => $user
        ];
        return view('dashboard.users.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $image = $user->image;
        $password = !is_null($request->password) ? Hash::make($request->password) : $user->password;
        if($request->hasFile('image')){
            if(!is_null($user->image)){
                file_exists(base_path($user->image)) ? unlink(base_path($user->image)) : '';
            }
            $image = upload_image($request->file('image'),'users');
        }


        $user->update(array_merge($request->validated(), ['image'=> $image, 'password' => $password ]));
        return redirect()->route('dashboard.users.index')->with(['err'=>'0','alert'=>[
            'icon'  =>'success',
            'title' =>'Success',
            'text'  =>'User Updated successfully',
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();
            return response()->json(['err'=>'0','alert'=>[
                'icon'  => 'success',
                'title' => 'Deleted',
                'text'  => 'User Deleted Successfully',
            ]]);
        }catch(Exception $e){
            return response()->json(['err'=>'1','alert'=>[
                'icon'  => 'error',
                'title' => 'Failed!',
                'text'  => $e->getMessage(),
            ]]);
        }
    }
}

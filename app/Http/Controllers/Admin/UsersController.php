<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin/users/index')->with('users', $users);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin/users/edit')->with('user', $user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $checkEmailExists=User::where([['email',$request->email],['id',"!=",$id]])->first();

        if($checkEmailExists){
            session()->flash('emailExists','ايميل قبلا انتخاب شده است');
            return back();
        }

        $user=User::findOrFail($id);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role
        ]);

        session()->flash('success','اطلاعات كاربر با موفقيت ويرايش گرديد');
        return redirect(route('users.index'));

    }

    public function destroy($id){
        $user=User::findOrFail($id);
        $user->delete();
        session()->flash('success','كاربر با موفقيت حذف گرديد');
        return redirect(route('users.index'));
    }
}

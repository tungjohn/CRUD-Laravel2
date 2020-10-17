<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $sort = $request->query('sort', '');
        $searchKeyword = $request->query('name', '');

        $queryORM = AdminModel::where('name', "LIKE", "%".$searchKeyword."%");

        if ($sort == "name_asc")
        {
            $queryORM->orderBy('name', 'asc');
        }

        if ($sort == "name_desc")
        {
            $queryORM->orderBy('name', 'desc');
        }
        $admins = $queryORM->paginate(10);

        $data = [];
        $data['admins'] = $admins;
        $data['sort'] = $sort;
        $data['searchKeyword'] = $searchKeyword;

        return view('backend.admins.index', $data);
        
    }

    public function create()
    {
        return view('backend.admins.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|unique:admins',
            'avatar'                => 'required',
            'password'              => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'desc'                  => 'required'
        ]);
        
        $name = $request->input('name', '');
        $email = $request->input('email', '');
        $password = $request->input('password', '');
        $desc = $request->input('desc', '');
        $pathAvatar = $request->file('avatar')->store('public/adminimages');

        $admin = new AdminModel();

        $admin->name = $name;
        $admin->email = $email;
        $admin->password = Hash::make($password);
        $admin->desc = $desc;

        $admin->avatar = $pathAvatar;

        $admin->save();

        return redirect('backend/admins/index')->with('status', 'Thêm admin thành công!');
    }

    public function edit($id)
    {
        $admin = AdminModel::findOrFail($id);

        $data = [];
        $data['admin'] = $admin;

        return view('backend.admins.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name', '');
        $email = $request->input('email', '');
        $password = $request->input('password', '');

        if (strlen($password) > 0) {

            $validatedData = $request->validate([
                'name'                  => 'required',
                'email'                 => 'required',
                'password'              => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'required|min:6',
                'desc'                  => 'required'
            ]);
        } else {
            $validatedData = $request->validate([
                'name'  => 'required',
                'email' => 'required',
                'desc'  => 'required'
            ]);
        }

        $desc = $request->input('desc', '');

        $admin = AdminModel::findOrFail($id);

        $admin->name    = $name;
        $admin->email   = $email;

        if (strlen($password) > 0) {
            $admin->password = Hash::make($password);
        }

        $admin->desc = $desc;
        //upload
        if ($request->hasFile('avatar')) {
            if ($admin->avatar) {
                Storage::delete($admin->avatar);
            }

            $pathAvatar = $request->file('avatar')->store('public/adminimages');

            $admin->avatar = $pathAvatar;
        }

        $admin->save();

        return redirect("/backend/admins/index")->with('status', 'Cập nhật admin thành công');
    }
    public function delete($id)
    {
        $data = [];
        $admin = AdminModel::findOrFail($id);

        $data['admin'] = $admin;
        return view('backend.admins.delete', $data);
    }

    public function destroy($id)
    {
        $admin = AdminModel::findOrFail($id);
        $admin->delete();

        return redirect("/backend/admins/index")->with('status', 'xóa admin thành công');
    }

}

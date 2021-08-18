<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function AdminProfile($id) {
        $adminData = Admin::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function EditAdminProfile($id) {
        $dataToEdit = Admin::find($id);
        return view('admin.admin_profile_edit', compact('dataToEdit'));
    }

    public function StoreAdminProfile(Request $request, $id) {
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
//        store image
        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
//            remove old image to store new one
            if (Admin::find($id)->profile_photo_path) {
                @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            }
            $filename = date('YmdHi').$file->getClientOriginalExtension();
//            upload file to public folder
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
//
        $data->save();
//        add toaster notification message
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect('admin/profile/'.$id)->with($notification);
    }

    public function AdminChangePassword() {
        return view('admin.admin_change_password');
    }

    public function UpdateChangePassword(Request $request, $id) {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed|',
        ]); // end method

        $hashedOldPassword = Admin::find($id)->password;
        if(Hash::check($request->oldpassword, $hashedOldPassword)) {
            $admin = Admin::find($id);
            $admin->password = Hash::make($request->password);
            $admin->save();
//            log out admin after change password successfully
            Auth::logout();
//            add toaster notification
            return redirect()->route('admin.logout');
        } else {
            $notification = [
                'message' => 'Password Not Update Successfully',
                'alert-type' => 'warning'
            ];
            return redirect()->back()->with($notification);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('CEO.index');
    }

    public function CeoAddMember()
    {
        return view('CEO.addmember');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function AdminLogin()
    {
        return view('login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('ymdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }

    public function AdminUpdatePassword(Request $request)
    {
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = [
                'message' => 'Old password does not match',
                'alert-type' => 'error',
            ];
            return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'message' => 'Password changed successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);
    }

    public function AdminChat()
    {
        return view('admin.chat');
    }

    public function AdminPosts()
    {
        return view('admin.posts');
    }

    public function AdminAddMember()
    {
        return view('admin.addmember');
    }

    public function AdminShowMember()
    {
        $types = User::latest()->get();
        return view('CEO.showmember', compact('types'));
    }

    public function Adminshowallemployeeforpayrole()
    {
        $types = User::latest()->get();
        return view('CEO.showallemployeeforpayrole', compact('types'));
    }

    public function AdminStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users|max:200',
            'email' => 'required|email|unique:users|max:255',
            'gender' => 'required|string',
            'password' => 'required',
            'employment_type' => 'required|string|max:50',
            'role' => 'required|string|max:50',
            'employment_date' => 'required|string|max:50',
            'basic_salary' => 'required|string|max:50',
            'bank_account_number' => 'required|string|max:50',
       
            'status' => 'required|string',
        ]);

        // Handle photo upload


        // Create user with photo path
        User::create([
            'name' => $request->name,
            'email' => $request->email,
        
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        
            'employment_type' => $request->employment_type,
            'role' => $request->role,
            'employment_date' => $request->employment_date,
            'basic_salary' => $request->basic_salary,
            'bank_account_number' => $request->bank_account,
        
            
            'status' => $request->status,
        ]);

        $notification = [
            'message' => 'New member created successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('CEO.showmember')
            ->with($notification);
    }

    public function AdminEditMember($id)
    {
        $types = User::findOrFail($id);
        return view('CEO.edit_member', compact('types'));
    }

    public function AdminUpdateMember(Request $request)
    {
        $pid = $request->id;
        print $pid;

        User::findOrFail($pid)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing the password
            'gender' => $request->gender,
            'photo' => $request->photo,
            'phone' => $request->phone,
            'collage' => $request->collage,
            'department' => $request->department,
            'address' => $request->address,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        $notification = [
            'message' => 'Member Profile is Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('admin.showmember')
            ->with($notification);
    }

    public function AdminDeleteMember($id)
    {
        User::findOrFail($id)->delete();

        $notification = [
            'message' => 'Member is Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    public function AdminStatusChange($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Toggle the status between active and inactive
        $user->update([
            'status' => $user->status == 'active' ? 'inactive' : 'active',
        ]);

        // Prepare a notification message
        $notification = [
            'message' => 'Member profile status updated successfully.',
            'alert-type' => 'success',
        ];

        // Redirect with notification
        return redirect()
            ->route('admin.showmember')
            ->with($notification);
    }


    public function AdminAddAgricultureExpert()
    {
        return view('admin.addagricultureexpert');
    }
}

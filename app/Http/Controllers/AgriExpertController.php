<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AgriExpertController extends Controller
{
    public function AgriExpertDashboard()
    {
        return view('agri_expert.index');
    }

    public function AgriExpertLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function AgriExpertLogin()
    {
        return view('login');
    }

    public function AgriExpertProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view(
            'agri_expert.agri_expert_profile_view',
            compact('profileData')
        );
    }

    public function AgriExpertProfileStore(Request $request)
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
            'message' => 'Collagedean profile Update Successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    public function AgriExpertChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view(
            'agri_expert.agri_expert_change_password',
            compact('profileData')
        );
    }

    public function AgriExpertUpdatePassword(Request $request)
    {
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = [
                'message' => 'Old Password does not match',
                'alert-type' => 'error',
            ];
            return back()->with($notification);
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'message' => 'Password Change Successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);
    }

    public function AgriExpertChat()
    {
        return view('agri_expert.agri_expertchat');
    }

    public function AgriExpertShowMember()
    {
        $types = User::latest()->get();
        return view('agri_expert.showmember', compact('types'));
    }

    //
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SalarySheat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CfoController extends Controller
{
    public function CfoDashboard()
    {
        return view('CFO.index');
    }

        public function Adminshowallemployeeforpayrole()
    {
        $types = User::latest()->get();
        return view('CFO.showallemployeeforpayrole', compact('types'));
    }

    public function CfoEditMember($id)
    {
        $types = User::findOrFail($id);
        return view('CFO.edit_member', compact('types'));
    }

    public function Calculatepayrole(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'employment_date' => 'required',
            'role' => 'required',
            'employment_type' => 'required',
            'basic_salary' => 'required',
            'work_day' => 'required',
            'position_allowance' => 'required',
            'transport_allowance' => 'required',
            'other_benefit' => 'required',
            'loan' => 'required',
        ]);

        SalarySheat::create([
            'name' => $request->name,
            'employment_date' => $request->employment_date,
            'role' => $request->role,
            'employment_type' => $request->employment_type,
            'basic_salary' => $request->basic_salary,
            'work_day' => $request->work_day,
            'position_allowance' => $request->position_allowance,
            'transport_allowance' => $request->transport_allowance,
            'other_benefit' => $request->other_benefit,
            'loan' => $request->loan,
    
        ]);


        $types = SalarySheat::latest()->get();

        $basicsalary= $request->basic_salary;

        $workday= $request->work_day;

        $earnedsalary =$workday*($basicsalary/30);

        SalarySheat::findOrFail($request->id)->update([
            'earned_salary' =>  $earnedsalary,

        ]);

        

        if($request->role=="CEO"){
            $x=$request->basic_salary*(10/100);

            if($request->position_allowance>$x ){
                $taxable_position_allowance = ($request->position_allowance-$x)*(35/100);
                $non_taxable_position_allowance =$request->position_allowance-$taxable_position_allowance;
            }
            else{
                $non_taxable_position_allowance=$request->position_allowance;
            }
        }
        else{
            $taxable_position_allowance=$request->position_allowance;
        }

        $earned_salary= $earnedsalary;
        $position_allowance= $request->non_taxable_position_allowance+  $request->taxable_position_allowance;
        $transport_allowance= $request->transport_allowance;
        $other_benefit= $request->other_benefit;

        $gross_pay =$earned_salary + $position_allowance + $transport_allowance + $other_benefit;
        
        SalarySheat::findOrFail($request->id)->update([
            'gross_pay' =>  $gross_pay,

        ]);

        // if($request->role=="CEO" ){
        //     $x=$request->basic_salary*(10/100)
        //     if($position_allowance>$x){
                
        //     }
        // }

    }

    public function Calculateearnedsalary()
    {
        $types = SalarySheat::latest()->get();

            $workday= $types->work_day;
            print($workday);

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

    public function CfoLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function CfoLogin()
    {
        return view('login');
    }

    public function CfoProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view(
            'agri_expert.agri_expert_profile_view',
            compact('profileData')
        );
    }



    public function CfoProfileStore(Request $request)
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

    public function CfoChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view(
            'agri_expert.agri_expert_change_password',
            compact('profileData')
        );
    }

    public function CfoUpdatePassword(Request $request)
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

    public function CfoChat()
    {
        return view('agri_expert.agri_expertchat');
    }

    public function CfoShowMember()
    {
        $types = User::latest()->get();
        return view('agri_expert.showmember', compact('types'));
    }

    //
}

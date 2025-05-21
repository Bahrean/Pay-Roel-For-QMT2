@extends('CEO.CEO_dashboard')
@section('CEO')

<div class="page-content">
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
        $gender = $profileData->gender === 'male' ? 'Mr.' : ($profileData->gender === 'female' ? 'Ms.' : '');
    @endphp

    <div class="d-flex flex-column align-items-start gap-3">
        <div class="welcome-section text-center mb-4">
            <h3 class="mb-2">
                Welcome to CEO Dashboard, {{$gender}} 
                <span style="color: yellow; font-size: 30px;">{{$profileData->name}}</span>
            </h3>
            
        </div>

    </div>
</div>

@endsection

@extends('admin.admin_dashboard')
@section('admin')

<style>
    .form-label{
        color:white;
        font-weight:bold;
        font-size:15px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content" style="margin-top:80px; ">

<div class="row profile-body">
  <!-- left wrapper start -->

  <!-- left wrapper end -->
  <!-- middle wrapper start -->
  <div class="col-md-10 col-xl-10 middle-wrapper" >
    <div class="row">
    <div class="card " style="background-color:#001B07">
    <div class="card-body ">
    <h4 class="card-title text-success mb-4" style="font-size: 1.75rem; font-weight: 600; color: #001F77;">
        <i class="fas fa-user-plus me-2"></i>Register New Agriculture Expert
    </h4>


    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('firebase.store') }}">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input style="background-color:#032E0E" type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input style="background-color:#032E0E" type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input style="background-color:#032E0E" type="text" class="form-control" id="password" name="password" required>
            </div>
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                    <select style="background-color:#032E0E" class="form-select @error('gender') is-invalid @enderror" name="gender">
                        <option value="" selected disabled>Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            <div class="mb-3">
                <label for="proffesion" class="form-label">Proffesion</label>
                <input style="background-color:#032E0E" type="text" class="form-control" id="proffesion" name="proffesion" required>
            </div>
            <div>
                <button style="font-weight:bold;font-size:20px;" type="submit" class="btn btn-success">Register Now</button>
            </div>
        </form>

</div>

<script>
    // Department Data (fixed typos)
    const departments = {
        'informatics': ['IT', 'IS', 'CS', 'Software'],
        'engineering': [
            'Architecture', 'Biomedical', 'Chemical', 'Civil', 'COTOM', 
            'Electrical', 'Fashion', 'Food', 'Garment', 'Hydraulics', 
            'Industrial', 'Leather', 'Mechanical', 'Mechatronics', 
            'Textile', 'Water and Irrigation'
        ]
    };

    // Dynamic Department Update
    document.addEventListener('DOMContentLoaded', function() {
        const collegeSelect = document.getElementById('collegeSelect');
        const deptSelect = document.getElementById('departmentSelect');
        
        function updateDepartments() {
            deptSelect.innerHTML = '<option value="" selected disabled>Select Department</option>';
            deptSelect.disabled = true;
            
            if (collegeSelect.value) {
                deptSelect.disabled = false;
                const savedDept = "{{ old('department') }}";
                
                departments[collegeSelect.value].forEach(dept => {
                    const option = new Option(dept, dept);
                    option.selected = (savedDept === dept);
                    deptSelect.add(option);
                });
            }
        }

        collegeSelect.addEventListener('change', updateDepartments);
        if ("{{ old('college') }}") updateDepartments();
    });

    // Password Toggle
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.querySelector('#password + button i');
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // File Input Label Update
    document.getElementById('photo').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Choose file';
        document.querySelector('.custom-file-label').textContent = fileName;
    });
</script>

<style>
    .form-floating label {
        padding-left: 2.5rem;
    }
    .form-floating i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    .custom-file-label {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        transition: transform 0.2s;
    }
    .btn-success:hover {
        transform: translateY(-2px);
    }
</style>
    
    </div>
  </div>
  <!-- middle wrapper end -->
  <!-- right wrapper start -->

  <!-- right wrapper end -->
</div>

    </div>


@endsection
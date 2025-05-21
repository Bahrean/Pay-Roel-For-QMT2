@extends('CEO.CEO_dashboard')
@section('CEO')

<style>
    .form-label{
        color:white;
        font-weight:bold;
        font-size:15px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content" style="margin-top:28px;">

<div class="row profile-body">
  <!-- left wrapper start -->

  <!-- left wrapper end -->
  <!-- middle wrapper start -->
  <div class="col-md-8 col-xl-8 middle-wrapper">
    <div class="row">
    <div class="card">
    <div class="card-body">
    <h4 class="card-title text-success mb-4" style="font-size: 1.75rem; font-weight: 600;">
        <i class="fas fa-user-plus me-2"></i>Register New Employee
    </h4>

    <form class="forms-sample" method="POST" action="{{route('admin.store')}}" enctype='multipart/form-data' novalidate>
        @csrf
        <div class="row g-4">
            <!-- Error Summary -->
            @if($errors->any())
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" placeholder=" " value="{{ old('name') }}" autofocus>
                    <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder=" " value="{{ old('email') }}">
                    <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                          <div class="mb-3">
                    <label class="form-label"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                    <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                        <option value="" selected disabled>Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-user-tag me-2"></i>employment_type</label>
                    <select class="form-select @error('employment_type') is-invalid @enderror" name="employment_type">
                        <option value="" selected disabled>Select employment_type</option>
                        <option value="CFO" {{ old('employment_type') == 'CFO' ? 'selected' : '' }}>CFO</option>
                        <option value="Part_time" {{ old('employment_type') == 'Part_time' ? 'selected' : '' }}>
                            Part Time
                        </option>

                    </select>
                    @error('employment_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder=" " style="padding-right: 65px;">
                    <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y" 
                            style="right: 10px;" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('basic_salary') is-invalid @enderror" 
                           id="basic_salary" name="basic_salary" placeholder=" " value="{{ old('basic_salary') }}">
                    <label for="basic_salary"><i class="fas fa-at me-2"></i>basic_salary</label>
                    @error('basic_salary')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

            </div>

            <!-- Right Column -->
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-user-tag me-2"></i>Role</label>
                    <select class="form-select @error('role') is-invalid @enderror" name="role">
                        <option value="" selected disabled>Select Role</option>CEO','CFO','COO','CTO','CISO','Director','Dept_Lead','Normal_Employee'])->default('Normal_Employee'
                        <option value="CEO" {{ old('role') == 'CEO' ? 'selected' : '' }}>CEO</option>
                        <option value="CFO" {{ old('role') == 'collage_dean' ? 'selected' : '' }}>
                            CEO
                        </option>
                        <option value="collage_registral" {{ old('role') == 'collage_registral' ? 'selected' : '' }}>
                            College Registrar
                        </option>
                        <option value="department_head" {{ old('role') == 'department_head' ? 'selected' : '' }}>
                            Department Head
                        </option>
                        <option value="stuff" {{ old('role') == 'staff' ? 'selected' : '' }}>Stuff</option>
                    </select>
                    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control @error('bank_account_number') is-invalid @enderror" 
                           id="bank_account_number" name="bank_account_number" placeholder=" " value="{{ old('bank_account_number') }}">
                    <label for="bank_account_number"><i class="fas fa-bank_account_number me-2"></i>bank_account_number </label>
                    @error('bank_account_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-university me-2"></i>College</label>
                    <select class="form-select @error('college') is-invalid @enderror" 
                            id="collegeSelect" name="collage" required>
                        <option value="" selected disabled>Select College</option>
                        <option value="informatics" {{ old('college') == 'informatics' ? 'selected' : '' }}>
                            Informatics
                        </option>
                        <option value="engineering" {{ old('college') == 'engineering' ? 'selected' : '' }}>
                            Engineering
                        </option>
                    </select>
                    @error('college')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

            



                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-user-tag me-2"></i>Role</label>
                    <select class="form-select @error('role') is-invalid @enderror" name="role">
                        <option value="" selected disabled>Select Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="CFO" {{ old('role') == 'collage_dean' ? 'selected' : '' }}>
                            College Dean
                        </option>
                        <option value="collage_registral" {{ old('role') == 'collage_registral' ? 'selected' : '' }}>
                            College Registrar
                        </option>
                        <option value="department_head" {{ old('role') == 'department_head' ? 'selected' : '' }}>
                            Department Head
                        </option>
                        <option value="stuff" {{ old('role') == 'staff' ? 'selected' : '' }}>Stuff</option>
                    </select>
                    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-toggle-on me-2"></i>Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                        <option value="" selected disabled>Select Status</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <button type="submit" class="btn btn-success btn-lg px-4">
                <i class="fas fa-user-plus me-2"></i>Register Employee
            </button>
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
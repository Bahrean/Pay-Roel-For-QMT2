@extends('CFO.CFO_dashboard')
@section('CFO')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <!-- Middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Insert PayRoll Information Of Employee</h6>

                        <form class="forms-sample" method="POST" action="{{ route('cfo.calculatepayrole') }}" enctype="multipart/form-data">
                            @csrf	
                            <input type="hidden" name="id" value="{{ $types->id }}">

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name', $types->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Employment Date</label>
                                <input type="text" class="form-control @error('employment_date') is-invalid @enderror" name="employment_date" placeholder="employment_date" value="{{ old('employment_date', $types->employment_date) }}">
                                @error('employment_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control @error('role') is-invalid @enderror" name="role" placeholder="role" value="{{ old('role', $types->role) }}">
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">employment_type</label>
                                <input type="text" class="form-control @error('employment_type') is-invalid @enderror" name="employment_type" placeholder="employment_type" value="{{ old('employment_type', $types->employment_type) }}">
                                @error('employment_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">basic_salary</label>
                                <input type="text" class="form-control @error('basic_salary') is-invalid @enderror" name="basic_salary" placeholder="basic_salary" value="{{ old('basic_salary', $types->basic_salary) }}">
                                @error('basic_salary')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('work_day') is-invalid @enderror" 
                                    id="work_day" name="work_day" placeholder=" " value="{{ old('work_day') }}">
                                <label for="work_day"><i class="fas fa-work_day me-2"></i>Work Day </label>
                                @error('work_day')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('position_allowance') is-invalid @enderror" 
                                    id="position_allowance" name="position_allowance" placeholder=" " value="{{ old('position_allowance') }}">
                                <label for="position_allowance"><i class="fas fa-position_allowance me-2"></i>position_allowance </label>
                                @error('position_allowance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('transport_allowance') is-invalid @enderror" 
                                    id="transport_allowance" name="transport_allowance" placeholder=" " value="{{ old('transport_allowance') }}">
                                <label for="transport_allowance"><i class="fas fa-transport_allowance me-2"></i>Transport Allowance </label>
                                @error('transport_allowance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>


                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('other_benefit') is-invalid @enderror" 
                                    id="other_benefit" name="other_benefit" placeholder=" " value="{{ old('other_benefit') }}">
                                <label for="other_benefit"><i class="fas fa-other_benefit me-2"></i>Other Benefit </label>
                                @error('other_benefit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('loan') is-invalid @enderror" 
                                    id="loan" name="loan" placeholder=" " value="{{ old('loan') }}">
                                <label for="loan"><i class="fas fa-loan me-2"></i>Loan/Benefit </label>
                                @error('loan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                

                     

                            <!-- <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option disabled {{ old('gender', $types->gender) == '' ? 'selected' : '' }}>Select Gender</option>
                                    <option value="male" {{ old('gender', $types->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $types->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->

                            <!-- <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" placeholder="Photo" id="image">
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->

                            <!-- <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone" value="{{ old('phone', $types->phone) }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->

                            <!-- <div class="mb-3">
                                <label class="form-label">College</label>
                                <input type="text" class="form-control @error('collage') is-invalid @enderror" name="collage" placeholder="College" value="{{ old('collage', $types->collage) }}">
                                @error('collage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->
<!-- 
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" class="form-control @error('department') is-invalid @enderror" name="department" placeholder="Department" value="{{ old('department', $types->department) }}">
                                @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->

                            <!-- <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" value="{{ old('address', $types->address) }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->

                            <!-- <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option disabled {{ old('role', $types->role) == '' ? 'selected' : '' }}>Select Role</option>
                                    <option value="admin" {{ old('role', $types->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="collage_dean" {{ old('role', $types->role) == 'collage_dean' ? 'selected' : '' }}>Collage Dean</option>
                                    <option value="collage_registral" {{ old('role', $types->role) == 'collage_registral' ? 'selected' : '' }}>Collage Registral</option>
                                    <option value="department_head" {{ old('role', $types->role) == 'department_head' ? 'selected' : '' }}>Department Head</option>
                                    <option value="stuff" {{ old('role', $types->role) == 'stuff' ? 'selected' : '' }}>Staff</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->

                            <!-- <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" placeholder="Status" value="{{ old('status', $types->status) }}">
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->

                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Middle wrapper end -->
    </div>
</div>

@endsection

@extends('CFO.CFO_dashboard')
@section('CFO')

<div class="page-content" style="padding: 25px 15px;">

    <!-- Breadcrumb Navigation -->
    <!-- <nav class="page-breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#" class="btn btn-outline-success">
                    <i class="fas fa-user-plus"></i> All Employees
                </a>
            </li>
        </ol>
    </nav> -->

    <!-- Members Table Section -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="card-title text-center" style="color: yellow; font-size: 20px;">
                        <i class="fas fa-users"></i>Show All Employees
                    </h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background-color: #003f00;">
                                    <th style="font-size: 17px; color: white; font-weight: bold;">ID</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Name</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Email</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Gender</th>
                                    
                                    <th style="font-size: 17px; color: white; font-weight: bold;">employment_type</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">role</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">employment_date</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">basic_salary</th>  
                                    <th style="font-size: 17px; color: white; font-weight: bold;">bank_account</th>                                    
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Procced to PayRole</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $key => $items)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $items->name }}</td>
                                        <td>{{ $items->email }}</td>
                                        <td>{{ $items->gender }}</td>
                                        <td>{{ $items->employment_type }}</td>
                                        <td>{{ $items->role }}</td>
                                        <td>{{ $items->employment_date }}</td>
                                        <td>{{ $items->basic_salary }}</td>
                                        <td>{{ $items->bank_account }}</td>
                                        <td>
                                            <a href="{{ route('cfo.editmember', $items->id) }}" 
                                                    class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Payroll The Employeeser
                                            </a>
                                        </td>


                                        <!-- <td>
                                            <form action="{{ route('admin.editmember', $items->id) }}" method="POST">
                                            @csrf
                                                @if($items->status==='inactive')
                                                    <input class="btn btn-danger" type="submit" value="{{$items->status}}">
                                                @endif
                                                @if($items->status==='active')
                                                    <input class="btn btn-outline-success" type="submit" value="{{$items->status}}">
                                                @endif
                                            </form>  
                                        </td> -->
                                        <!-- <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.editmember', $items->id) }}" 
                                                    class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('admin.deletemember', $items->id) }}" 
                                                    class="btn btn-outline-danger btn-sm" id="delete">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td> -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

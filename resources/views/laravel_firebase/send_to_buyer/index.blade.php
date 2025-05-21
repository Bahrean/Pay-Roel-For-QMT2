
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content" style="padding: 25px 15px;">

    <!-- Members Table Section -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body" style="background-color:#001B07">
                    <h6 class="card-title text-center" style="color: #001F77; font-size: 25px;font-weight: bold;">
                        <i class="fas fa-users"></i> Sent to Agriculture Expert
                    </h6>

                    <div class="table-responsive">
                    @if($marketPrices)
                        <table id="dataTableExample" class="table table-bordered table-striped">
                            <thead style="background-color:#001F77">
                                <tr>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Title</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Description</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Status</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Created At</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($marketPrices as $firebaseKey => $price)
                                    <tr>
                                        <td>{{ $price['title'] ?? 'N/A' }}</td>
                                        <td>{{ $price['description'] ?? 'N/A' }}</td>
                                        <td>{{ $price['status'] ?? 'N/A' }}</td>
                                        <td>{{ $price['created_at'] ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('send_to_buyer.edit', $firebaseKey) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('send_to_buyer.destroy', $firebaseKey) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No market prices found in Firebase.</p>
                    @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

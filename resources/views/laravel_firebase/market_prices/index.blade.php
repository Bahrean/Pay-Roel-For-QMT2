@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content" style="padding: 25px 15px;">

    <!-- Members Table Section -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body" style="background-color:#001B07">
                    <h6 class="card-title text-center" style="color: #001F77; font-size: 25px;font-weight: bold;">
                        <i class="fas fa-users"></i> Show Recorded Market Price
                    </h6>

                    <div class="table-responsive">
                    @if($marketPrices)
                        <table id="dataTableExample" class="table table-bordered table-striped">
                            <thead style="background-color:#001F77">
                                <tr>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Item Name</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Price</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Market Location</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Date Recorded</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Created At</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($marketPrices as $firebaseKey => $price)
                                    <tr>
                                        <td>{{ $price['item_name'] ?? 'N/A' }}</td>
                                        <td>{{ isset($price['price']) ? number_format($price['price'], 2) : 'N/A' }}</td>
                                        <td>{{ $price['market_location'] ?? 'N/A' }}</td>
                                        <td>{{ $price['date_recorded'] ?? 'N/A' }}</td>
                                        <td>{{ $price['created_at'] ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('market-price.edit', $firebaseKey) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('market-price.destroy', $firebaseKey) }}" method="POST" style="display: inline;">
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

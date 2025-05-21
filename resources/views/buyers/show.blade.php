@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Buyer Details</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('buyers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Basic Information</h5>
                    <table class="table table-sm">
                        <tr>
                            <th>Username:</th>
                            <td>{{ $buyer->username }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $buyer->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $buyer->phone ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Additional Information</h5>
                    <table class="table table-sm">
                        <tr>
                            <th>Last Purchase:</th>
                            <td>{{ $buyer->last_purchase_at ? $buyer->last_purchase_at->format('M d, Y H:i') : 'Never' }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ $buyer->address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Synced At:</th>
                            <td>{{ $buyer->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
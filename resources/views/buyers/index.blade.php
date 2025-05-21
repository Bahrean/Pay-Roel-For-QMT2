@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Buyers Management</h1>
        </div>
        <div class="col-md-6 text-right">
            <form action="{{ route('buyers.sync') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sync-alt"></i> Sync from Firebase
                </button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Last Purchase</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buyers as $buyer)
                            <tr>
                                <td>{{ $buyer->username }}</td>
                                <td>{{ $buyer->email }}</td>
                                <td>{{ $buyer->phone }}</td>
                                <td>{{ $buyer->last_purchase_at ? $buyer->last_purchase_at->format('M d, Y H:i') : 'Never' }}</td>
                                <td>
                                    <a href="{{ route('buyers.show', $buyer->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $buyers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
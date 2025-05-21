@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content" style="padding: 25px 15px;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Market Price</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('send_to_farmer.update', $firebaseKey) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Item Name</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" 
                                    name="title" value="{{ old('title', $priceData['title'] ?? '') }}" required>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Market Location</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" 
                                    name="description" value="{{ old('description', $priceData['description'] ?? '') }}" required>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Market Location</label>
                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" 
                                    name="status" value="{{ old('status', $priceData['status'] ?? '') }}" required>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_recorded" class="col-md-4 col-form-label text-md-right">Date Recorded</label>
                            <div class="col-md-6">
                                <input id="date_recorded" type="date" class="form-control @error('date_recorded') is-invalid @enderror" 
                                    name="date_recorded" value="{{ old('date_recorded', $priceData['date_recorded'] ?? now()->format('Y-m-d')) }}" required>
                                @error('date_recorded')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Market Price
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
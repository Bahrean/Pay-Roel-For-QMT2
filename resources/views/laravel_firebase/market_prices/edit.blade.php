@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content" style="padding: 25px 15px;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Market Price</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('market-price.update', $firebaseKey) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="item_name" class="col-md-4 col-form-label text-md-right">Item Name</label>
                            <div class="col-md-6">
                                <input id="item_name" type="text" class="form-control @error('item_name') is-invalid @enderror" 
                                    name="item_name" value="{{ old('item_name', $priceData['item_name'] ?? '') }}" required>
                                @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                    name="price" value="{{ old('price', $priceData['price'] ?? 0) }}" required>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="market_location" class="col-md-4 col-form-label text-md-right">Market Location</label>
                            <div class="col-md-6">
                                <input id="market_location" type="text" class="form-control @error('market_location') is-invalid @enderror" 
                                    name="market_location" value="{{ old('market_location', $priceData['market_location'] ?? '') }}" required>
                                @error('market_location')
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
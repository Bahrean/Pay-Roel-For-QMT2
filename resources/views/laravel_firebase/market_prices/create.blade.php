@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content" style="padding: 25px 15px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card" style="background-color: #001B07; border: 1px solid #0A3A1C; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 75, 30, 0.3);">
                    <div class="card-header" style="background-color: #001B07; border-bottom: 1px solid #0A3A1C; padding: 15px 25px;">
                        <h4 class="mb-0" style="color: #4CAF50; font-weight: 600;">
                            <i class="fas fa-tags me-2"></i>Add New Market Price
                        </h4>
                    </div>

                    <div class="card-body" style="padding: 25px;">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color:#032E0E">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('market-price.store') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="item_name" class="form-label" style="color: #8ABE7F; font-weight: 500; margin-bottom: 8px;">
                                    <i class="fas fa-shopping-basket me-2"></i>Item Name
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #032E0E; border-color: #0A3A1C; color: #8ABE7F;">
                                        <i class="fas fa-tag"></i>
                                    </span>
                                    <input id="item_name" type="text" class="form-control @error('item_name') is-invalid @enderror" 
                                           name="item_name" value="{{ old('item_name') }}" required 
                                           style="background-color: #032E0E; border-color: #0A3A1C; color: #E0F7DA;"
                                           placeholder="Enter item name">
                                    @error('item_name')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="form-label" style="color: #8ABE7F; font-weight: 500; margin-bottom: 8px;">
                                    <i class="fas fa-money-bill-wave me-2"></i>Price (₦)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #032E0E; border-color: #0A3A1C; color: #8ABE7F;">
                                        ₦
                                    </span>
                                    <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                           name="price" value="{{ old('price') }}" required 
                                           style="background-color: #032E0E; border-color: #0A3A1C; color: #E0F7DA;"
                                           placeholder="0.00">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="market_location" class="form-label" style="color: #8ABE7F; font-weight: 500; margin-bottom: 8px;">
                                    <i class="fas fa-map-marker-alt me-2"></i>Market Location
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #032E0E; border-color: #0A3A1C; color: #8ABE7F;">
                                        <i class="fas fa-store"></i>
                                    </span>
                                    <input id="market_location" type="text" class="form-control @error('market_location') is-invalid @enderror" 
                                           name="market_location" value="{{ old('market_location') }}" required 
                                           style="background-color: #032E0E; border-color: #0A3A1C; color: #E0F7DA;"
                                           placeholder="Enter market location">
                                    @error('market_location')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="date_recorded" class="form-label" style="color: #8ABE7F; font-weight: 500; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt me-2"></i>Date Recorded
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #032E0E; border-color: #0A3A1C; color: #8ABE7F;">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    <input id="date_recorded" type="date" class="form-control @error('date_recorded') is-invalid @enderror" 
                                           name="date_recorded" value="{{ old('date_recorded', date('Y-m-d')) }}" required 
                                           style="background-color: #032E0E; border-color: #0A3A1C; color: #E0F7DA;">
                                    @error('date_recorded')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="reset" class="btn btn-outline-secondary me-md-2" style="border-color: #0A3A1C; color: #8ABE7F;">
                                    <i class="fas fa-undo me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success" style="background-color: #4CAF50; border-color: #4CAF50;">
                                    <i class="fas fa-save me-2"></i>Save Market Price
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        background-color: #032E0E;
        border-color: #4CAF50;
        color: #E0F7DA;
        box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
    }
    
    .form-control, .form-select {
        transition: all 0.3s ease;
    }
    
    .input-group-text {
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        background-color: #3D8B40;
        border-color: #3D8B40;
    }
</style>

<script>
    // Example of client-side validation
    (function() {
        'use strict';
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    
                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>
@endsection
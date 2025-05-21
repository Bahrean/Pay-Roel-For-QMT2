@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content" style="padding: 25px 15px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card" style="background-color: #001B07; border: 1px solid #0A3A1C; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 75, 30, 0.3);">
                    <div class="card-header" style="background-color: #001B07; border-bottom: 1px solid #0A3A1C; padding: 15px 25px;">
                        <h4 class="mb-0" style="color: #4CAF50; font-weight: 600;">
                            <i class="fas fa-paper-plane me-2"></i>Send Message to Farmer
                        </h4>
                    </div>

                    <div class="card-body" style="padding: 25px;">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #4CAF50; border-color: #4CAF50;">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('send_to_farmer.store') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="title" class="form-label" style="color: #8ABE7F; font-weight: 500; margin-bottom: 8px;">
                                    <i class="fas fa-heading me-2"></i>Message Title
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #032E0E; border-color: #0A3A1C; color: #8ABE7F;">
                                        <i class="fas fa-tag"></i>
                                    </span>
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" 
                                           name="title" value="{{ old('title') }}" required 
                                           style="background-color: #032E0E; border-color: #0A3A1C; color: #E0F7DA;"
                                           placeholder="Enter message title">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label" style="color: #8ABE7F; font-weight: 500; margin-bottom: 8px;">
                                    <i class="fas fa-align-left me-2"></i>Message Content
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text align-items-start" style="background-color: #032E0E; border-color: #0A3A1C; color: #8ABE7F; padding-top: 12px;">
                                        <i class="fas fa-comment-alt"></i>
                                    </span>
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" 
                                              name="description" required rows="4"
                                              style="background-color: #032E0E; border-color: #0A3A1C; color: #E0F7DA; resize: none;"
                                              placeholder="Enter your message content">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label" style="color: #8ABE7F; font-weight: 500; margin-bottom: 8px;">
                                    <i class="fas fa-info-circle me-2"></i>Status
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #032E0E; border-color: #0A3A1C; color: #8ABE7F;">
                                        <i class="fas fa-toggle-on"></i>
                                    </span>
                                    <select id="status" class="form-control @error('status') is-invalid @enderror" 
                                            name="status" required
                                            style="background-color: #032E0E; border-color: #0A3A1C; color: #E0F7DA;">
                                        <option value="" disabled selected>Select status</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                    @error('status')
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
                                    <i class="fas fa-undo me-2"></i>Clear Form
                                </button>
                                <button type="submit" class="btn btn-success" style="background-color: #4CAF50; border-color: #4CAF50;">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
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
    
    .form-control, .form-select, textarea {
        transition: all 0.3s ease;
    }
    
    .input-group-text {
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        background-color: #3D8B40;
        border-color: #3D8B40;
        transform: translateY(-1px);
    }
    
    .btn-outline-secondary:hover {
        background-color: #032E0E;
        color: #4CAF50 !important;
        border-color: #4CAF50;
    }
</style>

<script>
    // Client-side validation
    (function() {
        'use strict';
        
        var forms = document.querySelectorAll('.needs-validation');
        
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
    
    // Auto-resize textarea
    document.getElementById('description').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
</script>
@endsection
@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content" style="padding: 25px 15px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="background-color:#001B07; border: 1px solid #032E0E; border-radius: 10px; box-shadow: 0 10px 20px rgba(7, 22, 11, 0.3), 0 6px 6px rgb(0, 2, 0);">
                    <div class="card-header" style="background-color:#001B07; color: #fff; font-size: 1.2rem; padding: 15px 20px; border-bottom: 1px solid #032E0E; border-radius: 10px 10px 0 0; box-shadow: 0 2px 4px rgba(0, 40, 10, 0.1);">
                        Send to Buyer
                    </div>

                    <div class="card-body" style="padding: 30px;">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" style="margin-bottom: 25px; box-shadow: 0 4px 8px rgba(0, 100, 0, 0.1);">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('send_to_buyer.store') }}">
                            @csrf

                            <div class="form-group row mb-4">
                                <label for="title" class="col-md-4 col-form-label text-md-right" style="color: #fff; font-weight: 500; padding-top: 8px;">Title</label>

                                <div class="col-md-6">
                                    <input style="background-color:#032E0E; border: 1px solid #055C1F; color: #fff; height: 45px; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 60, 15, 0.3);" 
                                           id="title" type="text" class="form-control @error('title') is-invalid @enderror" 
                                           name="title" value="{{ old('title') }}" required autocomplete="title" autofocus
                                           placeholder="Enter title">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="description" class="col-md-4 col-form-label text-md-right" style="color: #fff; font-weight: 500; padding-top: 8px;">Description</label>

                                <div class="col-md-6">
                                    <textarea style="background-color:#032E0E; border: 1px solid #055C1F; color: #fff; height: 100px; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 60, 15, 0.3);" 
                                              id="description" class="form-control @error('description') is-invalid @enderror" 
                                              name="description" required autocomplete="description"
                                              placeholder="Enter detailed description">{{ old('description') }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="status" class="col-md-4 col-form-label text-md-right" style="color: #fff; font-weight: 500; padding-top: 8px;">Status</label>

                                <div class="col-md-6">
                                    <select style="background-color:#032E0E; border: 1px solid #055C1F; color: #fff; height: 45px; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 60, 15, 0.3);" 
                                            id="status" class="form-control @error('status') is-invalid @enderror" 
                                            name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="date_recorded" class="col-md-4 col-form-label text-md-right" style="color: #fff; font-weight: 500; padding-top: 8px;">Date Recorded</label>

                                <div class="col-md-6">
                                    <input style="background-color:#032E0E; border: 1px solid #055C1F; color: #fff; height: 45px; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 60, 15, 0.3);" 
                                           id="date_recorded" type="date" class="form-control @error('date_recorded') is-invalid @enderror" 
                                           name="date_recorded" value="{{ old('date_recorded', date('Y-m-d')) }}" required>

                                    @error('date_recorded')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-5">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="background-color: #055C1F; border: none; padding: 10px 25px; font-weight: 500; border-radius: 5px; transition: all 0.3s; box-shadow: 0 4px 8px rgba(0, 80, 20, 0.3);">
                                        Send to Agriculture Expert
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
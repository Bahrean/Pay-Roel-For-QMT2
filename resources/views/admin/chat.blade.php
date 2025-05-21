@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

			<div class="row chat-wrapper">
				<div class="col-md-12">
            @include('livewire.chat.index');
					</div>
				</div>
			</div>

@endsection
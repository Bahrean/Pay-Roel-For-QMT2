@extends('CEO.CEO_dashboard')
@section('CEO')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">


<div class="row profile-body" >
  <!-- left wrapper start -->
  <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper" >
    <div class="card rounded">
      <div class="card-body" style="background-color:#001B07">
        <div class="d-flex align-items-center justify-content-between mb-2">
     

          <div>
            <img class="wd-100 rounded-circle" src="{{(!empty($profileData->photo))?url('upload/admin_image/'.$profileData->photo):url('upload/no_image.jpg')}}" alt="profile">
            <span class="h4 ms-3 ">{{$profileData->username}}</span>
          </div>

        </div>
        <p>Hi! I'm {{$profileData->name}} the Admin of this system.</p>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
          <p class="text-muted">{{$profileData->name}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
          <p class="text-muted">{{$profileData->email}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
          <p class="text-muted">{{$profileData->phone}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
          <p class="text-muted">{{$profileData->address}}</p>
        </div>
        <div class="mt-3 d-flex social-links">
          <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
            <i data-feather="github"></i>
          </a>
          <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
            <i data-feather="twitter"></i>
          </a>
          <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
            <i data-feather="instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- left wrapper end -->
  <!-- middle wrapper start -->
  <div class="col-md-8 col-xl-8 middle-wrapper">
    <div class="row">
    <div class="card" style="background-color:#001B07">
              <div class="card-body" style="background-color:#001B07">

								<h6 class="card-title">Update Admin Profile</h6>

								<form style="background-color:#001B07" class="forms-sample" method="POST" action="{{route('admin.profile.store')}}" enctype='multipart/form-data'>
								@csrf	
                <div class="mb-3" style="background-color:#001B07">
										<label for="exampleInputUsername1" class="form-label">Username</label>
										<input style="background-color:#032E0E" type="text" class="form-control" value="{{$profileData->username}}" name="username" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Name</label>
										<input style="background-color:#032E0E" type="text" class="form-control" value="{{$profileData->name}}" name="name" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
									</div>
                  <div class="mb-3">
										<label for="exampleInputEmail1" class="form-label"> Email</label>
										<input style="background-color:#032E0E" type="email" class="form-control" value="{{$profileData->email}}" name="email" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
									</div>
                  <div class="mb-3">
										<label for="exampleInputEmail1" class="form-label"> Phone</label>
										<input style="background-color:#032E0E" type="text" class="form-control" value="{{$profileData->phone}}" name="phone" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
									</div>
                  
                  <div class="mb-3">
										<label for="exampleInputEmail1" class="form-label"> Address</label>
										<input style="background-color:#032E0E" type="text" class="form-control" value="{{$profileData->address}}" name="address" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
									</div>
                  <div class="mb-3">
										<label for="exampleInputEmail1" class="form-label"> Photo</label>
                    <input style="background-color:#032E0E" class="form-control" name="photo" type="file" id="image">
                  </div>
                  <div class="mb-3">
										<label for="exampleInputEmail1" class="form-label"> </label>
                    <img style="background-color:#032E0E" class="wd-100 rounded-circle" id="showImage" src="{{(!empty($profileData->photo))?url('upload/admin_image/'.$profileData->photo):url('upload/no_image.jpg')}}" alt="profile">
                  </div>
									<button type="submit" class="btn btn-primary me-2">Save Changes</button>
		
								</form>

              </div>
            </div>
    
    </div>
  </div>
  <!-- middle wrapper end -->
  <!-- right wrapper start -->

  <!-- right wrapper end -->
</div>

    </div>

    <script type="text/javascript">
      $(document).ready(function () {
        $('#image').change(function (e) {
          var reader =new FileReader();
          reader.onload =function(e){
            $('#showImage').attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
        });
      });
    </script>

    

@endsection
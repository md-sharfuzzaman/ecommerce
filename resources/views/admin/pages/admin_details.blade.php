@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Password</h3>
              </div>
              <!-- /.card-header -->
              {{-- @if (Session::has('error_message'))
                <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                  {{Session::get('error_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif  --}}
              @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                  {{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif 
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
              <!-- form start -->
          
              <form role="form" method="post" action="{{ url('/admin/update-admin-details') }}" name="updatePasswordForm" id="updatePasswordForm">@csrf
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="exampleInputEmail">Admin Email</label>
                    <input type="email" value="{{Auth::guard('admin')->user()->email}}" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputType">Admin Type</label>
                    <input type="text" value="{{Auth::guard('admin')->user()->type}}" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label for="adminName">Name</label>
                    <input type="text" value="{{Auth::guard('admin')->user()->name}}" name="admin_name" class="form-control" id="admin_name" placeholder="Enter admin name">
                   
                  </div>
                  <div class="form-group">
                    <label for="Mobile">Mobile</label>
                    <input type="text" value="{{Auth::guard('admin')->user()->mobile}}" name="admin_mobile" class="form-control" id="admin_mobile" placeholder="Enter admin mobile">
                  </div>
                  <div class="form-group">
                    <label for="adminImage">Image</label>
                    <input type="file" name="admin_image" class="form-control" id="admin_image">
                  </div>
                
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
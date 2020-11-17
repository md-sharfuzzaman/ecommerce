@extends('admin.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalougues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success_message'))
				<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
					{{Session::get('success_message')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif 
            <form 
                @if (empty($brand['id']))
                    action="{{ url('admin/add-edit-brand') }}"
                    @else action="{{ url('admin/add-edit-brand/'.$brand['id']) }}"
                @endif 
                name="brandForm" id="brandForm" method="post">@csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
    
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                       {{--  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name" placeholder="Enter brand Name" 
                                    @if (!empty($brand['name']))
                                        value="{{ $brand['name'] }}"
                                        @else value="{{ old('name') }}"
                                    @endif>
                                </div>
                            </div>
                         
                        </div>
                       
                      
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
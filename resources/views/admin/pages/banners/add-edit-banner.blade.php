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
              <li class="breadcrumb-item active">Banners</li>
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
                @if (empty($bannerData['id']))
                    action="{{ url('admin/add-edit-banner') }}"
                    @else action="{{ url('admin/add-edit-banner/'.$bannerData['id']) }}"
                @endif 
                name="bannerForm" id="bannerForm" method="post" enctype="multipart/form-data">@csrf
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
                                    <label for="banner_title">banner Title</label>
                                    <input type="text" name="banner_title" class="form-control" id="banner_title" placeholder="Enter banner Name" 
                                    @if (!empty($bannerData['banner_title']))
                                        value="{{ $bannerData['banner_title'] }}"
                                        @else value="{{ old('banner_title') }}"
                                    @endif>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="bannerImage">banner Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                          <input type="file" name="banner_image" id="banner_image" class="custom-file-input" id="exampleInputFile">
                                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                          <span class="input-group-text" id="">Upload</span>
                                        </div>
                                                                    
                                    </div>
                                    @if (!empty($bannerData['banner_image']))
                                        <div style="height: 100px;">
                                            <img style=" width: 60px; margin-top: 5px" src="{{ asset('images/banner_image/'.$bannerData['banner_image']) }}">
                                           <a href="javascript:void(0)" class="confirmDelete" record="banner-image" recordid={{ $bannerData['id'] }}  {{-- href="{{ url('admin/delete-banner-image/'.$bannerData['id']) }}" --}}> &nbsp; Delete Image</a>
                                        </div>                                           
                                    @endif        
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
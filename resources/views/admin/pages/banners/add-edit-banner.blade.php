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
                @if (empty($banner['id']))
                    action="{{ url('admin/add-edit-banner') }}"
                    @else action="{{ url('admin/add-edit-banner/'.$banner['id']) }}"
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
                                    <input type="text" name="banner_title" class="form-control" id="banner_title" placeholder="Enter banner banner Title" 
                                    @if (!empty($banner['title']))
                                        value="{{ $banner['title'] }}"
                                        @else value="{{ old('banner_title') }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <label for="banner_link">banner Link</label>
                                    <input type="text" name="banner_link" class="form-control" id="banner_link" placeholder="Enter banner banner Link" 
                                    @if (!empty($banner['link']))
                                        value="{{ $banner['link'] }}"
                                        @else value="{{ old('banner_link') }}"
                                    @endif>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="banner_link">banner Alternate Text</label>
                                    <input type="text" name="banner_alt" class="form-control" id="banner_alt" placeholder="Enter banner banner Alternate Text" 
                                    @if (!empty($banner['alt']))
                                        value="{{ $banner['alt'] }}"
                                        @else value="{{ old('banner_alt') }}"
                                    @endif>
                                </div>
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
                                    @if (!empty($banner['image']))
                                        <div style="height: 100px;">
                                            <img style=" width: 150px; margin-top: 5px" src="{{ asset('images/banner_images/'.$banner['image']) }}">
                                          
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
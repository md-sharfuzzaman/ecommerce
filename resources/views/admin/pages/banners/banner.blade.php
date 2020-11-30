@extends('admin.layouts.master')
@section('content')
<!-- Main content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>banners</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content"> 
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('success_message'))
						<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
							{{Session::get('success_message')}}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">banners</h3>
                            <a href="{{ url('admin/add-edit-banner') }}" style="max-width: 150px; float:right; display:inline-block" class="btn btn-block btn-success">Add banner</a>

                        </div>
                        <div class="card-body">
                            <table id="banners" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Title</th>
                                        <th>Alt</th>
                                        <th>Action</th>
                                    </tr> 
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{$banner['id']}}</td>
                                        <td>{{$banner['image']}}</td>
                                        <td>{{$banner['link']}}</td>
                                        <td>{{$banner['title']}}</td>
                                        <td>{{$banner['alt']}}</td>
                                        <td>
                                            <a title="Upade banner" href="{{ url('admin/add-edit-banner/'.$banner['id']) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a title="Delete banner" href="javascript:void(0)" class="confirmDelete" record="banner" recordid="{{ $banner['id'] }}" name="banner"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;&nbsp;
                                            @if ($banner['status']==1)
                                            <a href="javascript:void(0)" id="banner-{{$banner['id']}}" 
                                                banner_id= {{$banner['id']}} class="updateBannerStatus"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                            @else
                                            <a href="javascript:void(0)" id="banner-{{$banner['id']}}" 
                                                banner_id= {{$banner['id']}} class="updateBannerStatus"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                </div>
               
            </div>
         
        </div>
        
    </section>
    
</div>

@endsection
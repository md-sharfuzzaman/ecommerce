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
              <li class="breadcrumb-item active">Product images</li>
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
            @if (Session::has('error_message'))
				<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
					{{Session::get('error_message')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif 
            <form name="addImageForm"  id="addImageForm" method="post" action="{{ url('admin/add-images/'.$productData['id']) }}" enctype="multipart/form-data">@csrf

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
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name">product Name :</label>&nbsp;&nbsp;  {{ $productData['product_name'] }}
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="product_code">product code:</label>&nbsp;&nbsp;{{ $productData['product_code'] }}
                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="product_color">product Color:</label>&nbsp;&nbsp;  {{ $productData['product_color'] }}
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <img style=" width: 130px; margin-top: 5px" src="{{ asset('images/product_images/small/'.$productData['main_image']) }}">                        
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="field_wrapper">
                                                <div>
                                                    <input multiple style="width: 120px" id="images" name="images[]" type="file" required/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>           
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add images</button>
                    </div>
                </div>
            </form>
            <form name="editAttributeForm" id="editAttributeForm" method="post" action="{{url('admin/edit-images/'.$productData['id'])}}">@csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Added Product images</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="images" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Images</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productData['images'] as $image)
                                <input type="hidden" name="attrId[]" value ="{{$image['id']}}">
                                <tr>
                                    <td>{{$image['id']}}</td>
                                    <td><img src="{{ asset('images/product_images/small/'.$image['image']) }}"></td>
                                   
                                    <td>
                                        @if ($image['status']== 1)
                                        <a  href="javascript:void(0)" id="image-{{$image['id']}}" 
                                        image_id= {{$image['id']}} class="updateImageStatus">Active</a>
                                        @else
                                        <a href="javascript:void(0)" id="image-{{$image['id']}}" 
                                        image_id= {{$image['id']}} class="updateImageStatus">Inactive</a>
                                        @endif
                                    </td>
                                    <td> 
                                        <a title="Delete image" href="javascript:void(0)" class="confirmDelete" record="image" recordid="{{ $image['id'] }}" name="image"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Images</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Update images
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
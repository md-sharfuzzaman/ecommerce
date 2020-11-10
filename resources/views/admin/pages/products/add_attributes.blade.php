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
              <li class="breadcrumb-item active">Product Attributes</li>
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
            <form name="attributeForm"  id="attributeForm" method="post" action="{{ url('admin/add-attributes/'.$productData['id']) }}">@csrf

               
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
                                                    <input style="width: 120px" id="size" name="size[]" type="text" name="size[]" required value="" placeholder="Size"/>
                                                    <input style="width: 120px" id="sku" name="sku[]" type="text" name="sku[]" required value="" placeholder="SKU"/>
                                                    <input style="width: 120px" id="price" name="price[]" type="number" name="price[]" required value="" placeholder="Price"/>
                                                    <input style="width: 120px" id="stock" name="stock[]" type="number" name="stock[]" required value="" placeholder="Stock"/>
                                                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
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
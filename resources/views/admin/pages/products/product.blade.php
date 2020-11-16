@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Catalouges</h1>
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
							<h3 class="card-title">Products</h3>
							<a href="{{ url('admin/add-edit-product') }}" style="max-width: 150px; float:right; display:inline-block" class="btn btn-block btn-success">Add Product</a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="products" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Product Name</th>
										<th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Product Image</th>
                                        <th>Categroy</th>
                                        <th>Section</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($products as $product)
									<tr>
										<td>{{$product->id}}</td>
										<td>{{$product->product_name}}</td>
										<td>{{$product->product_code}}</td>
										<td>{{$product->product_color}}</td>
										<td>
											<?php $product_image_path = "images/product_images/small/".$product->main_image; ?>

											@if (!empty($product->main_image) && file_exists($product_image_path))
												<img width="72px" src="{{ asset('images/product_images/small/'.$product->main_image) }}" alt="{{$product->main_image}}">
											@else 
												<img width="72px" src="{{ asset('images/product_images/small/no-image.png') }}">
											@endif
										</td>
										<td>{{$product->category->category_name}}</td>
										<td>{{$product->section->name}}</td>
										<td>
											@if ($product->status==1)
											<a  href="javascript:void(0)" id="product-{{$product->id}}" 
												product_id= {{$product->id}} class="updateProductStatus">Active</a>
											@else
											<a href="javascript:void(0)" id="product-{{$product->id}}" 
												product_id= {{$product->id}} class="updateProductStatus">Inactive</a>
											@endif
										</td>
										<td>
											<a title="Add Attributes" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="fas fa-plus"></i></a>&nbsp;&nbsp;
											<a title="Add Images" href="{{ url('admin/add-images/'.$product->id) }}"><i class="fas fa-image"></i></a>&nbsp;&nbsp;
											<a title="Upade Product" href="{{ url('admin/add-edit-product/'.$product->id) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
											<a title="Delete Product" href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}" name="product" {{--  href="{{ url('admin/delete-product/'.$product->id) }}"--}} ><i class="fas fa-trash"></i></a>
										</td>
									
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>Product Name</th>
										<th>Product Code</th>
                                        <th>Product Color</th>
										<th>Product Image</th>
                                        <th>Categroy</th>
                                        <th>Section</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
            	</div>
            	<!-- /.col -->
          	</div>
          	<!-- /.row -->
        </div>
    	<!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
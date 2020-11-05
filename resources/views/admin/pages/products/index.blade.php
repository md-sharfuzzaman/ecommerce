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
										<td>{{$product->category->category_name}}</td>
										<td>{{$product->section->name}}</td>
										<td>
											@if ($product->status==1)
											<a href="javascript:void(0)" id="product-{{$product->id}}" 
												product_id= {{$product->id}} class="updateProductStatus">Active</a>
											@else
											<a href="javascript:void(0)" id="product-{{$product->id}}" 
												product_id= {{$product->id}} class="updateProductStatus">Inactive</a>
											@endif
										</td>
										<td>
											<a href="{{ url('admin/add-edit-product/'.$product->id) }}">Edit</a>&nbsp;&nbsp;
											<a href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}" name="product" {{--  href="{{ url('admin/delete-product/'.$product->id) }}"--}} >Delete</a>
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
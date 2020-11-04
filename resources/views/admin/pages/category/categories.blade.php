@extends('admin.layouts.master')
@section('content')
<!-- Main content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Sections</h1>
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
							<h3 class="card-title">Categories</h3>
							<a href="{{ url('admin/add-edit-category') }}" style="max-width: 150px; float:right; display:inline-block" class="btn btn-block btn-success">Add Categories</a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="categories" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Category</th>
										<th>Parent Category</th>
										<th>Section</th>										
										<th>URL</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($categories as $category)
									@if (!isset($category->parent_category->category_name))
										<?php $parent_category = "Root"; ?>
									@else 
										<?php $parent_category = $category->parent_category->category_name; ?>
									@endif
									<tr>
										<td>{{$category->id}}</td>
										<td>{{$category->category_name}}</td>
										<td>{{$parent_category}}</td>
										<td>{{$category->section->name}}</td>
										<td>{{$category->url}}</td>
										<td>
											@if ($category->status==1)
											<a href="javascript:void(0)" id="category-{{$category->id}}" 
												category_id= {{$category->id}} class="updateCategoryStatus">Active</a>
											@else
											<a href="javascript:void(0)" id="category-{{$category->id}}" 
												category_id= {{$category->id}} class="updateCategoryStatus">Inactive</a>
											@endif
										</td>
										<td>
											<a href="{{ url('admin/add-edit-category/'.$category->id) }}">Edit</a>&nbsp;&nbsp;
											<a href="javascript:void(0)" class="confirmDelete" record="category" recordid="{{ $category->id }}" name="Category" {{--  href="{{ url('admin/delete-category/'.$category->id) }}"--}} >Delete</a>
										</td>
									
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>Category</th>
										<th>Parent Category</th>
										<th>Section</th>										
										<th>URL</th>
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
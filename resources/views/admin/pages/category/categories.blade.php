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
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              
    
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
                      <th>Name</th>
                      <th>URL</th>
                      <th>Status</th>
                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->category_name}}</td>
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
                     
                      </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Status</th>
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
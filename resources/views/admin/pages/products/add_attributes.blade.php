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

                <input type="hidden" name="product_id" value="{{ $productData['id'] }}">
               
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
                        <button type="submit" class="btn btn-primary">Add Attributes</button>
                    </div>
                </div>
            </form>
            <form name="editAttributeForm" id="editAttributeForm" method="post" action="{{url('admin/edit-attributes/'.$productData['id'])}}">@csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Added Product Attributes</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="attributes" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Size</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productData['attributes'] as $attribute)
                                <input type="hidden" name="attrId[]" value ="{{$attribute['id']}}">
                                <tr>
                                    <td>{{$attribute['id']}}</td>
                                    <td>{{$attribute['size']}}</td>
                                    <td>{{$attribute['sku']}}</td>
                                    <td>   
                                        <input type="number" name="price[]" value="{{$attribute['price']}}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="stock[]" value="{{$attribute['stock']}}" required>
                                    </td>
                                    <td>
                                        @if ($attribute['status']== 1)
                                        <a  href="javascript:void(0)" id="attribute-{{$attribute['id']}}" 
                                        attribute_id= {{$attribute['id']}} class="updateAttributeStatus">Active</a>
                                        @else
                                        <a href="javascript:void(0)" id="attribute-{{$attribute['id']}}" 
                                        attribute_id= {{$attribute['id']}} class="updateAttributeStatus">Inactive</a>
                                        @endif
                                    </td>
                                    <td>
                                       
                                        
                                        <a title="Delete attribute" href="javascript:void(0)" class="confirmDelete" record="attribute" recordid="{{ $attribute['id'] }}" name="attribute"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Size</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Update Attributes
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
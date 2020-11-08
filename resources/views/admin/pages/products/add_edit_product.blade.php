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
              <li class="breadcrumb-item active">Product </li>
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
                @if (empty($productData['id']))
                    action="{{ url('admin/add-edit-product') }}"
                    @else action="{{ url('admin/add-edit-product/'.$productData['id']) }}"
                @endif 
                name="productForm" id="ProductForm" method="post" enctype="multipart/form-data">@csrf
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
                                            <label>Select Category</label>
                                            <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                                <option value="">Select</option>
                                                @foreach ($categories as $section)
                                                    <optgroup label="{{ $section['name'] }}"></optgroup>
                                                    @foreach ($section['categories'] as $category)
                                                        <option value="{{ $category['id'] }}"
                                                            @if (!empty(@old('category_id')) && $category['id']==@old('category_id'))
                                                                selected
                                                            @endif
                                                        >{{ $category['category_name'] }}</option>
                                                        @foreach ($category['subcategories'] as $subcategory)
                                                            <option value="{{ $subcategory['id'] }}"
                                                                @if (!empty(@old('category_id')) && $subcategory['id']==@old('category_id'))
                                                                    selected
                                                                @endif
                                                            >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- {{ $subcategory['category_name'] }}</option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_name">product Name</label>
                                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter product Name" 
                                            @if (!empty($productData['product_name']))
                                                value="{{ $productData['product_name'] }}"
                                                @else value="{{ old('product_name') }}"
                                            @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_code">product code</label>
                                            <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product code"
                                            @if (!empty($productData['product_code']))
                                                value="{{ $productData['product_code'] }}"
                                                @else value="{{ old('product_code') }}"
                                            @endif>     
                                        </div>
                                        <div class="form-group">
                                            <label for="product_color">product Color</label>
                                            <input type="text" class="form-control" name="product_color" id="product_color" placeholder="Enter product color"
                                            @if (!empty($productData['product_color']))
                                                value="{{ $productData['product_color'] }}"
                                                @else value="{{ old('product_color') }}"
                                            @endif>
                                        </div>
                                        
                                       
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_price">product price</label>
                                            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product price"
                                            @if (!empty($productData['product_price']))
                                                value="{{ $productData['product_price'] }}"
                                                @else value="{{ old('product_price') }}"
                                            @endif>     
                                        </div>
                                        <div class="form-group">
                                            <label for="product_discount">product discount</label>
                                            <input type="text" class="form-control" name="product_discount" id="product_discount" placeholder="Enter product discount"
                                            @if (!empty($productData['product_discount']))
                                                value="{{ $productData['product_discount'] }}"
                                                @else value="{{ old('product_discount') }}"
                                            @endif>
                                        </div>
                                       
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_weight">product weight</label>
                                            <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter product weight"
                                            @if (!empty($productData['product_weight']))
                                                value="{{ $productData['product_weight'] }}"
                                                @else value="{{ old('product_weight') }}"
                                            @endif>     
                                        </div>
                                         
                                        <div class="form-group">
                                            <label for="mainImage">Product main Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                <input type="file" name="main_image" id="main_image" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                                </div>
                                                                            
                                            </div>
                                            
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_video">Product Video</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                  <input type="file" name="product_video" id="product_video" class="custom-file-input" id="exampleInputFile">
                                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                  <span class="input-group-text" id="">Upload Video</span>
                                                </div>
                                                                            
                                            </div>
                                             
                                        </div>
                                        <div class="form-group">
                                            <label for="description">product Description</label>
                                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter ...">@if(!empty($productData['description'])){{$productData['description'] }}@else{{old('description')}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Fabric</label>
                                            <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                                                <option value="">Select</option>
        
                                                @foreach ($fabricArray as $fabric)
                                                    <option value="{{ $fabric }}">{{ $fabric }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="wash_care">wash care</label>
                                                <textarea name="wash_care" class="form-control" id="wash_care" rows="3" placeholder="Enter ...">@if(!empty($productData['wash_care'])){{$productData['wash_care']}}@else{{old('wash_care')}}@endif</textarea>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Sleeve</label>
                                            <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                                                <option value="">Select</option>
        
                                                @foreach ($sleeveArray as $sleeve)
                                                    <option value="{{ $sleeve }}">{{ $sleeve }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Pattern</label>
                                            <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                                                <option value="">Select</option>
        
                                                @foreach ($patternArray as $pattern)
                                                    <option value="{{ $pattern }}">{{ $pattern }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Fit</label>
                                            <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                                                <option value="">Select</option>
        
                                                @foreach ($fitArray as $fit)
                                                    <option value="{{ $fit }}">{{ $fit }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select occasion</label>
                                            <select name="occasion" id="occasion" class="form-control select2" style="width: 100%;">
                                                <option value="">Select</option>
        
                                                @foreach ($occasionArray as $occasion)
                                                    <option value="{{ $occasion }}">{{ $occasion }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <textarea name="meta_title" class="form-control" id="meta_title" rows="3" placeholder="Enter ...">@if(!empty($productData['meta_title'])){{$productData['meta_title']}}@else{{old('meta_title')}}@endif</textarea>

                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta keywords</label>
                                            <textarea name="meta_keywords" class="form-control" id="meta_keywords" rows="3" placeholder="Enter ...">@if(!empty($productData['meta_keywords'])){{$productData['meta_keywords']}}@else{{old('meta_keywords')}}@endif</textarea>

                                        </div>
                                        <div class="from-group">
                                            <label for="featured_item">Featured Item</label>
                                            <input type="checkbox" name="is_featured" id="is_featured" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea name="meta_description" class="form-control" id="meta_description" rows="3" placeholder="Enter ...">@if(!empty($productData['meta_description'])){{$productData['meta_description']}}@else{{old('meta_description')}}@endif</textarea>

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
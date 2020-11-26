@extends('frontend.layouts.master')

@section('content')
<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" class="carousel slide">
                <div class="carousel-inner">
                    @foreach ($featuredItemsChunk as $key => $featuredItem)
                    <div class="item @if ($key==0) active @endif">
                        <ul class="thumbnails">
                            @foreach ($featuredItem as $item)
                            <li class="span3">
                                <div class="thumbnail">
                                   
                                    <a href="javascript:void(0)">
                                        <?php $product_image_path = "images/product_images/small/".$item['main_image'] ?>
                                        @if (!empty($item['main_image']) && file_exists($product_image_path))
                                            <img src="{{ asset($product_image_path) }}" alt="">
                                        @else
                                            <img src="images/product_images/small/no-image.png" alt="">
                                        @endif
                                        
                                    </a>
                                    <div class="caption">
                                        <h5>{{ $item['product_name'] }}</h5>
                                        <h4><a class="btn" href="javascript:void(0)">VIEW</a> <span class="pull-right">{{ $item['product_price'] }}</span></h4>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        @foreach ($latestProducts as $latestProduct)
            <li class="span3">
                <div class="thumbnail">
                    <a href="javascript:void(0)">
                        <?php $product_image_path = "images/product_images/small/".$latestProduct['main_image'] ?>
                        @if (!empty($latestProduct['main_image']) && file_exists($product_image_path))
                            <img src="{{ asset($product_image_path) }}" alt="">
                        @else
                            <img src="images/product_images/small/no-image.png" alt="">
                        @endif
                        
                    </a>
                    <div class="caption">
                        <h5>{{ $latestProduct['product_name'] }}</h5>
                        <p>
                            {{ $latestProduct['product_code'] }} ({{ $latestProduct['product_color'] }})
                            {{-- {{ substr(strip_tags($latestProduct['description']), 0, 30) }} --}}
                        </p>
                        
                        <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#"> {{ $latestProduct['product_price'] }}</a></h4>
                    </div>
                </div>
            </li>
        @endforeach
        
    </ul>
</div>  
@endsection

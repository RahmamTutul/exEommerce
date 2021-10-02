<?php use App\Models\Product; ?>
@extends('frontend.layouts.app')

@push('style-sheet')

@endpush
@section('content')
<div class="span9">
    <div class="well well-small">
        @if (count($featuredArrayChunk)>0)
        <h4>Featured Products <small class="pull-right">200+ featured products</small></h4>

        <div class="row-fluid">
            <div id="featured" class="carousel slide">
                <div class="carousel-inner">
                    @foreach ($featuredArrayChunk as $key=>$feature)
                    <div class="item @if($key==0) active @endif">
                        <ul class="thumbnails">
                            @foreach ($feature as $featureItem)
                            <?php $discount = Product::getProductDiscount($featureItem['id'])?>
                            <li class="span3">
                                <div class="thumbnail">
                                    <i class="tag"></i>
                                    <a href="product_details.html"><img src="{{asset('storage/images/admin/product/small/'.$featureItem['product_image'])}}" alt=""></a>
                                    <div class="caption">
                                        <h5>{{$featureItem['product_name']}}</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a>
                                            @if ($discount>0)
                                            <span class="pull-right"><del>{{$featureItem['product_price']}}</del></span>
                                            @else
                                            <span class="pull-right">{{$featureItem['product_price']}}</span>
                                            @endif
                                            @if ($discount>0)
                                            <a class="btn btn-success" href="#">Discount price: $  {{$discount}}</a>
                                            @endif
                                        </h4>
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
        @else
           <h4>No Featured Product to show</h2>
        @endif
    </div>
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        @foreach ($latestProduct as $latest)
        <li class="span3">
            <div class="thumbnail">
                <a  href="{{route('single.product',$latest['id'])}}"><img style="height: 150px; width:150px" src="{{asset('storage/images/admin/product/small/'.$latest['product_image'])}}" alt=""/></a>
                <div class="caption">
                    <?php $discount = Product::getProductDiscount($latest['id'])?>
                    <h5>{{$latest['product_name']}}</h5>
                    <p>
                    @if ($latest['product_discount']==0)
                    <span> Discount:</span> No discount
                    @else
                    <span> Discount:</span>{{$latest['product_discount']}}%
                   @endif
                    </p>

                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">
                        @if ($discount>0)
                        <span class="pull-right"><del>{{$latest['product_price']}}</del></span>
                        @else
                        <span class="pull-right">{{$latest['product_price']}}</span>
                        @endif
                        </a>
                    @if ($discount>0)
                    <a class="btn btn-success" href="#">Discount price: $  {{$discount}}</a>
                    @endif
                   </h4>
                </div>
            </div>
        </li>
        @endforeach
</div>

@endsection

@push('script')

@endpush

<?php
 use App\Models\Product;
 $discount = Product::getProductDiscount($productData['id']);
 ?>
@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
        <li><a href="{{url('/'.$productData['category']['url'])}}">{{$productData['category']['category_name']}}</a> <span class="divider">/</span></li>
        <li class="active">{{$productData['product_name']}}</li>
    </ul>
    <div class="row">
        <div id="gallery" class="span3">
            <a href="{{asset('storage/images/admin/product/small/'.$productData['product_image'])}}" title="{{$productData['product_name']}}">
                <img src="{{asset('storage/images/admin/product/main/'.$productData['product_image'])}}" style="width:100%" alt="Blue Casual T-Shirt"/>
            </a>
            <div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach ($productData['images'] as $images)
                        <a href="{{asset('storage/images/admin/product/small/'.$images['image'])}}"> <img style="width:20%; height:60px" src="{{asset('storage/images/admin/product/main/'.$images['image'])}}" alt=""/></a>
                        @endforeach
                    </div>
                    <div class="item">
                        @foreach ($productData['images'] as $images)
                        {{-- <a href="{{asset('storage/images/admin/product/medium/'.$images['image'])}}"> <img style="width:29%" src="{{asset('storage/images/admin/product/main/'.$images['image'])}}" alt=""/></a> --}}
                        @endforeach
                    </div>
                </div>
                {{-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> --}}

            </div>

            <div class="btn-toolbar">
                <div class="btn-group">
                    <span class="btn"><i class="icon-envelope"></i></span>
                    <span class="btn" ><i class="icon-print"></i></span>
                    <span class="btn" ><i class="icon-zoom-in"></i></span>
                    <span class="btn" ><i class="icon-star"></i></span>
                    <span class="btn" ><i class=" icon-thumbs-up"></i></span>
                    <span class="btn" ><i class="icon-thumbs-down"></i></span>
                </div>
            </div>
        </div>
        <div class="span6">
            <h3>{{$productData['product_name']}} </h3>
            <small>- {{$productData['brand']['name']}}</small>
            <hr class="soft"/>
            <strong>{{$attribute}} items in stock</strong>
            <form action="{{url('add-to-cart')}}" method="POST" class="form-horizontal qtyFrm">
                @csrf
                <input type="hidden" name="product_id" value="{{$productData['id']}}">
                <div class="control-group">
                    <h4 class="productPriceAttribute">
                        @if ($discount>0)
                          <a  href="#"><del> $ {{$productData['product_price']}}</del></a>
                         @else
                          <a  href="#">$ {{$productData['product_price']}}</a>
                        @endif
                        @if ($discount>0)
                        <a  href="#">$ {{ $discount }}</a>
                        @endif
                    </h4>
                        <select class="span2 pull-left" product-id="{{$productData['id']}}" id="getPrice" name="size" required="">
                            @foreach ($productData['attributes'] as $attribute)
                             <option value="{{$attribute['size']}}">{{$attribute['size']}}</option>
                            @endforeach
                        </select>
                        <input type="number" name="quantity" class="span1" placeholder="Qty." required="">
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                    </div>
                </div>
            </form>

            <hr class="soft clr"/>
            <p class="span6">
                {{$productData['product_description']}}
            </p>
            <a class="btn btn-small pull-right" href="#detail">More Details</a>
            <br class="clr"/>
            <a href="#" name="detail"></a>
            <hr class="soft"/>
        </div>

        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{$productData['brand']['name']}}</td></tr>
                            {{-- {{-- <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{$productData['attributes']['size']}}</td></tr> --}}

                            <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{$productData['product_code']}}</td></tr>
                            @if (!empty($productData['fabric']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{$productData['fabric']}}</td></tr>
                            @endif
                            @if (!empty($productData['pattern']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{$productData['pattern']}}</td></tr>
                            @endif
                            @if (!empty($productData['sleeve']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{$productData['sleeve']}}</td></tr>
                            @endif
                            @if (!empty($productData['fit']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Fitness:</td><td class="techSpecTD2">{{$productData['fit']}}</td></tr>
                            @endif
                            @if (!empty($productData['occasion']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{$productData['occasion']}}</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile">
                    <hr class="soft"/>
                    <div class="tab-content">
                        <div class="tab-pane active" id="blockView">
                            <ul class="thumbnails">
                                @foreach ($relatedProducts as $relatedProduct)
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="{{url('/'.$relatedProduct['url'])}}"><img style="height: 140px; width: 120px" src="{{asset('storage/images/admin/product/small/'.$relatedProduct['product_image'])}}" alt=""/></a>
                                            <div class="caption">
                                                <h5>{{$relatedProduct['product_name']}}</h5>
                                                <p>
                                                   {{$relatedProduct['product_description']}}
                                                </p>
                                                <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">
                                                    @if ($discount>0)
                                                    <a class="btn btn-primary" href="#"><del> $ {{$relatedProduct['product_price']}}</del></a>
                                                    @else
                                                    <a class="btn btn-primary" href="#">$ {{$relatedProduct['product_price']}}</a>
                                                    @endif
                                                    </a></h4>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <hr class="soft"/>
                        </div>
                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

@endpush

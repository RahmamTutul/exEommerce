<?php use App\Models\Product; ?>
<div class="tab-pane  active  filter_products" id="blockView">
    <ul class="thumbnails">
        @foreach ($categoryProducts as $categoryProduct)
        <li class="span3">
            <div class="thumbnail">
                <a href="{{route('single.product',$categoryProduct['id'])}}"><img style="height: 160px; width:140px" src="{{asset('storage/images/admin/product/main/'.$categoryProduct['product_image'])}}" alt=""/></a>
                <div class="caption">
                    <h5>{{$categoryProduct['product_name']}}</h5>
                    <p>
                        {{$categoryProduct['brand']['name']}}
                    </p>
                    <?php $discount = Product::getProductDiscount($categoryProduct['id'])?>
                    <p>
                        {{$categoryProduct['fabric']}}
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
                        @if ($discount>0)
                          <a class="btn btn-primary" href="#"><del> $ {{$categoryProduct['product_price']}}</del></a>
                         @else
                          <a class="btn btn-primary" href="#">$ {{$categoryProduct['product_price']}}</a>
                        @endif
                    </h4>
                    @if ($discount>0)
                    <a class="btn btn-success" href="#">Discount price: $  {{$discount}}</a>
                    @endif

                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <hr class="soft"/>
</div>

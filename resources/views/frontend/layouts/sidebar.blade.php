<?php
use App\Models\Section;
$sideMenu= Section::section();
?>
<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{asset('assets/frontend/images/ico-cart.png')}}" alt="cart"> <span class="cartCountItems">{{  countCartItems()}}</span> Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
      @foreach ($sideMenu as $side)
       @if (count($side['categories'])>0)
        <li class="subMenu"><a>{{$side['name']}}</a>
            @foreach ($side['categories'] as $category)
                <ul>
                    <li><a href="{{url($category['url'])}}"><i class="icon-chevron-right"></i><strong>{{$category['category_name']}}</strong></a></li>
                    @foreach ($category['sub_categories'] as $sub)
                        <li><a href="{{url($category['url'])}}"><i class="icon-chevron-right"></i>{{$sub['category_name']}}</a></li>
                    @endforeach
                </ul>
            @endforeach
        </li>
       @endif
      @endforeach
    </ul>
    @if (isset($page_name) && $page_name=="listing" && !isset($_REQUEST['search']))
        <div class="well well-small" style="margin-top: 20px">
           <h5>Fabric</h5>
           @foreach ($fabricArray as $fabric)
           <input type="checkbox" class="fabric" name="fabric[]" id="{{$fabric}}" value="{{$fabric}}">&nbsp; {{$fabric}} <br>
           @endforeach
        </div>
        <div class="well well-small" style="margin-top: 20px">
            <h5>Sleeve</h5>
            @foreach ($sleeveArray as $sleeve)
            <input type="checkbox" class="sleeve" name="sleeve[]" id="{{$sleeve}}" value="{{$sleeve}}">&nbsp; {{$sleeve}} <br>
            @endforeach
         </div>
        <div class="well well-small" style="margin-top: 20px">
            <h5>Patter</h5>
            @foreach ($patternArray as $pattern)
            <input type="checkbox" class="pattern" name="pattern[]" id="{{$pattern}}" value="{{$pattern}}">&nbsp; {{$pattern}} <br>
            @endforeach
         </div>
         <div class="well well-small" style="margin-top: 20px">
            <h5>Fit</h5>
            @foreach ($fitArray as $fit)
            <input type="checkbox" class="fit" name="fit[]" id="{{$fit}}" value="{{$fit}}">&nbsp; {{$fit}} <br>
            @endforeach
         </div>
         <div class="well well-small" style="margin-top: 20px">
            <h5>Occasion</h5>
            @foreach ($occasionArray as $occasion)
            <input type="checkbox" class="occasion" name="occasion[]" id="{{$occasion}}" value="{{$occasion}}">&nbsp; {{$occasion}} <br>
            @endforeach
         </div>

    @endif
    <br/>
    <div class="thumbnail">
        <img src="{{asset('assets/frontend/images/payment_methods.png')}}" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>

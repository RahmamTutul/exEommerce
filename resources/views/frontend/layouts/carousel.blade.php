<?php
 use App\Models\Banner;
 $banners=Banner::banner();
?>
@if (isset($pageName) && $pageName=='index')
@if (count($banners)>0)
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
            @foreach ($banners as $key=>$banner)
			<div class="item  @if($key==0) active @endif">
				<div class="container">
					<a href="#"><img style="height:480px;width:100%" src="{{asset('storage/images/admin/banner/'.$banner['image'])}}" alt="{{$banner['alt']}}"/></a>
					<div class="carousel-caption">
						<h4>{{$banner['title']}}</h4>
						<p>Banner text</p>
					</div>
				</div>
			</div>
            @endforeach
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>
@endif
@endif


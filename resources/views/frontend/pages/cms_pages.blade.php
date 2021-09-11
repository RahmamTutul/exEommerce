<?php use App\Models\Product; ?>
@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div class="span9">
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12 doc-header">
          <a class="btn btn-outline-warning" href="{{url('/')}}"><i class="mdi mdi-home mr-2"></i>Back to home</a>
          <h1 class="text-primary mt-4">{{$cmsPageDetails['title']}}</h1>
        </div>
      </div>
      <div class="row doc-content">
        <div class="col-12 col-md-10 offset-md-1">
          <div class="col-12 grid-margin" id="doc-intro">
              <div class="card">
                  <div class="card-body">
                      <h3 class="mb-4 mt-4">{{$cmsPageDetails['title']}}</h3>
                      <p>{{$cmsPageDetails['description']}}</p>
                  </div>
              </div>
        </div>
      </div>
    </div>
</div>
</div>
@endsection

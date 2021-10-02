@extends('frontend.layouts.app')

@push('stylesheet')

@endpush

@section('content')
<div id="mainBody">
    <div class="container">
        <div class="row">
            <div class="span4">
            <h4>Contact Details</h4>
            <p>	18 Fresno,<br/> CA 93727, USA
                <br/><br/>
                info@sitemakers.in<br/>
                ﻿Tel 00000-00000<br/>
                Fax 00000-00000<br/>
                web: https://www.youtube.com/StackDevelopers
            </p>
            </div>
            <div class="span4">
            <h4>Email Us</h4>
            <form class="form-horizontal" action="{{url('/contact')}}" method="POST">
                 @csrf
                <fieldset>
                <div class="control-group">

                    <input type="text" name="name" placeholder="name" class="input-xlarge" required/>

                </div>
                <div class="control-group">

                    <input type="email" name="email" placeholder="email" class="input-xlarge" required/>

                </div>
                <div class="control-group">

                    <input type="text" name="subject" placeholder="subject" class="input-xlarge" required/>

                </div>
                <div class="control-group">
                    <textarea name="massage" rows="3" id="textarea" class="input-xlarge" required></textarea>

                </div>

                    <button class="btn btn-large" type="submit">Send Messages</button>

                </fieldset>
            </form>
            </div>
        </div>
    </div>
    </div>
@endsection

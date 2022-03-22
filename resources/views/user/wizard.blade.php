@extends('layouts.backend.mainlayout')
@section('title','wizard')
@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());
</script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header text-bold">  Wizard Info </div>
                <div class="card-body">
                    <h5 class="card-title">Search Engine Optimization (SEO)</h5>
                    <p class="card-text"><p>Search Engine Optimization (SEO) is one of the best techniques used to improve traffic to a website by obtaining a high-rank placement in the Search Engine Results Page (SERP) such as Google, Yahoo, Bing, and others. Off-page SEO always helps make your website popular on the internet, so you can get more visibility. Below we have mentioned the top 50 wizards for improving traffic to your website.</p></p>
                   <div class="row">
                       <div class="col-lg-5 mt-3">
                        <a href="{{route('products.create.step.one',['org_slug' =>$org_slug])}}" class="btn btn-primary">Continue wizard</a>
                        <img style="margin-left: 172px;" src="{{ asset('assets/images/users/wizard.png')}}" alt="">
                       </div>
                       
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
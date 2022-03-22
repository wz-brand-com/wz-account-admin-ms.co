@extends('page-layouts.index')
@section('content')

<style>
.jumbotron {
        background-image: url(assets/images/wizbrand-cover-banner.png);
        min-width: 100px !important;
        width: 100% !important;
        height: 200px;
    }
</style>


<!-- jumbostron start here  -->
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron_con">
                    <h1 style="text-align: center" class="display-5 text-white"><b style="font-family: 'Domine', serif;">OUR TOOLS</b></h1>
                    <div class="breadcrumbs">
                        <a href="/">Home</a>
                        <a class="active" href="">Our tools</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="tools">
        <h2>Best Social Media Followers Counter Real-Time, Accurate, Exact</h2>
        <p class="mt-3">Use Live Instagram Followers Counter and follow the latest Instagram
            trend.</p>
        </div><br>
    <div class="row">
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="{{ asset('assets/images/icon/url-analyzer-tool.jpg')}}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Website Link Analyzer</h5>
                  <p class="card-text">Link Analyzer Tool allows you to keep track of all the links of your website. The free link analyzer tool makes the process relatively simple. Just enter the URL. </p>
                  <a href="{{ route('url-analyser-tools')}}" class="btn btn-primary">Analyze Url</a>
                </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('assets/images/icon/instagram-follower-count.jpg')}}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Realtime Instagram Followers Count</h5>
                <p class="card-text">you can track real time Instagram followers, posts and following count it's helps you analyse live followers count of any public Instagram profile.</p>
                <a href="{{ route('instagram-follower-count')}}" class="btn btn-primary">Followers Count</a>
              </div>
            </div>
            {{-- twitter card open --}}
            <div class="card">
              <img class="card-img-top" src="{{ asset('assets/images/icon/twitter-follower-count.jpg')}}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Realtime Twitter Followers Count</h5>
                <p class="card-text">Realtime Twitter Followers Count. Easiest and most authentic live followers counter for Twitch. Just enter the twitch profile link and get started. </p>
                <a href="{{ route('twittercount')}}" class="btn btn-primary">Followers Count</a>
              </div>
            </div>
            {{-- twitter card close --}}

              <div class="card">
                <img class="card-img-top" src="{{ asset('assets/images/icon/youtube-subscriber-count.jpeg')}}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Realtime YouTube Subscriber Count</h5>
                  <p class="card-text">Realtime YouTube Subscriber Count Just put your YouTube Url and you'll get total numbers of videos, total views and how much videos uploaded there. </p>
                  <a href="#" class="btn btn-primary">Subscriber Count</a>
                </div>
              </div>

          </div>
    </div>
</div>
<br><br><br>
@endsection

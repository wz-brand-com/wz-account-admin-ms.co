@extends('page-layouts.index')
@section('content')


{{-- <a href="/"><img class="logos" src="../../../assets/images/wiz.png" alt=""></a> --}}
<div class="container">
    <div class="main-body mt-4">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    {{--  --}}
                   @if(!empty($slug_image))
                    <img src="{{url('storage/images/',$slug_image) }}" alt="Admin" class="rounded-circle" width="150">
                    @else
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    @endif
                    <div class="mt-3">
                      <h4><span class="name" style="color: red">{{$profile_getting->user_name}}</span></h4>
                      <p class="text-secondary mb-1">Digital Marketer</p>
                      <p class="text-muted font-size-sm">{{$get_country_name}}</p>
                      <button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fab fa-facebook" style="font-size: 25px; color: blue;"></i>&nbsp;&nbsp;Facebook</h6>

                    @if(!empty($profile_getting->facebook))
                    <span class="text-secondary"> <a class="text-secondary"  href="{{$profile_getting->facebook}}" target="_blank">facebook</a> </span>
                    @else
                    <span class="badge badge-danger badge-pill">Not
                        Available url</span>
                    @endif

                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fab fa-twitter" style="font-size: 25px; color: #00e6e6;"></i>&nbsp;&nbsp;Twitter</h6>

                    @if(!empty($profile_getting->twitter))
                    <span class="text-secondary"> <a class="text-secondary"  href="{{$profile_getting->twitter}}" target="_blank">Twitter</a> </span>
                    @else
                    <span class="badge badge-danger badge-pill">Not
                        Available url</span>
                    @endif

                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fab fa-youtube" style="font-size: 25px; color: #e60000;"></i>&nbsp;&nbsp;Youtube</h6>

                    @if(!empty($profile_getting->youtube))
                    <span class="text-secondary"> <a class="text-secondary"  href="{{$profile_getting->youtube}}" target="_blank">Youtube</a> </span>
                    @else
                    <span class="badge badge-danger badge-pill">Not
                        Available url</span>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fab fa-wordpress inst"></i>&nbsp;Wordpress</h6>

                    @if(!empty($profile_getting->wordpress))
                    <span class="text-secondary"> <a class="text-secondary"  href="{{$profile_getting->wordpress}}" target="_blank">Wordpress</a> </span>
                    @else
                    <span class="badge badge-danger badge-pill">Not
                        Available url</span>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fab fa-tumblr inst" style="color: #000080;"></i>&nbsp;&nbsp;Tumblr</h6>

                    @if(!empty($profile_getting->tumblr))
                    <span class="text-secondary"> <a class="text-secondary"  href="{{$profile_getting->tumblr}}" target="_blank">Tumblr</a> </span>
                    @else
                    <span class="badge badge-danger badge-pill">Not
                        Available url</span>
                    @endif

                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fab fa-instagram" style="font-size: 25px; color: #e60000;"></i>&nbsp;&nbsp;Instagram</h6>
                    @if(!empty($profile_getting->youtube))
                    <span class="text-secondary"> <a class="text-secondary"  href="{{$profile_getting->youtube}}" target="_blank">Instagram</a> </span>
                    @else
                    <span class="badge badge-danger badge-pill">Not
                        Available url</span>
                    @endif

                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <span>{{$profile_getting->user_name}}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Country Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <span>{{$get_country_name}}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">State Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$get_state_name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">City Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$get_city_name}}
                    </div>
                  </div>
                  <hr>

                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Facebook</small>
                      <span>{{$profile_getting->facebook}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Twitter</small>
                      <span>{{$profile_getting->twitter}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Youtube</small>
                      <span>{{$profile_getting->youtube}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Wordpress</small>
                      <span>{{$profile_getting->wordpress}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Tumblr</small>
                      <span>{{$profile_getting->tumblr}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-Info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Instagram</small>
                      <span>{{$profile_getting->instagram}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>

                      <small>Quora</small>
                      <span>{{$profile_getting->quora}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Pinterest</small>
                      <span>{{$profile_getting->pinterest}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Reddit</small>
                      <span>{{$profile_getting->reddit}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>koo</small>
                      <span>{{$profile_getting->koo}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>scoopit</small>
                      <span>{{$profile_getting->scoopit}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Slashdot</small>
                      <span>{{$profile_getting->slashdot}}</span>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

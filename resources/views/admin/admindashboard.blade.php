@extends('layouts.backend.mainlayout')

@section('title','Account Admin')

@push('css')

@endpush

@section('content')

    <div class="container-fluid">
    <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> </h3>
                                        <a href="{{route('managerwithslug',['org_slug' =>$org_slug])}}')}}"><h5 class="text-muted m-b-0">Manager</h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"></h3>
                                        <a href="{{route('userwithslug',['org_slug'=>$org_slug])}}"><h5 class="text-muted m-b-0">Users</h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> </h3>
                                        <a href="{{route('taskwithslug',['org_slug' => $org_slug])}}"><h5 class="text-muted m-b-0">Task Types</h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Url open -->
                    <div class="col-lg-3 col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> </h3>
                                        <a href="{{route('addurlwithslug',['org_slug' => $org_slug])}}"><h5 class="text-muted m-b-0">  Url</h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--url close-->
                    <!-- Url open -->
                    <div class="col-lg-3 col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-primary"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> </h3>
                                        <a href="{{route('projectwithslug',['org_slug' => $org_slug])}}"><h5 class="text-muted m-b-0">  Project</h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--url close-->
                    <!-- Url open -->
                    <div class="col-lg-3 col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> </h3>
                                        <a href="{{route('keywordwithslug',[ 'org_slug' => $org_slug])}}"><h5 class="text-muted m-b-0">Keyword</h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--url close-->
                    <!-- Url open -->
                    <div class="col-lg-3 col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-warning"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> </h3>
                                        <a href="{{route('socialrankwithslug',['org_slug'=>$org_slug])}}"><h5 class="text-muted m-b-0">Socialrank</h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--url close-->
                    <!-- Url open -->
                    <div class="col-lg-3 col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-dark"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> </h3>
                                        <a href="{{route('webrankwithslug',['org_slug'=>$org_slug])}}"><h5 class="text-muted m-b-0">Webrank</h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--url close-->
                </div>
                <!-- Row -->

            <!-- Best Seo Tool Section Start -->
            <div class="row">
                <div class="col-md-12 col-sm-12 p-20">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Best SEO Tools URL Suggestions<a class="get-code" data-toggle="collapse" href="#pgr2" aria-expanded="true"><i class="fa fa-code" title="Get Code" data-toggle="tooltip"></i></a></h4>


                            <div class="list-group">
                                <a href="https://buffer.com/library/free-seo-tools" class="list-group-item" target="_blank">https://buffer.com/library/free-seo-tools</a>
                                <a href="https://www.pagetraffic.com/blog/top-15-most-recommended-seo-tools/" class="list-group-item" target="_blank">https://www.pagetraffic.com/blog/top-15-most-recommended-seo-tools/</a>
                                <a href="https://www.oberlo.in/blog/seo-tools" class="list-group-item" target="_blank">https://www.oberlo.in/blog/seo-tools</a>

                            </div>

                           


                        </div>
                    </div>
                </div>
            </div>
    </div>

@endsection
@push('js')

@endpush


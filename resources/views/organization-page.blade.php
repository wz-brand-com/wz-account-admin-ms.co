@extends('page-layouts.index')
@section('content')
<style>
    .jumbotron1{
        background-color: #c3dcff;
        width: 100%;
        height: 580px;
    }
</style>

    <!-- jumbostron start bittu here  -->
    <div class="jumbotron1">
        <div class="container">
            <div class="row">
            <div class="col-md-6">
                <div class="jumbotron_con">
                <h1 class="text-white">Create Organizations with WizBrand</h1>
                    <p class="we1 text-justify">See how WizBrand’s content enablement platform aligns workforces and enables employees to create on-brand, high-performing business content faster.</p>
                    <p class="lead mt-2">
                        <a class="btn jumbo_btn1 btn-lg" href="https://www.wizbrand.com/register" role="button">Register</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6" >
            <div class="card" style="box-shadow: 0 1px 1px 2px yellow;">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Organizations Name</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_getting_orgs as $orgslist)
                                  <tr>
                                    <td>{{($orgslist->id)}}</td>
                                    <td>{{ucfirst($orgslist->org_name)}}</td>

                                    <td>{!! date('d-M-y', strtotime($orgslist->created_at)) !!}</td>
                                  </tr>
                                 @endforeach
                                </tbody>
                              </table>
                        </div>

                    </div>
            </div>
        </div>
    </div>
    </div>

  <!-- 2nd step start here  -->
@endsection

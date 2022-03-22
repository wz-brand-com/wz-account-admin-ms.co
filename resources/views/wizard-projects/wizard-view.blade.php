@extends('layouts.backend.mainlayout')
@section('title','wizard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Wizard dashboard</div>
                <!--================== dashboard open ===========================-->
                </div>
                <!--================ dashboard close =============================-->
                <!-- all record will be display open -->
                <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Projectname</th>
                            <th scope="col">Social Url</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wizard_view as $product)
                            <tr>
                                <!-- <th>{{$product->projectname}}</th> -->
                                <!-- <td>{{$product->facebook}}</td> -->
                                <!-- <td>{{$product->linkedIn}}</td>
                                <td>{{$product->twitter}}</td>
                                <td>{{$product->instagram}}</td>
                                <td>{{$product->youtube}}</td>
                                <td>{{$product->pinterest}}</td>
                                <td>{{$product->reddit}}</td>
                                <td>{{$product->tumblr}}</td>
                                <td>{{$product->plurk}}</td>
                                <td>{{$product->getpocket}}</td> -->
                                <span class="float-right"><td class="btn btn-outline-danger"> close</td></span>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                <!-- all record will be display close -->
            </div>
        </div>
    </div>
</div>
@endsection
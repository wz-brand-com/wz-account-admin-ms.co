@extends('layouts.backend.mainlayout')
@section('title','wizard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Wizard dashboard
                <span class="float-right"> <a href="{{route('wizard_slug',['org_slug' =>$org_slug])}}" class="fa fa-home fa-2x">Back to wizard</a></span> 
                </div>
               
                <!-- all record will be display open -->
                <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Projectname</th>
                            <th scope="col">Social Url</th>
                            <th scope="col">Register date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th>{{$product->projectname}}</th>
                                <td>{{$product->facebook}}</td>
                                <td>{!! date('d-M-y', strtotime($product->created_at)) !!}</td>
                                <td class="btn btn-outline-success fa fa-eye"> <a href=""></a> </td>
                                <span class="float-left"><td class="btn btn-outline-warning fa fa-edit"> <a href="#"></a> </td></span>
                                <span class="float-right"><td class="btn btn-outline-danger fa fa-trash"><a href="#"> </a></td></span>
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
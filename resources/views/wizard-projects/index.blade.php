@extends('layouts.backend.mainlayout')
@section('title','wizard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Wizard Record</div>
  
                <div class="card-body">
                      
  
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">facebook</th>
                            <th scope="col">linkedIn</th>
                            <th scope="col">twitter</th>
                            <th scope="col">instagram</th>
                            <th scope="col">youtube</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$product->id}}</th>
                                <td>{{$product->facebook}}</td>
                                <td>{{$product->linkedIn}}</td>
                                <td>{{$product->twitter}}</td>
                                <td>{{$product->instagram}}</td>
                                <td>{{$product->youtube}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
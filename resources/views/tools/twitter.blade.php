@extends('page-layouts.index')
@section('content')

<style>
    button{
    background-color: #5DADE2;
    padding: 8px 20px;
    border: 1px solid #5DADE2;
    border-radius: 8px;
    box-shadow: 2px 2px 10px grey;

}
button:hover{
    box-shadow: 2px 2px 5px #DFFF00;
}
.btn{
    margin-top: 20px !important;
}
</style>

<br>
  <div class="container">
  	<div class="cc">
  		<h2 class="twitter">TWITTER FOLLOWER COUNT</h2>
  	</div>
  	<form action="{{ route('twitter_follower_count')}}" method="post">
          @csrf
	  <div class="form-group">
	    <input type="text" class="form-control" id="twt_name" name="twt_name" placeholder="Enter Username" required="required">
	  </div>
	 <center><button type="submit">Submit</button></center>
    </form>
  </div>
<br><br>
@endsection

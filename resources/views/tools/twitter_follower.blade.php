
@extends('page-layouts.index')
@section('content')

<?php
$tw_username = $_POST['twt_name'];
// print_r($tw_username); die;
$data = file_get_contents('https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names='.$tw_username);
$parsed =  json_decode($data,true);
$tw_followers =  $parsed[0]['followers_count'];
// echo  $tw_followers;
?>

<div class="container">
    <div class="tweet">
        <h2 class="twitter">TWITTER FOLLOWER COUNT</h2>
    </div>
    <div class="result">
     <h2>Name: <span><?php echo $tw_username; ?></span></h2>
     <h3>Followers Count: <span><?php echo  $tw_followers; ?></span></h3>
    <center> <a href="{{ route('twittercount')}}"><button class="btn btn-primary">Check Again</button></a></center>
</div>
</div>
<br><br>
@endsection





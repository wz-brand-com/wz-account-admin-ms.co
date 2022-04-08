

@if(sizeof($data) >0)
@foreach($data as $item)
<div class="col-md-6 col-lg-3 mt-4">
    <div class="card">
        <div class="card-body p-0">
            <div class="cardHeader FirstCardHeaderBgColor">
                <div class="media-icons">
                    <a href="{{$item->facebook}}" target="_blank" class="fab fa-facebook"></a>
                    <a href="{{$item->twitter}}" class="fab fa-twitter"></a>
                    <a href="{{$item->instagram}}" class="fab fa-instagram"></a>
                    
                </div>
            </div>
            <div class="imageDiv">
                <img src="/storage/images/{{ $item->file_pic }}" class="img-fluid image">

            </div>
            <div class="name-profession">
                <span class="name">{{ $item->user_name }}</span>
                <span class="profession">Web Developer</span>
                <span></span>
                <span>{{$item->country_name}}</span>
            </div>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="button">



                <button class="aboutme"> <a class="text-white"
                        href="{{ url('users/profile/'.$item->id . '/'.$item->user_name) }}">View
                        Profile</a></button>


            </div>

        </div>
    </div>
</div>
@endforeach


@else

<tr>

    <th></th>
    <th></th>
    <th></th>
    <th style="font-size: 22px; color:red;">Data not found</th>
    <th></th>
    <th></th>

</tr>

@endif
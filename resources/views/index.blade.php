@extends('layout.app')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
{{--slider--}}
<div id="carouselExampleDark" class="carousel carousel-dark slide">
    <div class="carousel-inner">
        @foreach($sliders as $slider)
            <div class="carousel-item active" data-bs-interval="10000">
                <div class="row h-50">
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center text-white" style="background-color: #5C3422">
                        <h3>{{$slider->text}}</h3>
                        <p class="mt-5"> {{$slider->description}} </p>
                    </div>
                    <div class="col-md-6 bg-info p-0">
                        <img src="{{asset('storage/'.$slider->image)}}" class="image-fluid w-100 h-100" alt="...">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
{{--slider--}}

{{--static data--}}
<div class="container">
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card shadow shadow-sm p-2">
                <div class="d-flex justify-content-center align-items-center text-dark-blue">
                    <div class="mx-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-file-earmark-lock" viewBox="0 0 16 16">
                            <path d="M10 7v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V9.3c0-.627.46-1.058 1-1.224V7a2 2 0 1 1 4 0M7 7v1h2V7a1 1 0 0 0-2 0M6 9.3v2.4c0 .042.02.107.105.175A.64.64 0 0 0 6.5 12h3a.64.64 0 0 0 .395-.125c.085-.068.105-.133.105-.175V9.3c0-.042-.02-.107-.105-.175A.64.64 0 0 0 9.5 9h-3a.64.64 0 0 0-.395.125C6.02 9.193 6 9.258 6 9.3"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                        </svg>
                    </div>
                    <div class="p-3">
                        <h5>Secure Payment</h5>
                        <p>We offer secure shopping facalitites.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow shadow-sm p-2">
                <div class="d-flex justify-content-center align-items-center text-dark-blue">
                    <div class="mx-3 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                        </svg>
                    </div>
                    <div class="p-3">
                        <h5>100% Satisfaction</h5>
                        <p>We provide 100% satisfaction on every shopping.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow shadow-sm p-2">
                <div class="d-flex justify-content-center align-items-center text-dark-blue">
                    <div class="mx-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                        </svg>
                    </div>
                    <div class="p-3">
                        <h5>Easy Return</h5>
                        <p>We offer the esiest return to all users.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--static data--}}

{{--cards--}}
<div class="container py-5">
    <h2 class="text-center">Latest Products</h2>
    <div class="row d-flex align-items-center justify-content-evenly my-4">
        @foreach($latestProduct as $latest)
            <div class="card p-0" style="width: 18rem;">
                <a href="{{url('product/'.$latest->id)}}" style="cursor: pointer" class="text-dark text-decoration-none">
                    <img src="{{asset('storage/'.$latest->images[0])}}" class="card-img-top w-100 m-0" style="height:220px">
                </a>
                    <div class="card-body">
                        <h5 class="card-title"> {{$latest->name}} </h5>
                        <div class="d-flex justify-content-between">
                            <span class="card-text"> <strong>Rs. </strong>{{$latest->productSizes[0]->metal_price + $latest->productSizes[0]->gemstone_price + $latest->productSizes[0]->making_charges + $latest->productSizes[0]->gst}} </span>
                            <span class="my-1 text-warning">
                                @php
                                $rating =  $latest->review->first()->rating ?? 0;
                                @endphp
                                @for ($i = 0; $i < $rating; $i++)
                                <i class="fa-solid fa-star"></i>
                                @endfor
                            </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{url('shop-now/'.$latest->id)}}" class="btn text-white btn-sm px-3" style="background-color: #5C3422">Shop Now</a>
                            <div>
                                @if(in_array($latest->id, $wishlist))
                                    <i class="fa-solid fa-heart fs-5 text-danger heart" data-product-id="{{$latest->id}}" style="cursor: pointer"></i>
                                @else
                                    <i class="fa-regular fa-heart fs-5 text-danger heart" data-product-id="{{$latest->id}}" style="cursor: pointer"></i>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        @endforeach
    </div>

    <h2 class="text-center mt-5">Customer's First Choice</h2>
    <p class="text-center">Our highly rated & Most loved products</p>
        <div class="row d-flex align-items-center justify-content-evenly my-4">
            @foreach($highlyRated as $rated)
                <div class="card p-0" style="width: 18rem;">
                    <a href="{{url('product/'.$rated->product->id)}}" style="cursor: pointer" class="text-dark text-decoration-none">
                        <img src="{{asset('storage/'.$rated->product->images[0])}}" class="card-img-top w-100 m-0" style="height:220px">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"> {{$rated->product->name}} </h5>
                        <div class="d-flex justify-content-between">
                            <span class="card-text"><p class="card-text"> <strong>Rs. </strong>{{$rated->product->productSizes[0]->metal_price + $rated->product->productSizes[0]->gemstone_price + $rated->product->productSizes[0]->making_charges + $rated->product->productSizes[0]->gst}} </p></span>

                            <span class="my-1 text-warning">
                                @php
                                    $rating =  $rated->product->review->first()->rating ?? 0;
                                @endphp
                                @for ($i = 0; $i < $rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{url('shop-now/'.$rated->product->id)}}" class="btn text-white btn-sm px-3" style="background-color: #5C3422">Shop Now</a>
                            <div>
                                @if(in_array($rated->product->id, $wishlist))
                                    <i class="fa-solid fa-heart fs-5 text-danger heart" data-product-id="{{$rated->product->id}}" style="cursor: pointer"></i>
                                @else
                                    <i class="fa-regular fa-heart fs-5 text-danger heart" data-product-id="{{$rated->product->id}}" style="cursor: pointer"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</div>
{{--cards--}}

@endsection

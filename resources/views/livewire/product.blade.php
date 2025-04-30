<div class="container mb-4">
    {{-- section 1 --}}
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($product->images as $key => $img )
                            <div class="carousel-item {{$key == 0 ? 'active' :''}}">
                                <img src="{{asset('storage/'.$img)}}" class="d-block w-100" alt="..." style="height: 550px">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h1 class="text-center">{{$product->name}}</h1>
            <p> <b>About the Product :</b></p>
            {!! $product->description !!}

<div>
    @if($productSizes)
        @foreach($productSizes as $size)
            <button type="button" class="btn border {{$productSize->id == $size->id ? 'border-dark':''}}" wire:click="setSize({{$size->id}})">{{$size->size}}</button>
        @endforeach
    @endif
    @if($product->productDiscounts->count() > 0)
        @foreach($product->productDiscounts as $discount)
            @if ($discount->start_date <= \Carbon\Carbon::now() && $discount->end_date >= \Carbon\Carbon::now())
                <div class="d-flex my-4">
                    <p class="h3 fw-bold">Rs. {{$productSize->metal_price + $productSize->gemstone_price + $productSize->making_charges + $productSize->gst - $discount->discount}}</p>
                    <p class="text-decoration-line-through mx-3">Rs. {{$productSize->metal_price + $productSize->gemstone_price + $productSize->making_charges + $productSize->gst}}</p>
                </div>
            @endif
        @endforeach
    @else
        <p class="h3 fw-bold mt-4">Rs. {{$productSize->metal_price + $productSize->gemstone_price + $productSize->making_charges + $productSize->gst}}</p>
    @endif
            <p class="d-flex">Quantity : &nbsp; <input type="number" wire:model="quantity" value="1" class="form-control form-control-sm" style="width: 100px"> </p>
            <div class="row mt-4">
                <div class="col-md-6 btn text-white" style="background-color: #8A634A" wire:click="AddToCart()">Add To Cart</div>
                <a href="{{url('shop-now/'.$product->id)}}" class="col-md-5 mx-auto btn text-white" style="background-color: #5C3422">Shop Now</a>
            </div>
            <h4 class="text-center mt-5 mb-3">Other Details</h4>
            <table class="table border text-center">
                @if($product->occasion_id)
                    <tr>
                        <td class="fw-bold border">Occasion</td>
                        <td>{{$product->occasion->name}}</td>
                    </tr>
                @endif
                @if($product->metal_id)
                        <tr>
                            <td class="fw-bold border">Metal</td>
                            <td>{{$product->metal->name}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold border">Metal Purity</td>
                            <td>{{$productSize->metal_purity}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold border">Metal Price</td>
                            <td>Rs. {{$productSize->metal_price}}</td>
                        </tr>
                    @endif
                @if($product->gemstone_id)
                <tr>
                    <td class="fw-bold border">Gemstone</td>
                    <td>{{$product->gemstone->name}}</td>
                </tr>
                    <tr>
                        <td class="fw-bold border">Gemstone Purity</td>
                        <td>{{$productSize->gemstone_purity}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold border">Gemstone Price</td>
                        <td>Rs. {{$productSize->gemstone_price}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold border">No. of Gemstone</td>
                        <td>{{$productSize->num_of_gemstone}}</td>
                    </tr>
                @endif


                <tr>
                    <td class="fw-bold border">Total GST</td>
                    <td>{{$productSize->gst}}</td>
                </tr>
            </table>
</div>



        </div>
    </div>
    {{-- section 1 --}}

    @if($product->review->count() > 0)
        <hr>
        <h5>Top Reviews : </h5>
    @endif
    {{--reviews--}}
    @forelse($product->review as $review)
        <div class="row my-2">
            <div class="d-flex align-items-center">
                <img src="{{asset('storage/'.($review->user->avatar ?? 'img.png'))}}" class="rounded-circle" alt="User Image" style="width:50px;height:50px">
                <span class="ms-1">{{$review->user->name}}</span>
            </div>
            <div class="d-flex mx-2">
                @for ($i = 0; $i < $review->rating; $i++)
                    <i class="fa-solid fa-star text-warning d-inline"></i>
                @endfor
            </div>
            <span class="ms-2">{{$review->comment ?? ''}}</span>
            <div class="d-flex ms-1">
                @if($review->image)
                    @foreach($review->image as $img)
                        <img src="{{asset('storage/'.$img)}}" class="rounded mx-1 my-0 p-0" alt="User Image" style="width:80px;height:80px">
                    @endforeach
                @endif
            </div>
        </div>
    @empty

    @endforelse
    {{--reviews--}}
    <div>
    </div>
</div>

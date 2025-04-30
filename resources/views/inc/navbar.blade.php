<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LUXORA | Feel Luxury</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="m-0 p-0">

{{--alerts--}}
<div class="alert alert-success alert-dismissible w-100 fade position-absolute px-5" style="right:0;z-index: 999" id="success-alert">
    <span id="message"></span>
    <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
{{--<!--Main Navigation-->--}}
<header class="m-0">
    <!-- Jumbotron -->
    <div class="p-3 text-center bg-white border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
                    <a href="/" class="ms-md-2">
                        <img src="{{asset('image/dark-logo.png')}}" height="35" />
                    </a>
                </div>

                <div class="col-md-4">

                </div>

                <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
                    <div class="d-flex">
                        <a class="text-reset me-3 mt-1" href="{{url('/search')}}">
                            <i class="fas fa-search" style="color: #5C3422"></i>
                        </a>
                        @guest
                            @if (Route::has('login'))
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Sign In') }}</a> &nbsp; &nbsp;
                            @endif
                            @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                            @endif
                        @else
                            <div class="d-flex align-items-center">
                                <a class="text-reset me-3 mt-1" data-bs-toggle="offcanvas" href="#wishlistcanvas" role="button" aria-controls="cartcanvas">
                                    <i class="fas fa-heart text-danger"></i>
                                </a>
                                <a class="text-reset me-3 mt-1" data-bs-toggle="offcanvas" href="#cartcanvas" role="button" aria-controls="cartcanvas">
                                    <span><i class="fas fa-shopping-cart" style="color: #5C3422"></i></span>
                                </a>
                                <a class="text-reset me-3 mt-1" data-bs-toggle="offcanvas" href="#ordercanvas" role="button" aria-controls="cartcanvas">
                                    <i class="fa-solid fa-bag-shopping" style="color: #5C3422"></i>
                                </a>

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/profile') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Sign Out') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

                {{--cart offset--}}
                <div class="offcanvas offcanvas-end" tabindex="-1" id="cartcanvas" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">My Cart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        @if(Auth::user())
                            @php
                                $tprice =0;
                                $tdelivery =0;
                            @endphp
                            @forelse(Auth::user()->carts as $cart)
                                <div class="card shadow-sm rounded mx-1 mb-1 p-1" id="cart-item-{{$cart->product_id}}">
                                    <div class="row">
                                        <a href="{{url('product/'.$cart->id)}}" class="text-decoration-none text-dark row">
                                            <div class="col-4">
                                                <img src="{{asset('storage/'.$cart->product->images[0])}}" class="w-100 rounded" style="height:68px">
                                            </div>
                                            <div class="col-8 bg-dar p-0 m-0">
                                                <p class="text-start"> {{$cart->product->name}} </p>
                                                @php
                                                    $price = $cart->productSize->metal_price + $cart->productSize->gemstone_price + $cart->productSize->making_charges + $cart->productSize->gst ;
                                                    $tprice += $price;
                                                    $tdelivery += $cart->product->delivery_charge;
                                                @endphp
                                                <div class="d-flex align-items-center m-0 p-0">
                                                    <span>Rs. {{$cart->quantity * $price}}</span>
                                                    <input type="number" value="{{$cart->quantity}}" class="form-control form-control-sm mx-4" style="width: 100px">
                                                </div>
                                            </div>
                                        </a>
                                        <div class="d-flex flex-row align-items-center justify-content-end position-absolute">
                                            <i class="fas fa-close cart" style="cursor: pointer" data-product-id="{{$cart->product_id}}"></i>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3 class="text-center">No Items Added !!</h3>
                            @endforelse

                        @if(Auth::user()->carts->count() > 0)
                            <div class="card shadow shadow-sm px-3">
                                <h3 class="text-center my-auto">Summery</h3>
                                <hr class="my-2">
                                <p> <b>Price : </b> {{$tprice}}</p>
                                <p> <b>Delivery Charge: </b> {{$tdelivery}}</p>
                                <hr class="my-2">
                                <p> <b>Total : </b>{{$tprice + $tdelivery}}</p>
                                <a href="/shop-all" class="w-100 btn text-white" style="background-color: #5C3422">Shop Now</a>
                            </div>
                            @endif

                        @endif
                    </div>
                </div>


                {{--wishlist offset--}}
                <div class="offcanvas offcanvas-end" tabindex="-1" id="wishlistcanvas" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">My Wishlist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        @if(Auth::user())
                            @forelse(Auth::user()->wishlists as $wishlist)
                                <div class="card shadow-sm rounded mx-1 mb-1 p-1">
                                    <div class="row">
                                        <a href="{{url('product/'.$wishlist->id)}}" class="text-decoration-none text-dark row">
                                            <div class="col-4">
                                                <img src="{{asset('storage/'.$wishlist->product->images[0])}}" class="w-100 rounded" style="height:68px">
                                            </div>
                                            <div class="col-8 bg-dar p-0 m-0">
                                                <p class="text-start"> {{$wishlist->product->name}} </p>
                                                @php
                                                    $price = $wishlist->product->productSizes[0]->metal_price + $wishlist->product->productSizes[0]->gemstone_price + $wishlist->product->productSizes[0]->making_charges + $wishlist->product->productSizes[0]->gst ;
                                                @endphp
                                                <div class="d-flex align-items-center m-0 p-0">
                                                    <span>Rs. {{$price}}</span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="d-flex flex-row align-items-center justify-content-end position-absolute">
                                            <i class="fa-solid fa-heart text-danger heart" data-product-id="{{$wishlist->product_id}}"></i>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3 class="text-center">No Items Added !!</h3>
                            @endforelse
                        @endif
                    </div>
                </div>


{{--    orders--}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="ordercanvas" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">My Orders</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if(Auth::user())
                @forelse(Auth::user()->orders as $order)
                    <div class="border rounded p-1">
                        <div class="d-flex  my-2 justify-content-between">
                            <span>Order ID : #ORD{{$order->id}}</span>
                            @if($order->status == 'delivered')
                                <a href="{{url('/pdf/'.$order->id)}}" target="_blank" class="btn btn-sm text-white w-auto text-decoration-none" style="background-color: #5C3422"><i class="fa-regular fa-circle-down mx-1"></i>Download Invoice</a>
                            @endif
                        </div>
                        @foreach($order->orderDetails as $ordItm)
                        <div class="card shadow-sm rounded mx-1 mb-1 p-1">
                            <div class="row">
                                <a href="{{url('product/'.$ordItm->product->id)}}" class="text-decoration-none text-dark row">
                                    <div class="col-4">
                                        <img src="{{asset('storage/'.$ordItm->product->images[0])}}" class="w-100 rounded" style="height:68px">
                                    </div>
                                    <div class="col-8 bg-dar p-0 m-0">
                                        <p class="text-start"> {{$ordItm->product->name}} </p>
                                        @php
                                            $price = $ordItm->product->productSizes[0]->metal_price + $ordItm->product->productSizes[0]->gemstone_price + $ordItm->product->productSizes[0]->making_charges + $ordItm->product->productSizes[0]->gst ;
                                        @endphp
                                        <div class="d-flex align-items-center m-0 p-0">
                                            <span>Rs. {{$price}}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-flex flex-row align-items-center justify-content-end">
                                    <span class="badge bg-gradient
                                        @if($order->status == 'pending') bg-secondary
                                        @elseif($order->status == 'delivered') bg-success
                                        @elseif($order->status == 'cancelled') bg-danger
                                        @elseif($order->status == 'shipped') bg-warning
                                        @endif">
                                        {{$order->status}}
                                    </span>
                                    <a href="{{url('review/'.$ordItm->product_id)}}" class=" btn badge bg-gradient btn-sm mx-1" style="background-color: #5C3422">
                                        Rate Product
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @empty
                    <h3 class="text-center">No Items Added !!</h3>
                @endforelse
            @endif
        </div>
    </div>

    <!-- Jumbotron -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <!-- Container wrapper -->
        <div class="container justify-content-center justify-content-md-between">
            <!-- Left links -->
            <ul class="navbar-nav flex-row">
                <li class="nav-item me-2 me-lg-0 d-pnone d-md-inline-block">
                    <a class="nav-link" href="/all-products">All Products</a>
                </li>
                <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
                    <a class="nav-link" href="/categories">Categories</a>
                </li>
                <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
                    <a class="nav-link" href="/women">Women</a>
                </li>
                <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
                    <a class="nav-link" href="/men">Men</a>
                </li>
            </ul>
            <!-- Left links -->

            <div class="">
                <i class="fas fa-phone ms-2 mx-2"></i>+91-1234567890
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

</header>


@extends('layout.app')
@section('content')

<div class="container my-2">
    <h2 class="text-center">Shop Now</h2>
    <div class="container my-3 card py-2">
        <h4 class="text-center">User Details</h4>
        <form action="{{url('shopNow')}}" method="POST">
            @csrf

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="payment_mode" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="payment_mode" class="form-label">Payment Mode <span class="text-danger">*</span></label>
                    <select id="payment_mode" name="payment_mode" class="form-select">
                        <option value="COD">Cash on Delivery</option>
                    </select>
                    @error('payment_mode')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="row m-0">
                    <p>Select Address <span class="text-danger">*</span></p>
                    @foreach(auth()->user()->userAddresses as $k => $add)
                            <div class="mb-3 col-md-6 border rounded mx-auto">
                                <input type="radio" name="address" value="{{ $add->id }}" id="address_{{ $add->id }}" {{$k == 0 ? 'checked' : ''}}>
                                <label for="address_{{ $add->id }}" class="d-flex form-label"> {!! $add->address !!}, {{$add->city}}, {{$add->state}}, {{$add->pin}} ,    <b>Mo:</b> {{$add->phone}}</label><br>
                            </div>
                    @endforeach
                    @error('address')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="row m-0">
                    @if($product->express_delivery_available)
                    <div class="col-md-6">
                        <label class="d-flex">
                            <input type="checkbox" name="is_express_delivery" class="form-check mx-2"/>
                            Express Delivery
                        </label>
                        <p><b>Express Delivery Charge : </b>{{$product->express_delivery_charge}}</p>
                    </div>
                    @endif
                    <div class="col-md-2">
                        <label class="d-flex">
                            <input type="checkbox" name="is_gifted" class="form-check mx-2"/>
                            Gift Someone Special
                        </label>
                        <p><b>Free (No Charge)</b></p>
                    </div>
                </div>
            </div>

    </div>


    <div class="row">
        <div class="container my-3 card py-2">
    <h4 class="text-center">Product Details</h4>
            @if(auth()->user()->orders->count() == 0)
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Congrats 🎉!! This will be your first order, You will get Rs. 5000 off on first order item !!🥳
                    </div>
            @endif
            <div class="row py-2">
                <input type="hidden" name="product_id" value="{{$product->id}}" id="productId">
                <div class="col-3">
                    <img src="{{ asset('storage/'.$product->images[0] )}}" alt="{{ $product->name }}" class="product-image card-img-top" style="height: 200px">
                </div>
                <div class="col-9 px-3">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <div class="row">
                        <p class="card-text col-md-6">Size <span class="text-danger">*</span>
                            <select class="form-select" id="sizeSelect" name="product_size">
                                <option value="">Select Size</option>
                                @foreach($product->productSizes as $size)
                                    <option value="{{ $size->size }}">{{ $size->size }}</option>
                                @endforeach
                            </select>
                            @error('product_size')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </p>
                        <div class="col-md-6">
                            <label for="quantity">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="quantity-selector form-control" value="1" id="quantity" name="quantity">
                            @error('quantity')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        @if(auth()->user()->orders->count() == 0)
                            <b>You will get Rs. 5000 off in mentioned price !!</b>
                        @endif
                        <p class="card-text" id="productSizePrice"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn text-white d-block mx-auto" style="background-color: #5C3422">Shop Now</button>
    </form>
</div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#sizeSelect').on('change', function() {
            var productId = $('#productId').val();
            var size = $(this).val();
            $.ajax({
                url: '/productsize/' + productId + '/' + size,
                type: 'GET',
                success: function(response) {
                    $('#productSizePrice').html('Price : Rs.'+response+' /Pc');
                },
                error: function(error) {
                    alert('Error in removing product.... !');
                }
            });
        });
    });
</script>

@extends('layout.app')
@section('content')

    <div class="container my-2">
        <h2 class="text-center">Order Cart Items</h2>
        <div class="container my-3 card py-2">
            <h4 class="text-center">User Details</h4>
            <form action="{{url('shopAll')}}" method="POST">
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
                </div>
        </div>

        <div class="container my-3 card py-2">
            <h4 class="text-center">Cart Details</h4>
            @if(auth()->user()->orders->count() == 0)
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    Congrats 🎉!! This will be your first order, You will get Rs. 5000 off on first order item !!🥳
                </div>
            @endif
            @foreach(auth()->user()->carts as $key => $cartItem)
                <div class="row py-2">
                    <input type="hidden" name="product_id[]" value="{{$cartItem->product_id}}">
                    <div class="col-3">
                        <img src="{{ asset('storage/'.$cartItem->product->images[0] )}}" alt="{{ $cartItem->product->name }}" class="product-image card-img-top" style="height: 200px">
                    </div>
                    <div class="col-9 px-3">
                        <h5 class="card-title">{{ $cartItem->product->name }}</h5>
                        <div class="row">
                            <input type="hidden" class="product-id" value="{{$cartItem->product_id}}">
                            <input type="hidden" class="index" value="{{$key}}">
                            <p class="card-text col-md-6">Size <span class="text-danger">*</span>
                                <select class="form-select" name="product_size[]">
                                    <option value="">Select Size</option>
                                    @foreach($cartItem->product->productSizes as $size)
                                        <option value="{{ $size->id }}" {{ $cartItem->product_size_id == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                                    @endforeach
                                </select>
                                @error('product_size')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </p>
                            <div class="col-md-6">
                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="quantity-selector form-control" value="{{ $cartItem->quantity }}" name="quantity[]">
                                @error('quantity')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            @if(auth()->user()->orders->count() == 0)
                                <b>You will get Rs. 5000 off in mentioned price !!</b>
                            @endif
                            <p class="card-text" id="productSizePrice{{$key}}">Price : Rs. {{$cartItem->productSize->metal_price + $cartItem->productSize->gemstone_price + $cartItem->productSize->making_charges + $cartItem->productSize->gst}} /Pc</p>
                        </div>
                        <div class="row mx-0 my-2">
                            <div class="col-md-6">
                                <label class="d-flex {{$cartItem->product->express_delivery_available==0 ? 'text-decoration-line-through':''}}">
                                    <input type="checkbox" name="is_express_delivery[{{$key}}]" class="form-check mx-2" {{$cartItem->product->express_delivery_available==0 ? 'disabled':''}}/>
                                    Express Delivery
                                </label>
                                <p><b>Express Delivery Charge : </b>Rs. {{$cartItem->product->express_delivery_charge ?? ''}}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="d-flex">
                                    <input type="checkbox" name="is_gifted[{{$key}}]" class="form-check mx-2"/>
                                    Gift Someone Special
                                </label>
                                <p><b>Free (No Charge)</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <button type="submit" class="btn text-white d-block mx-auto mb-3" style="background-color: #5C3422" {{auth()->user()->carts()->count() == 0 ?'disabled':''}}>Order All Items</button>
    </form>
    </div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('select[name="product_size[]"]').on('change', function() {
            var productId = $(this).closest('.row').find('.product-id').val();
            var size = $(this).val();
            var index = $(this).closest('.row').find('.index').val();
            $.ajax({
                url: '/productsize/' + productId + '/' + size,
                type: 'GET',
                success: function(response) {
                    $('#productSizePrice' + index).html('Price : Rs.' + response + ' /Pc');
                },
                error: function(error) {
                }
            });
        });
    });
</script>

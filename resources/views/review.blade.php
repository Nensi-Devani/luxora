@extends('layout.app')
@section('content')

    <div class="container">
        <h3 class="text-center">Review Product</h3>
        @if($product)
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm rounded mx-1 mb-1 p-1">
                        <div class="row">
                            <a href="{{url('product/'.$product->id)}}" class="text-decoration-none text-dark row">
                                <div class="col-5">
                                    <img src="{{asset('storage/'.$product->images[0])}}" class="w-100 rounded" style="height:150px">
                                </div>
                                <div class="col-7 bg-dar p-0 m-0">
                                    <p class="text-start"> {{$product->name}} </p>
                                    @php
                                        $price = $product->productSizes[0]->metal_price + $product->productSizes[0]->gemstone_price + $product->productSizes[0]->making_charges + $product->productSizes[0]->gst ;
                                    @endphp
                                    <div class="d-flex align-items-center m-0 p-0">
                                        <span>Rs. {{$price}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm rounded mx-1 mb-1 p-1">
                        <form action="{{url('addReview')}}" type="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="col-md-6">
                                    <label class="form-label">Review</label>
                                    <select class="form-select" name="rating">
                                        <option value="1">Very Bad</option>
                                        <option value="2">Bad</option>
                                        <option value="3">Ok OK</option>
                                        <option value="4">Good</option>
                                        <option value="5" selected>Very Good</option>
                                    </select>
                                    @error('rating')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Comment</label>
                                    <textarea name="comment" class="form-control"></textarea>
                                    @error('comment')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn text-white w-auto mx-auto my-3" style="background-color: #5C3422">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

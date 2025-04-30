<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="card mt-3">
                    <div class="card-header text-white" style="background-color:#5c3422dc">Category</div>
                    <div class="card-body">
                        @foreach($categories as $category)
                            <label>
                                <input type="checkbox" value="{{$category->id}}" wire:model.live="category">
                                {{$category->name}}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header text-white" style="background-color:#5c3422dc">Occasion</div>
                    <div class="card-body">
                        @foreach($occasions as $occasion)
                            <label>
                                <input type="checkbox" value="{{$occasion->id}}" wire:model.live="occasion">
                                {{$occasion->name}}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header text-white" style="background-color:#5c3422dc">Metal</div>
                    <div class="card-body">
                        @foreach($metals as $metal)
                            <label>
                                <input type="checkbox" value="{{$metal->id}}" wire:model.live="metal">
                                {{$metal->name}}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>
                <div class="card my-2">
                    <div class="card-header text-white" style="background-color:#5c3422dc">Gemstone</div>
                    <div class="card-body">
                        @foreach($gemstones as $gemstone)
                            <label>
                                <input type="checkbox" value="{{$gemstone->id}}" wire:model.live="gemstone">
                                {{$gemstone->name}}
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row d-flex align-items-center ">
                    @forelse($products as $product)
                        <div class="card p-0 mt-3 mx-1" style="width: 18rem;">
                            <a href="{{url('product/'.$product->id)}}" style="cursor: pointer" class="text-dark text-decoration-none">
                                <img src="{{asset('storage/'.$product->images[0])}}" class="card-img-top w-100 m-0" style="height:220px">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"> {{$product->name}} </h5>

                                <div class="d-flex justify-content-between">
                                        <span class="card-text">  <p class="card-text"> <strong>Rs. </strong>{{$product->productSizes[0]->metal_price + $product->productSizes[0]->gemstone_price + $product->productSizes[0]->making_charges + $product->productSizes[0]->gst}} </p></span>
                                    <span class="my-1 text-warning">
                                    @php
                                        $rating =  $product->review->first()->rating ?? 0;
                                    @endphp
                                        @for ($i = 0; $i < $rating; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                            </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="{{url('shop-now/'.$product->id)}}" class="btn text-white btn-sm px-3" style="background-color: #5C3422">Shop Now</a>
                                    <div>
                                        @if(in_array($product->id, $wishlist))
                                            <i class="fa-solid fa-heart fs-5 text-danger heart" data-product-id="{{$product->id}}" style="cursor: pointer"></i>
                                        @else
                                            <i class="fa-regular fa-heart fs-5 text-danger heart" data-product-id="{{$product->id}}" style="cursor: pointer"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3 style="color: #5C3422" class="text-center my-5">No Products Available !!!</h3>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

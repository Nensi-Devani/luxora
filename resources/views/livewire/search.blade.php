<div class="container" style="min-height: 500px">
    <form class="d-flex input-group w-auto my-auto mb-3 mb-md-0">
        <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search Products" wire:model.live="search"/>
        <span class="input-group-text border-0 d-none d-lg-flex" style="background-color: #5C3422"><i class="fas fa-search text-light"></i></span>
    </form>

{{--    <livewire:filter :products="$products" :gender="$gender"/>--}}
    <div class="row d-flex align-items-center ">
        @forelse($products as $product)
            <div class="card p-0 mt-3 mx-1" style="width: 18rem;">
                <a href="{{url('product/'.$product->id)}}" style="cursor: pointer" class="text-dark text-decoration-none">
                    <img src="{{asset('storage/'.$product->images[0])}}" class="card-img-top w-100 m-0" style="height:220px">
                </a>
                <div class="card-body">
                    <h5 class="card-title"> {{$product->name}} </h5>
                    <p class="card-text"> <strong>Rs. </strong>{{$product->productSizes[0]->metal_price + $product->productSizes[0]->gemstone_price + $product->productSizes[0]->making_charges + $product->productSizes[0]->gst}} </p>
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

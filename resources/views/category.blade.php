@extends('layout.app')
@section('content')

    <div class="container my-2">
        <div class="row d-flex align-items-center justify-content-evenly">
            @foreach($category->children as $parent)
                <div class="card m-2" style="width: 18rem;">
                    <a href="{{url('products/'.$parent->id)}}" class="text-decoration-none text-dark">
                        <img src="{{asset('storage/'.$parent->image)}}" class="card-img-top image-fluid" alt="Card image cap" height="230">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$parent->name}}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection

<div class="container my-3">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/'.(auth()->user()->avatar ?? 'img.png')) }}" class="card-img-top" alt="Card image" height="280px">
                <div class="card-body">
                    <h5 class="card-title text-center">{{auth()->user()->name}}</h5>
                    <p class="text-secondary text-center">{{auth()->user()->email}}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-9 border">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{$tabOpen == 1 ? 'active':''}}" wire:click="tabOpn(1)" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{$tabOpen == 2 ? 'active':''}}" wire:click="tabOpn(2)" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{$tabOpen == 3 ? 'active':''}}" wire:click="tabOpn(3)" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Addresses</a>
                </li>
            </ul>
            <div class="tab-content my-3" id="myTabContent">
                <div class="tab-pane fade {{$tabOpen == 1 ? 'show active':''}}" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h5>Profile :</h5>
                        <form wire:submit.prevent="updateName">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name </label>
                                    <input type="text" class="form-control" wire:model="name">
                                    @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Avatar</label>
                                    <input type="file" class="form-control" wire:model="avatar">
                                </div>
                                <button type="submit" class="btn text-white mt-3 mx-auto w-auto" style="background-color: #5C3422">Update</button>
                            </div>
                        </form>
                </div>
                <div class="tab-pane fade {{$tabOpen == 2 ? 'show active':''}}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h5>Change Password : </h5>
                    <form wire:submit.prevent="changePassword">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Password </label>
                                <input type="text" class="form-control" wire:model="oldPass">
                                @error('oldPass')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">New Password </label>
                                <input type="text" class="form-control" wire:model="newPass">
                                @error('newPass')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Confirm Password </label>
                                <input type="text" class="form-control" wire:model="newPass_confirmation">
                                @error('newPass_confirmation')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn text-white mt-3 mx-auto w-auto" style="background-color: #5C3422">Change Password</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade {{$tabOpen == 3 ? 'show active':''}}" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <h5>Addresses : </h5>
                    <div class="d-flex justify-content-evenly mx-2">
                        @foreach(auth()->user()->userAddresses as $k => $add)
                            <div class="mb-3 border p-2 rounded mx-auto">
                                <label for="address_{{ $add->id }}" class="d-flex form-label"> {!! $add->address !!}, {{$add->city}}, {{$add->state}}, {{$add->pin}} ,    <b>Mo:</b> {{$add->phone}}</label><br>
                            </div>
                        @endforeach
                    </div>
                    <h5>Add New Address</h5>
                    <form wire:submit.prevent="addAddress">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Address </label>
                                <textarea type="text" class="form-control" wire:model="address"></textarea>
                                @error('address')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Pincode </label>
                                <input type="text" class="form-control" wire:model="pin">
                                @error('pin')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">City </label>
                                <input type="text" class="form-control" wire:model="city">
                                @error('city')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">State </label>
                                <input type="text" class="form-control" wire:model="state">
                                @error('state')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone </label>
                                <input type="text" class="form-control" wire:model="phone">
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn text-white mt-3 mx-auto w-auto" style="background-color: #5C3422">Add Address</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

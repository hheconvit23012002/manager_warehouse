@extends('layout.shop.master')

@section('content')
    <div style="height: 100px"></div>
    <div class="mt-5 mb-5 " style="border-radius: 8px;padding: 10px; border: 1px dashed #363434" ;>
        <div class="row justify-content-start">
            @foreach($centers as $center)
                @include('shop.brand',[
                    'value' => $center->id,
                    'logo' => $center->logo,
                    'name' => $center->name,
                ])
            @endforeach
        </div>
    </div>
    <div class="border border-secondary mb-5">
    </div>
    <div>
        <div class="section">
            <div class="row">
                <div class="col-md-3">
                    <div class="collapse-panel">
                        <div class="card-body">
                            <form action="">
                                <input type="hidden" name="center_id" value="{{ $centerId }}">

                                <div class="card card-plain">
                                    <h4 class="card-title">
                                        Find
                                    </h4>
                                </div>
                                <div class="card card-refine card-plain">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h6 class="mb-0">
                                            <a class="" data-toggle="collapse" data-parent="#accordion"
                                               href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                Category
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </a>
                                        </h6>
                                    </div>
                                    @if($categories->count() > 0)
                                        <div id="collapseTwo" class="collapse show" role="tabpanel"
                                             aria-labelledby="headingTwo" style="">
                                            <div class="card-body">
                                                @foreach($categories as $category)
                                                    <div class="checkbox">
                                                        <input id="checkbox-category-{{ $category->id }}"
                                                               type="checkbox" name="category[]"
                                                               value="{{  $category->id }}">
                                                        <label for="checkbox-category-{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button class="btn btn-rose btn-round">
                                    <i class="material-icons">search</i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 rounded " style="">
                                <div class="card card-product card-plain">
                                    <div class="">
                                        <img src="{{ asset("storage/" . $product->image) }}" style="width: 100%" height="150px">
                                    </div>
                                    <div class="card-body">
                                        <a href="#">
                                            <h4 class="" style="font-weight: 700">Name : {{ $product->name }}</h4>
                                        </a>
                                        <p class="">
                                            Code : {{ $product->code}}
                                        </p>
                                        <p class="">
                                            Number : {{ $product->number}}
                                        </p>
                                        <p class="">
                                            Estimate ship : {{ $product->estimate }}
                                        </p>
                                        <div class="card-footer row">
                                            <div class="price-container col-4">
                                                <span class=""> € {{ $product->price }}</span>
                                            </div>
                                            <div class="col-8">
                                                <div class="{{ !empty($product->hasAdd) ? 'd-flex float-right' : 'd-none' }} ">
                                                    <button class="nav-link btn btn-primary p-2 " onclick="changeCart(this, {{$product->id}}, {{ $centerId }}, -1)">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button>
                                                    <input type="number"  value="{{ $product->hasAdd }}" class="form-control " style="width: 80px" onchange="enterNumberProduct(this, {{$product->id}}, {{ $centerId }})">
                                                    <button class="nav-link btn btn-primary p-2" onclick="changeCart(this, {{$product->id}}, {{ $centerId }}, 1)">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="{{ !is_null($product->hasAdd) ? 'd-none' : 'float-right' }} ">
                                                    <button class="nav-link btn btn-primary p-2 " onclick="changeCart(this, {{$product->id}}, {{ $centerId }}, 1)">
                                                        Add to cart
                                                    </button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

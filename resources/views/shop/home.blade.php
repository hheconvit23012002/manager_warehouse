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
                                            <h4 class="">{{ $product->name }}</h4>
                                        </a>
                                        <p class="">
                                            Category: {{ $product->category_name }}
                                        </p>
                                        <div class="card-footer d-flex flex-row justify-content-between">
                                            <div class="price-container">
                                                <span class=""> € {{ $product->price }}</span>
                                            </div>
                                            <button class="nav-link btn btn-primary p-2" onclick="addToCart({{$product->id}}, {{ $centerId }})">
                                                Add to cart
                                            </button>
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

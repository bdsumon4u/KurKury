@if(get_setting('home_categories') != null) 
    @php $home_categories = json_decode(get_setting('home_categories')); @endphp
    @php $home_categories_number = json_decode(get_setting('home_categories_number'), true); @endphp
    @foreach (\App\Models\Category::find($home_categories) as $key => $category)
        <section class="mb-4">
            <div class="container">
                <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                    <div class="d-flex mb-3 align-items-baseline border-bottom">
                        <h3 class="h5 fw-700 mb-0">
                            <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ $category->getTranslation('name') }}</span>
                        </h3>
                        {{-- <a href="{{ route('products.category', $category->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a> --}}
                    </div>
                    <div class="row">
                        @foreach (get_cached_products($category->id, $home_categories_number[$key]) as $key => $product)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6" style="padding-left: 10px; padding-right: 10px;">
                                @include('frontend.partials.product_box_1',['product' => $product])
                            </div>
                        @endforeach
                        <div class="col col-12 text-center">
                            <a href="{{ route('products.category', $category->slug) }}" class="btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                        </div>
                    </div>
                    {{-- <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                        @foreach (get_cached_products($category->id) as $key => $product)
                            <div class="carousel-box">
                                @include('frontend.partials.product_box_1',['product' => $product])
                            </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </section>
    @endforeach
@endif


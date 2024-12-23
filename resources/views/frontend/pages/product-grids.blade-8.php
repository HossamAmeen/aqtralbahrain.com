@extends('frontend.layouts.master')

@section('title','Aqtr Albahrain || PRODUCT PAGE')

@section('main-content')

<!-- Product Style -->
<form action="{{route('shop.filter')}}" method="POST" @if(app()->getLocale()=="ar") style="direction:rtl;text-align:right" @endif>
    @csrf
    <section class="product-area shop-sidebar shop section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="shop-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">{{__('application.categories')}}</h3>
                            <ul class="categor-list">
                                @php
                                // $category = new Category();
                                $menu=App\Models\Category::getAllParentWithChild();
                                @endphp
                                @if($menu)
                                <li>
                                    @foreach($menu as $cat_info)
                                    @if($cat_info->child_cat->count()>0)
                                <li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
                                    <ul>
                                        @foreach($cat_info->child_cat as $sub_menu)
                                        <li><a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">{{$sub_menu->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                <li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a></li>
                                @endif
                                @endforeach
                                </li>
                                @endif
                                {{-- @foreach(Helper::productCategoryList('products') as $cat)
                                            @if($cat->is_parent==1)
												<li><a href="{{route('product-cat',$cat->slug)}}">{{$cat->title}}</a></li>
                                @endif
                                @endforeach --}}
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Shop By Price -->
                        <div class="single-widget range">
                            <h3 class="title">{{__('application.shop_by_price')}}</h3>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    @php
                                    $max=DB::table('products')->max('price');
                                    // dd($max);
                                    @endphp
                                    <div id="slider-range" data-min="0" data-max="{{$max}}"></div>
                                    <div class="product_filter">
                                        <button type="submit" class="filter_button">{{__('application.filter')}}</button>
                                        <div class="label-input">
                                            <span>{{__('application.rang')}}:</span>
                                            <input style="" type="text" id="amount" readonly />
                                            <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--/ End Shop By Price -->
                        <!-- Single Widget -->
                        <div class="single-widget recent-post">
                            <h3 class="title">{{__('application.recent_post')}}</h3>
                            {{-- {{dd($recent_products)}} --}}
                            @foreach($recent_products as $product)
                            <!-- Single Post -->
                            @php
                            $photo=explode(',',$product->photo);
                            @endphp
                            <div class="single-post first">
                                <div class="image">
                                    <img src="{{$product->photo}}" alt="{{$photo[0]}}">
                                </div>
                                <div class="content">
                                    <h5><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h5>
                                    @php
                                    $org=($product->price-($product->price*$product->discount)/100);
                                    @endphp
                                    <p class="price"><del class="text-muted">${{number_format($product->price,2)}}</del> {{number_format($org,2)}} </p>

                                </div>
                            </div>
                            <!-- End Single Post -->
                            @endforeach
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">{{__('application.brands')}}</h3>
                            <ul class="categor-list">
                                @php
                                $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                                @endphp
                                @foreach($brands as $brand)
                                <li><a href="{{route('product-brand',$brand->slug)}}">{{$brand->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- Shop Top -->
                            <div class="shop-top">
                                <div class="shop-shorter">
                                    <div class="single-shorter">
                                        <label>{{__('application.shop')}} :</label>
                                        <select class="show" name="show" onchange="this.form.submit();">
                                            <option value="">{{__('application.default')}}</option>
                                            <option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9' ) selected @endif>09</option>
                                            <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15' ) selected @endif>15</option>
                                            <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21' ) selected @endif>21</option>
                                            <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30' ) selected @endif>30</option>
                                        </select>
                                    </div>
                                    <div class="single-shorter">
                                        <label>{{__('application.sort_by')}} :</label>
                                        <select class='sortBy' name='sortBy' onchange="this.form.submit();">
                                            <option value="">{{__('application.default')}}</option>
                                            <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title' ) selected @endif>{{__('application.name')}}</option>
                                            <option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price' ) selected @endif>{{__('application.price')}}</option>
                                            <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category' ) selected @endif>{{__('application.category')}}</option>
                                            <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand' ) selected @endif>{{__('application.brand')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <ul class="view-mode">
                                    <li class="active"><a href="javascript:void(0)"><i class="fa fa-th-large"></i></a></li>
                                    <li><a href="{{route('product-lists')}}"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                            </div>
                            <!--/ End Shop Top -->
                        </div>
                    </div>
                    <div class="row pt-3">
                        {{-- {{$products}} --}}
                        @if(count($products)>0)
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card product-card product-grid">
                                <img class="card-img-top" src="{{$product->photo}}" alt="{{$photo[0]}}">
                                <div class="card-body">
                                    <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                    <div class="product-price">
                                        @php
                                        $after_discount=($product->price-($product->price*$product->discount)/100)
                                        @endphp
                                        <span class="price">{{number_format($after_discount,2)}}ج.م</span>
                                        <span class="old-price">{{number_format($product->price,2)}}ج.م</span>
                                    </div>
                                    <div class="product-actions d-flex justify-content-center align-items-center mt-4">
                                        <button type="button" class="btn py-1 ml-2"><a href="{{route('add-to-cart',$product->slug)}}"><i class="ti-bag"></i> {{__('application.add_to_cart')}}</a></button>
                                        <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h4 class="text-warning" style="margin:100px auto;">{{__('application.there_are_no_product')}}</h4>
                        @endif



                    </div>
                    <div class="row">
                        <div class="col-md-12 justify-content-center d-flex">
                            {{$products->appends($_GET)->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</form>

<!--/ End Product Style 1  -->



<!-- Modal -->
@if($products)
@foreach($products as $key=>$product)
<div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                        <!-- Product Slider -->
                        <div class="product-gallery">
                            <div class="quickview-slider-active">
                                @php
                                $photo=explode(',',$product->photo);
                                // dd($photo);
                                @endphp
                                @foreach($photo as $data)
                                <div class="single-slider">
                                    <img src="{{$data}}" alt="{{$data}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Product slider -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h2>{{$product->title}}</h2>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                    <div class="quickview-ratting">
                                        {{-- <i class="yellow fa fa-star"></i>
                                                        <i class="yellow fa fa-star"></i>
                                                        <i class="yellow fa fa-star"></i>
                                                        <i class="yellow fa fa-star"></i>
                                                        <i class="fa fa-star"></i> --}}
                                        @php
                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                        @endphp
                                        @for($i=1; $i<=5; $i++)
                                            @if($rate>=$i)
                                            <i class="yellow fa fa-star"></i>
                                            @else
                                            <i class="fa fa-star"></i>
                                            @endif
                                            @endfor
                                    </div>
                                    <a href="#"> ({{$rate_count}} {{__('application.customer_review')}})</a>
                                </div>
                                <div class="quickview-stock">
                                    @if($product->stock >0)
                                    <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} {{__('application.in_stock')}}</span>
                                    @else
                                    <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} {{__('application.out_stock')}}</span>
                                    @endif
                                </div>
                            </div>
                            @php
                            $after_discount=($product->price-($product->price*$product->discount)/100);
                            @endphp
                            <h3><small><del class="text-muted">${{number_format($product->price,2)}}</del></small> ${{number_format($after_discount,2)}} </h3>
                            <div class="quickview-peragraph">
                                <p>{!! html_entity_decode($product->summary) !!}</p>
                            </div>
                            @if($product->size)
                            <div class="size">
                                <h4>{{__('application.size')}}</h4>
                                <ul>
                                    @php
                                    $sizes=explode(',',$product->size);
                                    // dd($sizes);
                                    @endphp
                                    @foreach($sizes as $size)
                                    <li><a href="#" class="one">{{$size}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="size">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">{{__('application.size')}}</h5>
                                        <select>
                                            @php
                                            $sizes=explode(',',$product->size);
                                            // dd($sizes);
                                            @endphp
                                            @foreach($sizes as $size)
                                            <option>{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-lg-6 col-12">
                                                        <h5 class="title">{{__('application.color')}}</h5>
                                    <select>
                                        <option selected="selected">{{__('application.orang')}}</option>
                                        <option>{{__('application.purple')}}</option>
                                        <option>{{__('application.black')}}</option>
                                        <option>{{__('application.pink')}}</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        <form action="{{route('single-add-to-cart')}}" method="POST">
                            @csrf
                            <div class="quantity">
                                <!-- Input Order -->
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="slug" value="{{$product->slug}}">
                                    <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </div>
                            <div class="add-to-cart">
                                <button type="submit" class="btn">{{__('application.add_to_cart')}}</button>
                                <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i class="ti-heart"></i></a>
                            </div>
                        </form>
                        <div class="default-social">
                            <!-- ShareThis BEGIN -->
                            <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
@endif
<!-- Modal end -->

@endsection
@push('styles')
<style>
    .pagination {
        display: inline-flex;
    }

    .filter_button {
        /* height:20px; */
        text-align: center;
        background: #F7941D;
        padding: 8px 16px;
        margin-top: 10px;
        color: white;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
{{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
type:"POST",
data:{
_token:"{{csrf_token()}}",
quantity:quantity,
pro_id:pro_id
},
success:function(response){
console.log(response);
if(typeof(response)!='object'){
response=$.parseJSON(response);
}
if(response.status){
swal('success',response.msg,'success').then(function(){
document.location.href=document.location.href;
});
}
else{
swal('error',response.msg,'error').then(function(){
// document.location.href=document.location.href;
});
}
}
})
});
</script> --}}
<script>
    $(document).ready(function() {
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt($("#slider-range").data('max')) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value + '-' + max_value;
            if ($("#price_range").length > 0 && $("#price_range").val()) {
                price_range = $("#price_range").val().trim();
            }

            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function(event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  " + currency + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
        }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  " + m_currency + $("#slider-range").slider("values", 1));
        }
    })
</script>
@endpush

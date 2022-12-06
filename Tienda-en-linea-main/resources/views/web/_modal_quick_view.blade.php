<div class="modal" id="quick_view{{$product->id}}">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider slick-arrow-style_2 mb-20">

                                @foreach ($product->images as $image)
                                <div class="pro-large-img">
                                        <img src="{{$image->url}}" alt="{{$product->name}}"/>
                                    </div>
                                @endforeach
                                </div>
                                <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                @foreach ($product->images as $image)
                                <div class="pro-large-img">
                                <div class="pro-nav-thumb"><img src="{{$image->url}}" alt="{{$product->name}}" /></div>
                                    </div>
                                @endforeach
                                   
                                    
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <h3><a href="{{route('web.product_details',$product)}}">{{$product->name}}</a></h3>
                                    <div class="ratings">
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <div class="pro-review">
                                            <span>1 review(s)</span>
                                        </div>
                                    </div>
                                    <div class="availability mt-10">
                                        <h5>Disponible:</h5>
                                        <span>{{$product->stock}} en stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">${{$product->sell_price}}</span>
                                    </div>
                                    <p>{{$product->short_description}}</p>
                                    @include('web._add_to_shopping_cart_form', ['class'=>'mt-20'])
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->
                </div>
            </div>
        </div>
    </div>
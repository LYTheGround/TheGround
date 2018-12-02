<div class="row">
    @foreach($purchaseds as $purchased)
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="product" style="{{ ($purchased->store_qt > 0) ? (((int) $purchased->store_qt - (int) $purchased->offer_qt) == 0) ? 'background-color: yellow !important;' : 'background-color: green !important;' : 'background-color: #761c19 !important;'}}">
                <div class="product-inner">
                    <img alt="alt" src="{{ asset('img/product/product-01.jpg') }}">
                    <div class="cart-btns">
                        <a href="{{ route('product.show',['product' => $purchased->slug]) }}" class="btn btn-info addcart-btn">Access</a>
                        @if($purchased->store_qt > 0)
                            @if($purchased->offer_qt == 0)
                            <a href="#" class="btn btn-warning proedit-btn add-product">released</a>
                                @else
                                <a href="#" class="btn btn-primary proedit-btn add-product" data-target="{{'#add-product-' . $purchased->id}}">Add</a>
                            @endif
                        @else
                            <a href="#" class="btn btn-danger proedit-btn add-product">Out of store</a>
                        @endif
                    </div>
                </div>
                <div class="pro-desc">
                    <h5><a href="#">{{ $purchased->name }}</a></h5>
                    <span class="text-dark">{{ ($purchased->description) ? substr($purchased->description,0,10) . '...' : ''  }}</span>
                    <div class="price"><sup>left in Store</sup>: {{ $purchased->store_qt }}</div>
                    <div class="price"><sup>left in Offer</sup>: {{  $purchased->offer_qt}}</div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        {{ Form::open(['method'=>'POST','url'=> route('sale_bc.store',compact('sale')),'id'=>'add-product-' . $purchased->id,'class'=>'form-horizontal','style'=>'display: none;']) }}
                        <div class="form-group">
                            <div class="col-xs-12 m-b-30">
                                {{ Form::number('purchased_id',$purchased->purchased_id,['style'=>'display: none;','required']) }}
                                <div class="col-xs-6">
                                {{ Form::number('qt',null,['class'=>'form-control','placeholder' => 'Qt','min'=>1, 'max'=> $purchased->offer_qt,'required']) }}
                                </div>
                                <div class="col-xs-6">
                                {{ Form::number('pu',null,['class'=>'form-control','placeholder' => 'Pu', 'step'=>"0.01",'min'=>1,'required']) }}

                                </div>
                            </div>
                            <div class="col-xs-12 text-right">
                                {{ Form::submit('confirm',['class'=>'btn btn-primary']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>

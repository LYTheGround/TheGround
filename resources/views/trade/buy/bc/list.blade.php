<div class="row">
    @foreach($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="product">
            <div class="product-inner">
                <img alt="alt" src="{{ asset('img/product/product-01.jpg') }}">
                <div class="cart-btns">
                    <a href="{{ route('product.show',compact('product')) }}" class="btn btn-info addcart-btn">Access</a>
                    <a href="#" class="btn btn-primary proedit-btn add-product" data-target="{{'#add-product-' . $product->id}}">Add</a>
                </div>
            </div>
            <div class="pro-desc">
                <h5><a href="{{ route('product.show',compact('product')) }}">{{ $product->name }}</a></h5>
                <div class="price"><sup>{{ __('validation.attributes.qt_min') }} </sup>{{ $product->qt_min }}</div>
                <div class="price"><sup>{{ __('validation.attributes.qt') }} </sup>{{ $product->qt }}</div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    {{ Form::open(['method'=>'POST','url'=>route('bc.store',compact('buy')),'id'=>'add-product-' . $product->id,'class'=>'form-horizontal','style'=>'display: none;']) }}
                    <div class="form-group">
                        <div class="col-xs-7">
                            {{ Form::number('product',$product->id,['style'=>'display: none;','required']) }}
                            {{ Form::number('qt',null,['class'=>'form-control','placeholder' => __('validation.attributes.qt'),'minlenght'=>1,'required']) }}
                        </div>
                        <div class="col-xs-5 text-right">
                            {{ Form::submit(ucfirst(__('validation.attributes.confirm')),['class'=>'btn btn-primary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@endforeach
</div>

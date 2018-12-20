<div class="row">
    @foreach($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="product">
            <div class="product-inner">
                @if(isset($product->imgs[0]))
                <img alt="alt" src="{{ asset('storage/' . $product->imgs[0]->img) }}">
                @else
                    <img alt="alt" src="{{ asset('img/placeholder.jpg') }}">
                    @endif
                <div class="cart-btns">
                    <a href="{{ route('product.show',compact('product')) }}" class="btn btn-info addcart-btn">Access</a>
                    <a href="#" class="btn btn-primary proedit-btn add-product" data-target="{{'#add-product-' . $product->id}}">Add</a>
                </div>
            </div>
            <div class="pro-desc">
                <h5><a href="{{ route('product.show',compact('product')) }}">{{ $product->name }}</a></h5>
                <div class="price"><sup>{{ __('validation.attributes.qt_min') }} </sup>{{ $product->qt_min . ' u' }}</div>
                <div class="price"><sup>{{ __('validation.attributes.qt') }} </sup>{{ $product->qt . ' u' }}</div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    {{ Form::open(['method'=>'POST','url'=>route('bc.store',compact('buy')),'id'=>'add-product-' . $product->id,'class'=>'form-horizontal','style'=>'display: none;']) }}
                    <div class="form-group">
                        <div class="col-xs-12">
                            {{ Form::number('product',$product->id,['style'=>'display: none;','required']) }}
                            {{ Form::number('qt',null,['class'=>'form-control','placeholder' => ucfirst(__('validation.attributes.qt')),'minlenght'=>1,'required']) }}
                        </div>
                        <div class="col-xs-12 text-right m-t-5">
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

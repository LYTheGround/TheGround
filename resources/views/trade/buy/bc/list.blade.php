<div class="row">
    @foreach($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="product">
            <div class="product-inner">
                <img alt="alt" src="{{ asset('img/product/product-01.jpg') }}">
                <div class="cart-btns">
                    <a href="#" class="btn btn-info addcart-btn">Access</a>
                    <a href="#" class="btn btn-primary proedit-btn add-product" data-target="{{'#add-product-' . $product->id}}">Add</a>
                </div>
            </div>
            <div class="pro-desc">
                <h5><a href="#">Apple Macbook Air MQD42HN/A 13-inch Laptop</a></h5>
                <div class="price"><sup>$</sup>1918</div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    {{ Form::open(['method'=>'POST','url'=>route('bc.store',compact('buy')),'id'=>'add-product-' . $product->id,'class'=>'form-horizontal','style'=>'display: none;']) }}
                    <div class="form-group">
                        <div class="col-xs-7">
                            {{ Form::number('product',$product->id,['style'=>'display: none;','required']) }}
                            {{ Form::number('qt',null,['class'=>'form-control','placeholder' => 'Qt','minlenght'=>1,'required']) }}
                        </div>
                        <div class="col-xs-5">
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

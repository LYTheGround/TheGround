@if(isset($product))
    {{ Form::model($product,['method' => 'PUT', 'url' => route('product.update',compact('product')), 'enctype'=>"multipart/form-data"]) }}
@else
    {{ Form::open(['method' => 'POST', 'url' => route('product.store'), 'enctype'=>"multipart/form-data"]) }}
@endif

<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('name',ucfirst(__('validation.attributes.name')),['class' => 'control-label']) }}
            {{ Form::text('name',null,['class' => 'form-control', 'placeholder' => ucfirst(__('validation.attributes.name')), 'required']) }}
            @if ($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('size',ucfirst(__('validation.attributes.size')),['class'=> 'control-label']) }}
            {{ Form::text('size',null,['class' => 'form-control', 'placeholder' => ucfirst(__('validation.attributes.size'))]) }}
            @if ($errors->has('size'))
                <div class="text-danger">{{ $errors->first('size') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('tva', ucfirst(__('validation.attributes.tva')),['class' => 'control-label']) }}
            <select name="tva" id="tva" title="tva" class="form-control" required>
                <option  disabled selected value>{{ ucfirst(__('validation.attributes.tva')) }}</option>
                <option value="0" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '0')) ? 'selected' : '' : (old('tva') == '0') ? 'selected' : '' }}>0%</option>
                <option value="7" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '7')) ? 'selected' : '' : (old('tva') == '7') ? 'selected' : '' }}>7%</option>
                <option value="10" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '10')) ? 'selected' : '' : (old('tva') == '10') ? 'selected' : '' }}>10%</option>
                <option value="14" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '14')) ? 'selected' : '' : (old('tva') == '14') ? 'selected' : '' }}>14%</option>
                <option value="20" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '20')) ? 'selected' : '' : (old('tva') == '20') ? 'selected' : '' }}>20%</option>
            </select>
            @if ($errors->has('tva'))
                <div class="text-danger">{{ $errors->first('tva') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('qt_min',ucfirst(__('validation.attributes.qt_min')),['class'=> 'control-label']) }}
            {{ Form::number('qt_min',null,['class' => 'form-control', 'placeholder' => ucfirst(__('validation.attributes.qt_min'))]) }}
            @if ($errors->has('qt_min'))
                <div class="text-danger">{{ $errors->first('qt_min') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 text-center">
        <div class="form-group">
            <label>{{ucfirst(__('validation.attributes.image'))}}</label>
            <div id="filesinput" >
                <!-- Our File Inputs -->
                <div class="wrap-custom-file">
                    @if(isset($product->imgs[0]))
                        <label  for="{{ 'edit-img-0-' . $product->id }}" class="covimgs" style="background-image: url({{ asset('storage/' . $product->imgs[0]->img) }})">
                            <a href="#" onClick='if(confirm("Do you remove it ??")){event.preventDefault();
                                window.location.href ="{{route('product.destroyImg',['img'=>$product->imgs[0]->id])}}"}
                                else event.preventDefault()'>
                                <i class="fa fa-close"></i>
                            </a>
                        </label>
                    @else
                        <input type="file" name="img[]" id="{{ (isset($product)) ? 'edit-img-0-'. $product->id : 'create-img-0' }}" accept=".gif, .jpg, .png" />
                        <label  for="{{ (isset($product)) ? 'edit-img-0-'. $product->id  : 'create-img-0' }}" class="covimgs" style="background-image: url({{ asset('img/placeholder.jpg') }})">
                            <span><span>{{ __('pages.product.form.selectImg') . ' 1' }}</span></span>
                            <i class="fa fa-plus-circle"></i>
                        </label>
                    @endif
                </div>
                <div class="wrap-custom-file">
                    @if(isset($product->imgs[1]))
                        <label  for="{{ 'edit-img-1-' . $product->id }}" class="covimgs" style="background-image: url({{ asset('storage/' . $product->imgs[1]->img) }})">
                            <a href="#" onClick='if(confirm("Do you remove it ??")){event.preventDefault();
                                window.location.href ="{{route('product.destroyImg',['img'=>$product->imgs[1]->id])}}"}
                                else event.preventDefault()'>
                                <i class="fa fa-close"></i>
                            </a>
                        </label>
                    @else
                        <input type="file" name="img[]" id="{{ (isset($product)) ? 'edit-img-1-'. $product->id : 'create-img-1' }}" accept=".gif, .jpg, .png" />
                        <label  for="{{ (isset($product)) ? 'edit-img-1-'. $product->id  : 'create-img-1' }}" class="covimgs" style="background-image: url({{ asset('img/placeholder.jpg') }})">
                            <span><span>{{ __('pages.product.form.selectImg') . ' 2' }}</span></span>
                            <i class="fa fa-plus-circle"></i>
                        </label>
                    @endif
                </div>
                <div class="wrap-custom-file">
                    @if(isset($product->imgs[2]))
                        <label  for="{{ 'edit-img-2-' . $product->id }}" class="covimgs" style="background-image: url({{ asset('storage/' . $product->imgs[2]->img) }})">
                            <a href="#" onClick='if(confirm("Do you remove it ??")){event.preventDefault();
                                window.location.href ="{{route('product.destroyImg',['img'=>$product->imgs[2]->id])}}"}
                                else event.preventDefault()' >
                                <i class="fa fa-close"></i>
                            </a>
                        </label>
                    @else
                        <input type="file" name="img[]" id="{{ (isset($product)) ? 'edit-img-2-'. $product->id : 'create-img-2' }}" accept=".gif, .jpg, .png" />
                        <label  for="{{ (isset($product)) ? 'edit-img-2-'. $product->id  : 'create-img-2' }}" class="covimgs" style="background-image: url({{ asset('img/placeholder.jpg') }})">
                            <span><span>{{ __('pages.product.form.selectImg') . ' 3' }}</span></span>
                            <i class="fa fa-plus-circle"></i>
                        </label>
                    @endif
                </div>
                <div class="wrap-custom-file">
                    @if(isset($product->imgs[3]))
                        <label  for="{{ 'edit-img-3-' . $product->id }}" class="covimgs" style="background-image: url({{ asset('storage/' . $product->imgs[3]->img) }})">
                            <a href="#" onClick='if(confirm("Do you remove it ??")){event.preventDefault();
                                window.location.href ="{{route('product.destroyImg',['img'=>$product->imgs[3]->id])}}"}
                                else event.preventDefault()'>
                                <i class="fa fa-close"></i>
                            </a>
                        </label>
                    @else
                        <input type="file" name="img[]" id="{{ (isset($product)) ? 'edit-img-3-'. $product->id : 'create-img-3' }}" accept=".gif, .jpg, .png" />
                        <label  for="{{ (isset($product)) ? 'edit-img-3-'. $product->id  : 'create-img-3' }}" class="covimgs" style="background-image: url({{ asset('img/placeholder.jpg') }})">
                            <span>{{ __('pages.product.form.selectImg') . ' 4' }}</span>
                            <i class="fa fa-plus-circle"></i>
                        </label>
                    @endif
                </div>
            </div>
            <small class="help-block">{{__('pages.product.form.selectMsg')}}</small>
            @if ($errors->has('img'))
                <div class="text-danger">{{ $errors->first('img') }}</div>
            @endif
        </div>
    </div>

</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            {{ Form::label('description',ucfirst(__('validation.attributes.description')),['class' => 'control-label']) }}
            {{ Form::textarea('description',null,['class' => 'form-control', 'placeholder' => ucfirst(__('validation.attributes.description'))]) }}
            @if ($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="m-t-20 text-right">
    <button class="btn btn-primary btn-lg">{{ $submit }}</button>
</div>

{{ Form::close() }}

@extends("layouts.app")
@section('page-title')
    {{ $product->name }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ $product->name }}</h4>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('product.edit', compact('product')) }}" class="btn btn-primary m-b-5">
                    <i class="fa fa-edit"></i>{{__('validation.attributes.edit')}}
                </a>
                <a href="#" data-toggle="modal" data-target="#delete_product{{ $product->id }}" class="btn btn-danger m-b-5">
                    <i class="fa fa-trash"></i> {{__('validation.attributes.delete')}}
                </a>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="">
                        <div class="proimage-wrap">
                            <div class="pro-image" id="pro_popup">
                                <a href="#" title="{{ $product->name }}">
                                    <img class="img-responsive"
                                         src="{{(isset($product->imgs[0])) ? asset('storage/'.$product->imgs[0]->img) : asset('img/user.jpg') }}"
                                         alt="{{ $product->name }}" title="{{ $product->name }}">
                                </a>
                            </div>
                            <ul class="proimage-thumb">
                                @foreach($product->imgs as $img)
                                    <li>
                                        <a href="{{asset('storage/'.$img->img)}}"><img
                                                src="{{asset('storage/'.$img->img)}}" alt="{{ $product->name }}" title="{{ $product->name }}"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="product-info">
                        <h2>{{$product->name}}</h2>
                        <p>@if((int) $product->qt > (int) $product->qt_min)
                                <span class="label label-success-border">In Stock</span>
                            @elseif((int) $product->qt == (int) $product->qt_min)
                                <span class="label label-warning-border text-primary">Just min Stock</span>
                            @elseif((int)$product->qt < (int) $product->qt_min and (int) $product->qt > 0)
                                <span class="label label-warning-border">Low of Stock</span>
                            @else
                                <span class="label label-danger-border">Out of Stock</span>
                            @endif
                        </p>
                        <p><b>{{__('validation.attributes.ref')}}</b> : {{ $product->ref }}</p>
                        <p><b>{{__('validation.attributes.size')}} : </b> {{ ($product->size) ?: 'inconnu' }}</p>
                        <p><b>{{__('validation.attributes.qt')}} : </b> {{ $product->qt . ' u' }}</p>
                        <p><b>{{__('validation.attributes.qt_min')}} : </b> {{ $product->qt_min . ' u' }}</p>
                        <p><b>{{__('validation.attributes.tva')}} : </b> {{$product->tva === 0 ? 'exonérer' : $product->tva.'%'  }}</p>
                        <p><b>{{__('validation.attributes.amount')}} : </b> {{ ($product->amount) ?: '0' }}</p>
                    </div>
                </div>
                <div class="col-xs-12">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#product_desc" data-toggle="tab">Description</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="product_desc">
                            <div class="product-content">
                                <p class="text-justify">
                                    {{ ($product->description) ?: 'description inconnu' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('store.product._destroy',compact('product'))
@stop

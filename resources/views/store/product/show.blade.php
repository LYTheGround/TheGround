@extends("layouts.app")
@section('page-title')
    {{ ucfirst($product->name) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-5 col-xs-offset-7 text-right">
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
                                         src="{{(isset($product->imgs[0])) ? asset('storage/'.$product->imgs[0]->img) : asset('img/placeholder.jpg') }}"
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
                        <p>
                            @if((int) $product->qt > (int) $product->qt_min)
                                <span class="label label-success-border">{{ strtoupper(__('validation.attributes.in_stock')) }}</span>
                            @elseif((int) $product->qt == (int) $product->qt_min)
                                <span class="label label-warning-border text-primary">{{ strtoupper(__('validation.attributes.just_stock')) }}</span>
                            @elseif((int)$product->qt < (int) $product->qt_min and (int) $product->qt > 0)
                                <span class="label label-warning-border">{{ strtoupper(__('validation.attributes.low_stock')) }}</span>
                            @else
                                <span class="label label-danger-border">{{ strtoupper(__('validation.attributes.out_stock')) }}</span>
                            @endif
                        </p>
                        <p><b>{{__('validation.attributes.ref')}}</b> : {{ $product->ref }}</p>
                        <p><b>{{__('validation.attributes.size')}} : </b> {{ ($product->size) ?: 'inconnu' }}</p>
                        <p><b>{{__('validation.attributes.qt')}} : </b> {{ $product->qt . ' u' }}</p>
                        <p><b>{{__('validation.attributes.qt_min')}} : </b> {{ $product->qt_min . ' u' }}</p>
                        <p><b>{{__('validation.attributes.tva')}} : </b> {{$product->tva === 0 ? 'exonérer' : $product->tva.'%'  }}</p>
                        <p><b>{{ucfirst(__('validation.attributes.amount'))}} : </b> {{ ($product->amount) ?: '0' }} ~M TTC</p>
                    </div>
                </div>
                <div class="col-xs-12">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#product_desc" data-toggle="tab">{{ ucfirst(__('validation.attributes.description')) }}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="product_desc">
                            <div class="product-content">
                                <p class="text-justify">
                                    {{ ($product->description) ?: __('validation.attributes.inconnu') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-table">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ strtoupper(__('pages.trade.buy.index.title')) }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th class="col-md-3">{{ __('validation.attributes.name') }}</th>
                                    <th class="col-md-3">{{ __('validation.attributes.progress') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($purchaseds as $purchased)
                                    <?php $tasks = json_decode($purchased->buy_order->dv->buy->trade_action->tasks); ?>
                                    <tr>
                                        <td>
                                            <h2><a href="#">{{ $purchased->buy_order->dv->buy->slug }}</a></h2>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs progress-striped">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                     data-toggle="tooltip" title="{{$tasks->progress}}%" style="width: {{$tasks->progress}}%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('buy.index') }}" class="text-primary">{{ __('validation.attributes.view_all') . ' ' . __('pages.trade.buy.index.title') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-table">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ strtoupper(__('pages.trade.sale.index.title')) }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th class="col-md-3">{{ __('validation.attributes.name') }}</th>
                                    <th class="col-md-3">{{ __('validation.attributes.progress') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solds as $sold)
                                    <?php $tasks = json_decode($sold->order->dv->sale->trade_action->tasks); ?>
                                    <tr>
                                        <td>
                                            <h2><a href="#">{{ $sold->order->dv->sale->slug }}</a></h2>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs progress-striped">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                     data-toggle="tooltip" title="{{$tasks->progress}}%" style="width: {{$tasks->progress}}%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('sale.index') }}" class="text-primary">{{ __('validation.attributes.view_all') . ' ' . __('pages.trade.sale.index.title') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('store.product._destroy',compact('product'))
@stop

@extends('layouts.app')
@section('page-title')
    {{ __('validation.attributes.unload') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            @if(isset($purchaseds[0]))
                <div class="col-xs-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="card-title text-right">
                                <h3>{{ strtoupper(__('pages.trade.buy.index.title')) }}</h3>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="display  table table-stripped">
                                        <thead>
                                        <tr>
                                            <th>{{ strtoupper(__('pages.deal.provider.index.title')) }}</th>
                                            <th>{{ strtoupper(__('pages.trade.buy.index.title')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.ht')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.tva')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.date')) }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($purchaseds as $purchased)
                                            <tr>
                                                <td>
                                                    <a href="#">{{ $purchased->buy_order->dv->provider->info_box->name }}</a>
                                                </td>
                                                <td><a href="#">{{ $purchased->buy_order->dv->buy->slug }}</a></td>
                                                <td><a href="#">{{ $purchased->buy_order->dv->ht }}</a></td>
                                                <td><a href="#">{{ $purchased->buy_order->dv->tva }}</a></td>
                                                <td><a href="#">{{ $purchased->buy_order->dv->ttc }}</a></td>
                                                <td><a href="#">{{ \Carbon\Carbon::parse($purchased->updated_at)->format('d-m-y')  }}</a></td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($solds[0]))
                <div class="col-xs-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="card-title text-right">
                                <h3>{{ strtoupper(__('pages.trade.sale.index.title')) }}</h3>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="display datatable table table-stripped">
                                        <thead>
                                        <tr>

                                            <th>{{ strtoupper(__('pages.deal.client.index.title')) }}</th>
                                            <th>{{ strtoupper(__('pages.trade.sale.index.title')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.tva_payed')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.taxes')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.profit')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.date')) }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($solds as $sold)
                                            <tr>
                                                <td><a href="#">{{ $sold->order->dv->client->info_box->name }}</a>
                                                </td>
                                                <td><a href="#">{{ $sold->order->dv->sale->slug }}</a></td>
                                                <td><a href="#">{{ $sold->order->dv->sale->tva_payed  }}</a></td>
                                                <td><a href="#">{{ $sold->order->taxes }}</a></td>
                                                <td><a href="#">{{ $sold->order->dv->sale->profit_after_taxes }}</a>
                                                </td>
                                                <td><a href="#">{{ \Carbon\Carbon::parse($sold->updated_at)->format('d-m-y')  }}</a></td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($unloads[0]))
                <div class="col-xs-12">
                    <div class="card-box">
                        <div class="card-title text-right">
                            <h3>{{ strtoupper(__('validation.attributes.unload')) }}</h3>
                        </div>
                        <div class="row">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="display datatable table table-stripped">
                                        <thead>
                                        <tr>
                                            <th>{{ strtoupper(__('validation.attributes.prince')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.tva')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.taxes')) }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($unloads as $unload)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('unload.show',compact('unload')) }}">{{ $unload->prince }}</a>
                                                </td>
                                                <td><a href="#">{{ ($unload->tva) ? 'charge' : 'NONE' }}</a></td>
                                                <td><a href="#">{{($unload->taxes) ? 'charge' : 'NONE' }}</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

@extends('layouts.app')
@section('page-title')
    {title}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="display  table table-stripped">
                                        <thead>
                                        <tr>

                                            <th>provider</th>
                                            <th>buy</th>
                                            <th>ht</th>
                                            <th>tva</th>
                                            <th>ttc</th>
                                            <th>date</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(isset($purchaseds[0]))
                                            @foreach($purchaseds as $purchased)
                                                <tr>
                                                    <td><a href="#">{{ $purchased->buy_order->dv->provider->info_box->name }}</a></td>
                                                    <td><a href="#">{{ $purchased->buy_order->dv->buy->slug }}</a></td>
                                                    <td><a href="#">{{ $purchased->buy_order->dv->ht }}</a></td>
                                                    <td><a href="#">{{ $purchased->buy_order->dv->tva }}</a></td>
                                                    <td><a href="#">{{ $purchased->buy_order->dv->ttc }}</a></td>
                                                    <td><a href="#">{{ $purchased->updated_at }}</a></td>

                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="display  table table-stripped">
                                        <thead>
                                        <tr>

                                            <th>client</th>
                                            <th>sale</th>
                                            <th>tva_payed</th>
                                            <th>taxes</th>
                                            <th>profit</th>
                                            <th>date</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(isset($solds[0]))
                                            @foreach($solds as $sold)
                                                <tr>
                                                    <td><a href="#">{{ $sold->order->dv->client->info_box->name }}</a></td>
                                                    <td><a href="#">{{ $sold->order->dv->sale->slug }}</a></td>
                                                    <td><a href="#">{{ $sold->order->dv->sale->tva_payed  }}</a></td>
                                                    <td><a href="#">{{ $sold->order->taxes }}</a></td>
                                                    <td><a href="#">{{ $sold->order->dv->sale->profit_after_taxes }}</a></td>
                                                    <td><a href="#">{{ $purchased->updated_at }}</a></td>

                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="display  table table-stripped">
                                        <thead>
                                        <tr>
                                            <th>prince</th>
                                            <th>tva</th>
                                            <th>taxes</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(isset($unloads[0]))
                                            @foreach($unloads as $unload)
                                                <tr>
                                                    <td><a href="{{ route('unload.show',compact('unload')) }}">{{ $unload->prince }}</a></td>
                                                    <td><a href="#">{{ ($unload->tva) ? 'charge' : 'NONE' }}</a></td>
                                                    <td><a href="#">{{($unload->taxes) ? 'charge' : 'NONE' }}</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

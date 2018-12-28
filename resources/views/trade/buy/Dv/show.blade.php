@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('validation.attributes.dv')) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row m-b-30">
            <div class="col-xs-7">
                <h3>{{ ucfirst(__('validation.attributes.dv')) }}</h3>
            </div>
            @can('dv',$buy)
            <div class="col-xs-5 text-right">
                <a href="{{ route('buy.show',compact('buy')) }}" class="btn btn-success m-b-5"><i class="fa fa-backward"></i> {{ $buy->slug }}</a>
                <a href="{{ route('buy.dv.selected',['buy' => $buy, 'dv' => $dv]) }}" class="btn btn-primary m-b-5"><i
                        class="fa fa-hand-o-left m-r-5"></i> {{ __('validation.attributes.selected') }}</a>
               <a href="#" onclick="event.preventDefault();
                    document.getElementById('{{ 'delete-dv-' . $dv->id }}').submit();" class="btn btn-danger m-b-5"><i
                        class="fa fa-trash-o m-r-5"></i> {{ ucfirst(__('validation.attributes.delete')) }}</a>
                {{ Form::open(['method'=>'DELETE','url'=>route('dv.destroy',compact('buy','dv')),'id' => "delete-dv-$dv->id",'style'=>"display:none;"]) }}
                {{ Form::close() }}
            </div>
            @endcan
        </div>
        <!--
            -   un cadre de fournisseur:
                -   le nom du fournisseur en url a fin d'afficher le profil de ce dernier.
        -->
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
                <div class="profile-widget">
                    <div class="profile-img">
                        <a href="#" class="avatar">{{ substr($provider->info_box->name,0,1) }}</a>
                    </div>
                    <h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="#">{{ $provider->info_box->name }}</a></h4>
                    <h5 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="#">{{ __('validation.attributes.speaker') . ' : '. $provider->info_box->speaker }}</a></h5>
                    <h5 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="#">{{ __('validation.attributes.phone') . ' : '. $provider->info_box->tels[0]->tel }}</a></h5>
                    <a href="{{ route('provider.show',compact('provider')) }}" class="btn btn-primary btn-sm m-t-10">{{ ucfirst(__('validation.attributes.viewProfil')) }}</a>
                </div>
            </div>
        </div>
        <!--
            -   un tableau qui contenir:
                + en boucle
                    -   le nom du produit avec son images si possible en url pour la redirection vers son profil.
                    -   la Quantité.
                    -   le prix unitaire.
                    -   le prix HT pour toute la Quantité.
                    -   la TVA a payer.
                    -   le prix en TTC.
                + la dernière ligne les montants total de
                    -   HT.
                    -   TVA.
                    -   TTC.
        -->
        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>{{ __('validation.attributes.products') }}</th>
                            <th class="text-center">{{ strtoupper(__('validation.attributes.qt')) . '/U' }}</th>
                            <th class="text-center">{{ strtoupper(__('validation.attributes.pu')) }}</th>
                            <th class="text-center">{{ strtoupper(__('validation.attributes.ht')) }}</th>
                            <th class="text-center">{{ strtoupper(__('validation.attributes.tva')) }}</th>
                            <th class="text-right">{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <a href="#" class="avatar">{{ substr($order->bc->product->name,0,1) }}</a>
                                <a href="{{ route('product.show',['product' => $order->bc->product]) }}"><h2>{{ $order->bc->product->name }}</h2></a>
                            </td>
                            <td class="text-center">{{ $order->bc->qt }}</td>
                            <td class="text-center">{{ $order->pu }}<b data-target="tooltip" title="Maroc Dirham"> ~M</b></td>
                            <td class="text-center">{{ $order->ht }}<b data-target="tooltip" title="Maroc Dirham"> ~M</b></td>
                            <td class="text-center">{{ $order->tva }}<b data-target="tooltip" title="Maroc Dirham"> ~M</b></td>
                            <td class="text-right">{{ $order->ttc }}<b data-target="tooltip" title="Maroc Dirham"> ~M</b></td>
                        </tr>
                        @endforeach
                        <tr class="success">
                            <td colspan="3" class="text-center text-primary"><h3>{{ strtoupper(__('validation.attributes.total')) }}</h3></td>
                            <td class="text-center">{{ $dv->ht }}</td>
                            <td class="text-center">{{ $dv->tva }}</td>
                            <td class="text-right text-danger"><h3>{{ $dv->ttc }}<b data-target="tooltip" title="Maroc Dirham"> ~M</b></h3></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

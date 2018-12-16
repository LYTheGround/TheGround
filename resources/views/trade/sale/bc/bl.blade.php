@extends('layouts.app')
@section('page-title')
    {{ strtoupper(__('validation.attributes.bl')) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-5">
                <h4 class="page-title">{{ strtoupper(__('validation.attributes.bl')) }}</h4>
            </div>
            <div class="col-xs-7 text-right m-b-30">
                <div class="btn-group btn-group-sm">
                    <button onclick="printDiv('printMe')" class="btn btn-default"><i class="fa fa-print fa-lg"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="row" id="printMe">
            <div class="col-xs-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 m-b-20">
                                @if($sale->company->info_box->brand)
                                    <img src="{{ asset('storage/' . $sale->company->info_box->brand) }}" class="inv-logo" alt="{{ $sale->company->info_box->name }}" title="{{ $sale->company->info_box->name }}">
                                @endif
                                <h3>Bon de Livraison</h3>
                                <ul class="list-unstyled">
                                    <li><strong>{{ ucfirst($sale->company->info_box->name) }}</strong></li>
                                    <li>{{ ($sale->company->info_box->zip) ? $sale->company->info_box->zip . ', ' : '' }} {{ $sale->company->info_box->address }},</li>
                                    <li>{{ $sale->company->info_box->build . ', ' }}{{ ($sale->company->info_box->floor) ? 'étage : ' . $sale->company->info_box->floor . ', n° ' . $sale->company->info_box->apt_nbr . ',' :'' }}</li>
                                    <li>{{ $sale->company->info_box->city->city }}</li>
                                </ul>
                            </div>
                            <div class="col-xs-6 m-b-20">
                                <div class="col-xs-12">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">{{ '#BL-' . $sale->id }}</h3>
                                        <ul class="list-unstyled">
                                            <li>VENDU Le : <span>{{ Carbon\Carbon::parse($sale->trade_action->done_time)->format('d/m/Y') }}</span></li>
                                            <li>Rédigé Le : <span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-12 text-right">
                                    <div class="col-md-12 col-lg-12 m-b-20 text-right">
                                        <h5>Livré Au :</h5>
                                        <ul class="list-unstyled">
                                            <li>
                                                <h5><strong>{{ $sale->dv->client->info_box->name }}</strong></h5></li>
                                            <li>{{ ($sale->dv->client->info_box->zip) ? $sale->dv->client->info_box->zip . ', ' : '' }} {{ ($sale->dv->client->info_box->address) ?:'' }}</li>
                                            <li>{{ ($sale->dv->client->info_box->build) ? 'n° : ' . $sale->dv->client->info_box->build . ', ' : ''}}{{ ($sale->dv->client->info_box->floor) ? 'étage : ' . $sale->dv->client->info_box->floor . ', n° ' . $sale->dv->client->info_box->apt_nbr . ',' :'' }}</li>
                                            <li>{{ $sale->dv->client->info_box->city->city }}</li>
                                            <li>{{ $sale->dv->client->info_box->tels[0]->tel }}</li>
                                            <li>{{ $sale->dv->client->info_box->emails[0]->email }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produit</th>
                                    <th>DESCRIPTION</th>
                                    <th>PU</th>
                                    <th>QUANTITÉ</th>
                                    <th>TVA</th>
                                    <th>HT</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale->bcs as $key => $bc)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $bc->purchased->product->name }}</td>
                                    <td>{{ ($bc->purchased->product->description)? substr($bc->purchased->product->description,0,15) . '...' : '' }}</td>
                                    <td>{{ $bc->order->pu }}</td>
                                    <td>{{ $bc->qt }}</td>
                                    <td>{{ $bc->order->ht }}</td>
                                    <td>{{ $bc->order->tva }}</td>
                                    <td>{{ $bc->order->ttc }}</td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="row invoice-payment">
                                <div class="col-sm-7">
                                </div>
                                <div class="col-sm-5">
                                    <div class="m-b-20">
                                        <h6>TOTAL</h6>
                                        <div class="table-responsive no-border">
                                            <table class="table m-b-0">
                                                <tbody>
                                                <tr>
                                                    <th>TOTAL HT :</th>
                                                    <td class="text-right">{{ $sale->ht }}</td>
                                                </tr>
                                                <tr>
                                                    <th>TOTAL TVA:</th>
                                                    <td class="text-right">{{ $sale->tva }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total :</th>
                                                    <td class="text-right text-primary">
                                                        <h5>{{ $sale->ttc }}</h5></td>
                                                </tr>
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
        </div>
    </div>
        <script>
            function printDiv(divName){
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
@stop

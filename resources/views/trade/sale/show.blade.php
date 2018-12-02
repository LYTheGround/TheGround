@extends('layouts.app')
@section('page-title')
    Sale
@stop

@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h3>Sale Show</h3>
            </div>
            @if($sale->trade_action->status == 'int' || $sale->trade_action->status == 'dv')
                <div class="col-xs-5 text-right">
                    <a href="#" onclick='event.preventDefault();document.getElementById("delete-sale-{{$sale->id}}").submit()'
                       class="btn btn-danger">
                        <i class="fa fa-trash-o m-r-5"></i> Delete</a>
                    <form id="delete-sale-{{ $sale->id }}" method="post" action="{{route('sale.destroy', compact('sale')) }}">
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                    </form>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6 panel activity-panel">
                <div class="panel-heading">
                    <div class="col-xs-12">
                        <div class="col-xs-7">
                            <h4 class="text-center">Activities</h4>
                            <p class="m-b-5">Progress <span class="text-success pull-right">{{ $tasks->progress }}
                                    %</span></p>
                            <div class="progress progress-xs m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" data-toggle="tooltip"
                                     title="{{ $tasks->progress }}%" style="width: {{ $tasks->progress }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="activity-box">
                        <ul class="activity-list">
                            @if($sale->trade_action->bc)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->bc_member->name }}</a> a
                                            fait le bon de commande
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->dv)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->dv_member->name }}</a> a
                                            selectionner le devi
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->done)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->done_member->name }}</a> a
                                            marquer l'achat
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->delivery)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->done_member->name }}</a> a
                                            liverer
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->store)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->done_member->name }}</a> a
                                            indiquer que les produits est dans le magazin
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->bl)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->bl_member->name }}</a> a
                                            uploader le bon de livraison
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->fc)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $sale->trade_action->bl_member->name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $sale->trade_action->bl_member->name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->bl_member->name }}</a> a
                                            uploader la facture
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @if($tasks->next != null)
                    <div class="panel-footer text-right bg-white">
                        <a href="{{ $tasks->next->url }}" class="btn-success btn">{{ $tasks->next->name }}</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                <div class="card-title">
                    <div class="col-xs-7">
                        <h4>Bon de commande</h4>
                    </div>
                    <div class="col-xs-5 text-right">

                        @if(!$sale->trade_action->dv)
                            <a href="{{ route('sale_bc.create',compact('sale')) }}" class="btn btn-success">update</a>
                            @if($sale->dv)
                                <a href="{{ route('sale.bc.confirm',compact('sale')) }}"
                                   class="btn btn-primary">Confirm</a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qt</th>
                            <th>ht</th>
                            <th>tva</th>
                            <th class="text-center">ttc</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($sale->dv)
                            @foreach($sale->dv->orders as $order)
                                <tr>
                                    <td>{{ $order->bc->purchased->product->name }}</td>
                                    <td>{{ $order->bc->qt }}</td>
                                    <td>{{ $order->ht }}</td>
                                    <td>{{ $order->tva }}</td>
                                    <td class="text-center">{{ $order->ttc }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" class="bg-primary">TOTAL</td>
                                <td class="bg-warning">{{ $sale->ht }}</td>
                                <td class="bg-warning">{{ $sale->tva }}</td>
                                <td class="bg-danger text-center">{{ $sale->ttc }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

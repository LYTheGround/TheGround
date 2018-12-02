@extends('layouts.app')
@section('page-title')
    Sales
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="card-box">
                <div class="row">
                    <div class="col-xs-7">
                        <h4>Sales</h4>
                    </div>
                    <div class="col-xs-5 text-right">
                        <a href="{{ route('sale.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Create
                        </a>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#inProgress" data-toggle="tab">In Progress</a></li>
                    <li><a href="#finish" data-toggle="tab">Finish</a></li>
                    <li><a href="#archived" data-toggle="tab">Archived</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="inProgress">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table datatable">
                                        <thead>
                                        <tr>
                                            <th>slug</th>
                                            <th>progress</th>
                                            <th>ht</th>
                                            <th>tva</th>
                                            <th class="text-right">ttc</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sales as $sale)
                                            @if($sale->trade_action->status != 'finish' and $sale->trade_action->status != 'archived')
                                                <tr>
                                                    <td><a href="{{ route('sale.show',compact('sale')) }}">{{ $sale->slug }}</a></td>
                                                    <td>progress</td>
                                                    <td>{{ $sale->ht }}</td>
                                                    <td>{{ $sale->tva }}</td>
                                                    <td class="text-right">{{ $sale->ttc }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="finish">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table datatable">
                                        <thead>
                                        <tr>
                                            <th>slug</th>
                                            <th>progress</th>
                                            <th>ht</th>
                                            <th>tva</th>
                                            <th class="text-right">ttc</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sales as $sale)
                                            @if($sale->trade_action->status == 'finish')
                                                <tr>
                                                    <td><a href="{{ route('sale.show',compact('sale')) }}">{{ $sale->slug }}</a></td>
                                                    <td>progress</td>
                                                    <td>{{ $sale->ht }}</td>
                                                    <td>{{ $sale->tva }}</td>
                                                    <td class="text-right">{{ $sale->ttc }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="archived">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table datatable">
                                        <thead>
                                        <tr>
                                            <th>slug</th>
                                            <th>progress</th>
                                            <th>ht</th>
                                            <th>tva</th>
                                            <th class="text-right">ttc</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sales as $sale)
                                            @if($sale->trade_action->status == 'archived')
                                                <tr>
                                                    <td><a href="{{ route('sale.show',compact('sale')) }}">{{ $sale->slug }}</a></td>
                                                    <td>progress</td>
                                                    <td>{{ $sale->ht }}</td>
                                                    <td>{{ $sale->tva }}</td>
                                                    <td class="text-right">{{ $sale->ttc }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
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

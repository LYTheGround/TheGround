@extends('layouts.app')
@section('page-title')
    {{ __('validation.attributes.bc') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h2>{{ __('validation.attributes.bc') }}</h2>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('sale.show',compact('sale')) }}" title="{{ $sale->slug }}"
                   class="btn btn-success m-b-5"><i class="fa fa-backward"></i> {{ $sale->slug }}</a>
                @if(isset($sale->bcs[0]))
                    <a href="{{ route('sale.bc.confirm',compact('sale')) }}"
                       class="btn btn-primary m-b-5">{{ __('validation.attributes.confirm') }}</a>
                @endif
            </div>
        </div>
        <div class="row card-box">
            <div class="col-xs-12">
                {{ Form::open(['method'=>'POST','url' => route('sale_bc.products',compact('sale')),'class'=> 'form-horizontal','id' => 'form-bc']) }}
                <div class="form-group">
                    {{ Form::label('product',ucfirst(__('validation.attributes.products')) . ' : ',['class'=>'class-control']) }}
                    {{ Form::text('product',null,['class' => 'form-control', 'id' => 'bc-product', 'placeholder' => ucfirst(__('validation.attributes.products')) . ' : ']) }}
                </div>
                <div class="form-group text-right">
                    {{ Form::submit(__('validation.attributes.search'),['class' => 'btn btn-primary']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="card-box" id="target-list-product" style="display: none">
                <!-- list choix product -->
            </div>
        </div>
        <div class="row">

        </div>
        <div class="row">
            <table class="table table-striped custom-table">
                <thead>
                <tr>
                    <th>{{ ucfirst(__('validation.attributes.products')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.pu')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.qt')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.ht')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.tva')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.tva_payed')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.profit')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.taxes')) }}</th>
                    <th>{{ strtoupper(__('validation.attributes.profit_taxes')) }}</th>
                    <th>{{ __('validation.attributes.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @if($sale->dv)
                    @foreach($sale->dv->orders as $order)
                        <tr>
                            <td>{{ $order->bc->purchased->product->name }}</td>
                            <td>{{ $order->pu }}</td>
                            <td>{{ $order->bc->qt }}</td>
                            <td>{{ $order->ht }}</td>
                            <td>{{ $order->tva }}</td>
                            <td>{{ $order->ttc }}</td>
                            <td>{{ $order->tva_payed }}</td>
                            <td>{{ $order->profit }}</td>
                            <td>{{ $order->taxes }}</td>
                            <td>{{ $order->profit_after_taxes }}</td>
                            <td>
                                <a href="#"
                                   onclick="event.preventDefault();document.getElementById('{{"delete-bc-$order->id"}}').submit()"
                                   class="btn btn-danger">
                                    <i class="fa fa-trash-o m-r-5"></i> destroy
                                </a>
                                <form id="delete-bc-{{ $order->id }}" method="post"
                                      action="{{route('sale_bc.destroy', compact('sale','order')) }}">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

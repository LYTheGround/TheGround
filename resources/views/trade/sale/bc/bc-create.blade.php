@extends('layouts.app')
@section('page-title')
    Bon de commande
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <h1>Bon de commande</h1>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {{ Form::open(['method'=>'POST','url' => route('sale_bc.products',compact('sale')),'class'=> 'form-horizontal','id' => 'form-bc']) }}
                <div class="form-group">
                    {{ Form::label('product','Product : ',['class'=>'class-control']) }}
                    {{ Form::text('product',null,['class' => 'form-control', 'id' => 'bc-product', 'placeholder' => 'Product']) }}
                </div>
                <div class="form-group text-right">
                    {{ Form::submit('Search',['class' => 'btn btn-success']) }}
                </div>
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
                    <th>Product</th>
                    <th>pu</th>
                    <th>Qt</th>
                    <th>HT</th>
                    <th>TVA</th>
                    <th>TTC</th>
                    <th>TVA_payed</th>
                    <th>profit</th>
                    <th>taxes</th>
                    <th>profit_after_taxes</th>
                    <th>action</th>
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
                                   onclick='event.preventDefault();document.getElementById("delete-bc-{{$order->id}}").submit()'>
                                    <i class="fa fa-trash-o m-r-5"></i> destroy
                                </a>
                                <form id="delete-bc-{{ $order->id }}" method="post" action="{{route('sale_bc.destroy', compact('sale','order')) }}">
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

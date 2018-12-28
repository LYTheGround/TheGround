@extends('layouts.app')
@section('page-title')
    {{ __('pages.trade.bc') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h3>{{ __('pages.trade.bc') }}</h3>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('buy.show',compact('buy')) }}" class="btn btn-success m-b-5"><i class="fa fa-backward"></i> {{ $buy->slug }}</a>
                @if(isset($buy->bcs[0]))
                    <a href="{{ route('buy.bc.confirm',compact('buy')) }}"
                       class="btn btn-primary m-b-5">{{ __('validation.attributes.confirm') }}</a>
                @endif
            </div>
        </div>
        <div class="row card-box">
            <div class="col-xs-12">
                {{ Form::open(['method'=>'POST','url' => route('bc.products',compact('buy')),'class'=> 'form-horizontal','id' => 'form-bc']) }}
                <div class="col-xs-12">
                    <div class="form-group">
                        {{ Form::label('product',ucfirst(__('validation.attributes.products')) . ' : ',['class'=>'class-control']) }}
                        {{ Form::text('product',null,['class' => 'form-control', 'id' => 'bc-product', 'placeholder' => ucfirst(__('validation.attributes.products')), 'required']) }}
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group text-right">
                        {{ Form::submit(ucfirst(__('validation.attributes.search')),['class' => 'btn btn-primary']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="panel activity-panel" style="display: none">
                <div class="panel-body" id="target-list-product"></div>
            </div>
        </div>
        <div class="row card-box">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table ">
                        <thead>
                        <tr>
                            <th>{{ strtoupper(__('pages.product.index.title')) }}</th>
                            <th>{{ strtoupper(__('validation.attributes.qt')) }}</th>
                            <th class="text-right">{{ strtoupper(__('validation.attributes.action')) }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buy->bcs as $bc)
                            <tr>
                                <td>
                                    <a href="#" class="avatar">{{ strtoupper(substr($bc->product->name,0,1))  }}</a>
                                    <h2><a href="#">{{ $bc->product->name }}</a></h2>
                                </td>
                                <td>{{ $bc->qt}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                           aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="#" onclick="event.preventDefault();document.getElementById('{{ 'delete-bc-' .$bc->id }}').submit()"><i class="fa fa-trash"></i> {{ ucfirst(__('validation.attributes.delete')) }}</a>
                                                <form action="{{route('bc.destroy',compact('buy','bc'))}}" method="POST" id='{{ "delete-bc-$bc->id" }}' style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>

                                        </ul>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('pages.trade.sale.release.title'))  }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4>{{ ucfirst(__('pages.trade.sale.release.title')) }}</h4>
            </div>
            <div class="col-xs-5 text-right m-b-5">
                <a href="{{ route('sale.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>
        </div>
        <div class="row">
            @include('trade.sale._list_release',['bcs'])
        </div>
    </div>
@stop


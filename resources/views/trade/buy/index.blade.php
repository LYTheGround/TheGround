@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('pages.trade.buy.index.title')) }}
@stop
@section('content')
    <div class="content container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-xs-7">
                    <h4>{{ ucfirst(__('pages.trade.buy.index.title')) }}</h4>
                </div>
                <div class="col-xs-5 text-right m-b-5">
                    <a href="#" class="btn btn-primary"
                       onclick="event.preventDefault();getElementById('create-buy').submit();">
                        <i class="fa fa-plus"></i> {{ __('validation.attributes.create') }}
                    </a>
                    <form action="{{ route('buy.store') }}" id="create-buy" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @include('trade.buy._list',compact('buys'))
        </div>
    </div>
@stop

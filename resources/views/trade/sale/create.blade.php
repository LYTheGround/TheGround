@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('pages.trade.sale.create.title')) }}
@stop
@section('content')
    <div class="content .container-fluid">
        <div class="row">
            <h4>{{ ucfirst(__('pages.trade.sale.create.title')) }}</h4>
        </div>
        <div class="row card-box">
            {{ Form::open([ 'method' => 'POST', 'url' => route('sale.store') ]) }}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('client', __('pages.deal.client.index.title') . ' : ',['class' => 'control-label']) }}
                            <select name="client" title="client" id="client" class="form-control" required>
                                <option  disabled selected value>{{ ucfirst(__('pages.deal.client.index.title')) }}</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->info_box->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 ">
                        <div class="form-group text-right">
                            {{ Form::submit(__('validation.attributes.create'),['class' => 'btn btn-primary']) }}
                        </div>
                    </div>

                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

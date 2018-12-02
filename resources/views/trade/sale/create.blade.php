@extends('layouts.app')
@section('page-title')
    create Sale
@stop
@section('content')
    <div class="content .container-fluid">
        <div class="row">
            <h4>create Sale</h4>
        </div>
        <div class="row">
            {{ Form::open([ 'method' => 'POST', 'url' => route('sale.store') ]) }}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('client', 'Client') }}
                            <select name="client" id="client" class="form-control">
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->info_box->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group text-right">
                            <input type="submit">
                        </div>
                    </div>

                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

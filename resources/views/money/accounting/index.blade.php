@extends('layouts.app')
@section('page-title')
    Accounting
@stop
@section('content')
    <div class="content .container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>Accounting</h1>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('unload.create') }}" class="btn btn-primary">{{ __('validation.attributes.create') }}</a>
            </div>
        </div>
            <div class="row">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="table_desc" class="display datatable table table-stripped">
                                        <thead>
                                        <tr>
                                            <th>{{ strtoupper(__('validation.attributes.month')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.profit')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.tva')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.tva_unload')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.taxes')) }}</th>
                                            <th>{{ strtoupper(__('validation.attributes.taxes_unload')) }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($months as $month)
                                                <tr>
                                                    <td><a href="{{ route('accounting.show',compact('month')) }}">{{ \App\Month::date($month) }}</a></td>
                                                    <td>{{ $month->profit }}</td>
                                                    <td>{{ $month->tva }}</td>
                                                    <td>{{ $month->tva_after_unload }}</td>
                                                    <td>{{ $month->taxes }}</td>
                                                    <td>{{ $month->taxes_after_unload }}</td>
                                                </tr>
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
@stop

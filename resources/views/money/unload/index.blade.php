@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('validation.attributes.unload')) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>{{ ucfirst(__('validation.attributes.unload')) }}</h1>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('unload.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __('validation.attributes.create') }}</a>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-xs-12">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="display datatable table table-stripped">
                                <thead>
                                <tr>
                                    <th>{{ __('validation.attributes.month') }}</th>
                                    <th>{{ __('pages.rh.user.members') }}</th>
                                    <th>{{ __('validation.attributes.username') }}</th>
                                    <th>{{ __('validation.attributes.prince') }}</th>
                                    <th>{{ __('validation.attributes.chargeOn') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($unloads as $unload)
                                        @can('view',$unload)
                                        <tr>
                                            <td><a href="{{ route('unload.show',compact('unload')) }}">{{ \App\Month::date($unload->month) }}</a></td>
                                            <td>{{ $unload->member->name }}</td>
                                            <td>{{ $unload->name }}</td>
                                            <td>{{ $unload->prince }}</td>
                                            <td>{{ ($unload->taxes) ? 'TAXES' : 'TVA' }}</td>
                                        </tr>
                                        @endcan
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

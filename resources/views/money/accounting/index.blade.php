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
                <a href="{{ route('unload.create') }}" class="btn btn-success">Create</a>
            </div>
        </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <h2>{{ '2018' }}</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="display datatable table table-stripped">
                                        <thead>
                                        <tr>

                                            <th>Month</th>
                                            <th>profit</th>
                                            <th>tva</th>
                                            <th>tva unload</th>
                                            <th>taxes</th>
                                            <th>taxes unload</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(isset($months[0]))
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
                                        @else
                                            {{__('pages.client.no_result')}}
                                        @endif
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

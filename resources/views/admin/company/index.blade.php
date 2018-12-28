@extends('layouts.admin.admin')
@section('page-title')
    companies
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>companies</h1>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('company.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> {{ __('validation.attributes.create') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="display datatable table table-stripped table_desc">
                                <thead>
                                <tr>

                                    <th>name</th>
                                    <th class="text-center">tel</th>
                                    <th class="text-center">speaker</th>
                                    <th class="text-center">email</th>
                                    <th class="text-center">status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)

                                    <tr>
                                        <td>
                                            <a href="{{ route('company.show',compact('company')) }}">{{ $company->info_box->name }}</a>
                                        </td>
                                        <td>{{ $company->info_box->tels[0]->tel }}</td>
                                        <td>{{ $company->info_box->speaker }}</td>
                                        <td>{{ $company->info_box->emails[0]->email }}</td>
                                        <td class="text-center">
                                            @if($company->premium->status->status == 'active')
                                                <span
                                                    class="label label-success-border">{{$company->premium->status->status}}</span>
                                            @elseif($company->premium->status->status == 'inactive')
                                                <span
                                                    class="label label-warning-border">{{$company->premium->status->status}}</span>
                                            @else
                                                <span
                                                    class="label label-danger-border">{{$company->premium->status->status}}</span>
                                            @endif
                                        </td>
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
@stop

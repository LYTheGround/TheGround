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
                <a href="{{ route('company.create') }}" class="btn btn-success">Create</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="display datatable table table-stripped">
                                <thead>
                                <tr>

                                    <th>name</th>
                                    <th>tel</th>
                                    <th>speaker</th>
                                    <th>email</th>
                                    <th>status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)

                                    <tr>
                                        <td><a href="{{ route('company.show',compact('company')) }}">{{ $company->info_box->name }}</a></td>
                                        <td>{{ $company->info_box->tels[0]->tel }}</td>
                                        <td>{{ $company->info_box->speaker }}</td>
                                        <td>{{ $company->info_box->emails[0]->email }}</td>
                                        <td>{{ $company->premium->status->status }}</td>
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

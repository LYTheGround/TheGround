@extends('layouts.admin.admin')
@section('page-title')
    admins
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>Admins</h1>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('admin.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __('validation.attributes.create') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="display table_desc datatable table table-stripped">
                            <thead>
                            <tr>
                                <th>login</th>
                                <th>email</th>
                                <th>ville</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td><a href="{{ route('admin.show',compact('admin')) }}">{{ $admin->user->login }}</a></td>
                                        <td>{{ $admin->user->email }}</td>
                                        <td>{{ $admin->city->city }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

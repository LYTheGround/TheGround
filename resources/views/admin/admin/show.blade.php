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
                <a href="{{ route('admin.edit',compact('admin')) }}" class="btn btn-success">Edit</a>
                <a href="#"  data-toggle="modal" data-target="#delete_admin" class="btn btn-danger" >destroy</a>
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
        <div id="delete_admin" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">Admin : {{ $admin->user->login }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>Are you sure want to delete this?</p>
                        <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <span onclick="event.preventDefault();document.getElementById('{{ 'delete-admin-' . $admin->id }}').submit()" class="btn btn-danger">Delete</span>
                            <form action="{{route('admin.destroy',compact('admin'))}}" method="POST" id="{{ 'delete-admin-' . $admin->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

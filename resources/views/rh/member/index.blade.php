@extends('layouts.app')
@section('page-title')
    Members
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-3">
                <h4 class="page-title">Members</h4>
            </div>
        </div>
        <div class="row filter-row">
            <div class="col-sm-3 col-xs-6">
                <div class="form-group form-focus">
                    <label class="control-label">Client ID</label>
                    <input type="text" class="form-control floating">
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="form-group form-focus">
                    <label class="control-label">Client Name</label>
                    <input type="text" class="form-control floating">
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="form-group form-focus select-focus">
                    <label class="control-label">Company</label>
                    <select class="select floating">
                        <option>Select Company</option>
                        <option>Global Technologies</option>
                        <option>Delta Infotech</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <a href="#" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>
                                    <a href="{{ route('member.show',compact('member')) }}" class="avatar">{{ strtoupper(substr($member->name,0,1))  }}</a>
                                    <h2><a href="{{ route('member.show',compact('member')) }}">{{ $member->info->last_name . ' ' . $member->info->first_name }}</a></h2>
                                </td>
                                <td>{{ $member->info->emails[0]->email }}</td>
                                <td>{{ $member->info->tels[0]->tel }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                           aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" data-toggle="modal" data-target="#edit_client"><i
                                                        class="fa fa-pencil m-r-5"></i> Range</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#delete_client"><i
                                                        class="fa fa-trash-o m-r-5"></i> Status</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('layouts.app')
@section('page-title')
Tokens
@stop
@section('content')
<div class="content container-fluid">
    <div class="card-box">
        <div class="card-title">
            <div class="col-xs-7">
                <h4 class="page-title">My Profile</h4>
            </div>
            <div class="col-xs-5 text-right m-b-30">
                @can('token', auth()->user()->member)
                    <a href="{{ route('token.create') }}" class="btn btn-success rounded"><i class="fa fa-plus"></i> Create</a>
                @endcan
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                        <tr>
                            <th>Tokens</th>
                            <th>Category</th>
                            <th>Range</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tokens as $token)
                            <tr>
                                <td>{{ $token->token }}</td>
                                <td>{{ $token->category->category }}</td>
                                <td>{{ $token->range }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                           aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('delete-token{{$token->id}}').submit();"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                        </ul>
                                    </div>

                                    <form id="delete-token{{$token->id}}" action="{{ route('token.destroy',compact('token')) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
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
@stop

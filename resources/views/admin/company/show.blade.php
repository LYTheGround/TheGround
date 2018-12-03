@extends('layouts.app')
@section('page-title')
    {{ $company->info_box->name }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
            {{ 'Profil: ' . $company->info_box->name }}
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('company.edit',compact('company')) }}" class="btn btn-success">Update</a>
                <a href="#" class="btn btn-primary">Sold</a>
                <a href="#" class="btn btn-danger">Status</a>
            </div>
        </div>
    </div>
@stop

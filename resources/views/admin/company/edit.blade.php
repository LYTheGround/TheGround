@extends('layouts.admin.admin')
@section('page-title')
    Create
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>{{ $company->info_box->name }}</h1>
            </div>
        </div>
        <div class="card-box">
            {{ Form::model($company->info_box,['method' => 'PUT', 'url' => route('company.update',compact('company')),'enctype' => 'multipart/form-data' ]) }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name','Name : ',['class' => 'control-label']) }}
                        {{ Form::text('name',null,['class' => 'form-control','placeholder' => 'Name :','required']) }}
                        @if($errors->has('name'))
                            <span class="text-danger">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('email','E-mail : ',['class' => 'control-label']) }}
                        {{ Form::email('email',$company->info_box->emails[0]->email,['class' => 'form-control','placeholder' => 'E-mail :','required']) }}
                        @if($errors->has('email'))
                            <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('tel','Tel :',['class' => 'control-label']) }}
                        {{ Form::tel('tel',$company->info_box->tels[0]->tel,['class'=>'form-control','placeholder' => 'Fixe','required']) }}
                        @if($errors->has('tel'))
                            <span class="text-danger">
                                {{ $errors->first('tel') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('fax','Fax :',['class' => 'control-label']) }}
                        {{ Form::tel('fax',null,['class'=>'form-control','placeholder' => 'Fax']) }}
                        @if($errors->has('tel'))
                            <span class="text-danger">
                                {{ $errors->first('tel') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('speaker','Speaker :',['class' => 'control-label']) }}
                        {{ Form::text('speaker',null,['class'=>'form-control','placeholder' => 'Speaker','required']) }}
                        @if($errors->has('speaker'))
                            <span class="text-danger">
                                {{ $errors->first('speaker') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('licence','Licence :',['class' => 'control-label']) }}
                        {{ Form::text('licence',null,['class' => 'form-control','placeholder'=>'Licence']) }}
                        @if($errors->has('licence'))
                            <span class="text-danger">
                                {{ $errors->first('licence') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('turnover','Turnover :',['class' => 'control-label']) }}
                        {{ Form::number('turnover',null,['class' => 'form-control','step'=> '100','placeholder'=>'Turnover','required']) }}
                        @if($errors->has('turnover'))
                            <span class="text-danger">
                                {{ $errors->first('turnover') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('taxes','Taxes :',['class' => 'control-label']) }}
                        {{ Form::number('taxes',null,['class' => 'form-control','placeholder'=>'Taxes','required']) }}
                        @if($errors->has('taxes'))
                            <span class="text-danger">
                                {{ $errors->first('taxes') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('address','Address :',['class' => 'control-label']) }}
                        {{ Form::text('address',null,['class' => 'form-control','placeholder'=>'Address','required']) }}
                        @if($errors->has('address'))
                            <span class="text-danger">
                                {{ $errors->first('address') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('build','Build :',['class' => 'control-label']) }}
                        {{ Form::number('build',null,['class' => 'form-control','placeholder'=>'Build','required']) }}
                        @if($errors->has('build'))
                            <span class="text-danger">
                                {{ $errors->first('build') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('floor','Floor :',['class' => 'control-label']) }}
                        {{ Form::text('floor',null,['class' => 'form-control','placeholder'=>'Floor']) }}
                        @if($errors->has('floor'))
                            <span class="text-danger">
                                {{ $errors->first('floor') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('apt_nbr','n° :',['class' => 'control-label']) }}
                        {{ Form::text('apt_nbr',null,['class' => 'form-control','placeholder'=>'N°']) }}
                        @if($errors->has('apt_nbr'))
                            <span class="text-danger">
                                {{ $errors->first('apt_nbr') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('zip','Code postal :',['class' => 'control-label']) }}
                        {{ Form::number('zip',null,['class' => 'form-control','placeholder'=>'Code Postal','required']) }}
                        @if($errors->has('zip'))
                            <span class="text-danger">
                                {{ $errors->first('zip') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('city_id','Ville :',['class' => 'control-label']) }}
                        <select name="city" id="city" title="city" class="form-control">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ (old('city_id') == $city->id) ? 'selected' : '' }}>{{ $city->city }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('city'))
                            <span class="text-danger">
                                {{ $errors->first('city') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>pièce justificatif</label>
                        <div id="filesinput" >
                            <!-- Our File Inputs -->
                            <div class="wrap-custom-file">
                                <input type="file" name="brand" id="image1" accept=".gif, .jpg, .png" />
                                <label  for="image1" class="covimgs" {{'style=background-image:'."url(".asset("img/placeholder.jpg").")"}} >
                                    <span>Select justify image</span>
                                    <i class="fa fa-plus-circle"></i>
                                </label>
                            </div>
                            <!-- End Page Wrap -->
                        </div>
                        <small class="help-block">Allowed images: jpg, gif, jpeg, png. Maximum 1 image only.</small>
                        @if ($errors->has('brand'))
                            <div class="help-block">{{ $errors->first('brand') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <input type="submit" value="create" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

@extends('layouts.app')
@section('page-title'){{ $member->slug }}@stop
@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="card-box">
                <div class="card-title">
                    <h4>Params :</h4>
                </div>
                {{ Form::model($member,['method' => 'PUT', 'url' => route('member.params.update'),'class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-3">
                                {{ Form::label('face','Face:', ['class' => 'col-lg-3 control-label']) }}

                            </div>
                            <div class="col-md-9">
                                {{ Form::file('face',null,['class' => 'form-control','type/file'=>'image']) }}
                                @if($errors->has('face'))
                                    <span class="text-warning">{{ $errors->first('face') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label('name','Name:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('name',null,['class' => 'form-control', 'placeholder'=> 'First name','required','minlenght' => '3','maxlenght'=> '15']) }}
                                    @if($errors->has('name'))
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <span class="text-warning">{{ $errors->first('name') }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label('name','Email:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::email('email',$member->info->emails[0]->email,['class' => 'form-control', 'placeholder'=> 'Last name','required','minlenght' => '3','maxlenght'=> '15']) }}
                                    @if($errors->has('email'))
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <span class="text-warning">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    {{ Form::label('tel','phone:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            +212
                                        </span>
                                        {{ Form::tel('tel',$member->info->tels[0]->tel,['class' => 'form-control', 'placeholder' => '06', 'minlenght' => '10', 'maxlenght' => '10']) }}
                                    </div>
                                    @if($errors->has('tel'))
                                        <span class="text-warning">{{ $errors->first('tel') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label('first_name','first_name:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('first_name',$member->info->first_name,['class' => 'form-control', 'placeholder'=> 'First name','required','minlenght' => '3','maxlenght'=> '15']) }}
                                    @if($errors->has('first_name'))
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <span class="text-warning">{{ $errors->first('first_name') }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label('last_name','last name:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('last_name',$member->info->last_name,['class' => 'form-control', 'placeholder'=> 'Last name','required','minlenght' => '3','maxlenght'=> '15']) }}
                                    @if($errors->has('last_name'))
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <span class="text-warning">{{ $errors->first('last_name') }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label('sex','Sex:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    <select name="sex" id="sex" class="form-control">
                                        <option value="homme">homme</option>
                                        <option value="femme">femme</option>
                                    </select>
                                    @if($errors->has('sex'))
                                        <span class="text-warning">{{ $errors->first('sex') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label('birth','birth:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::date('birth',date($member->info->birth),['class' => 'form-control','placeholder' => 'birth', 'required']) }}
                                    @if($errors->has('birth'))
                                        <span class="text-warning">{{ $errors->first('birth') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label('address','address:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('address', $member->info->address, ['class' => 'form-control', 'placeholder' => 'Address', 'minlenght' => '10','maxlenght' => '80']) }}
                                    @if($errors->has('address'))
                                        <span class="text-warning">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label('city','City:',['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    <select name="city" id="city" class="form-control" required>
                                        <option
                                            value="{{ $member->info->city->id }}">{{ $member->info->city->city }}</option>
                                        @foreach(\App\City::all() as $city)
                                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('city'))
                                        <span class="text-warning">{{ $errors->first('city') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                {{ Form::label('identity_select','Connect With:',['class' => 'col-lg-3 control-label']) }}

                            </div>
                            <div class="col-md-9">
                                <select name="identity" id="identity_select" title="identity_select"
                                        class="form-control" required>
                                    <option value="name">name</option>
                                    <option value="email">email</option>
                                    <option value="tel">Tel</option>
                                </select>
                                @if($errors->has('identity'))
                                    <span class="text-warning">{{ $errors->first('identity') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        S'enregistré
                    </button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

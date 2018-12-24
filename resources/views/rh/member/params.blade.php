@extends('layouts.app')

@section('title_page')
    {{ __('pages.rh.user.params') }}
@stop
@section('content')
    <div class="container-fluid content">
        <h1>{{ ucfirst(__('pages.rh.user.params')) }}</h1>

        <div class="row">
            <div class="col-md-12">
                {{ Form::model($member->info,['method' => 'PUT', 'url' => route('member.params.update'),'class' => 'form-horizontal','enctype'=> 'multipart/form-data']) }}
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">{{ __('pages.auth.register.Personal details') }}</h4>
                            <div class="form-group">
                                {{ Form::label('name',__('validation.attributes.name') . ' :',['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ Form::text('first_name',null,['class' => 'form-control', 'placeholder'=> __('validation.attributes.first_name'),'required','minlenght' => '3','maxlenght'=> '15']) }}
                                            @if($errors->has('first_name'))
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <span
                                                            class="text-danger">{{ $errors->first('first_name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::text('last_name',null,['class' => 'form-control', 'placeholder'=> __('validation.attributes.last_name'),'required','minlenght' => '3','maxlenght'=> '15']) }}
                                            @if($errors->has('last_name'))
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <span
                                                            class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('tel', __('validation.attributes.phone'),['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            +212
                                        </span>
                                        {{ Form::tel('tel',$member->info->tels[0]->tel,['class' => 'form-control', 'placeholder' => '06', 'minlenght' => '10', 'maxlenght' => '10']) }}
                                    </div>
                                    @if($errors->has('tel'))
                                        <span class="text-danger">{{ $errors->first('tel') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('address',__('validation.attributes.address'),['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Address', 'required', 'minlenght' => '10','maxlenght' => '80']) }}
                                            @if($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif

                                        </div>
                                        <div class="col-md-6">
                                            <select name="city" id="city" title="city" class="form-control" required>
                                                @if(!old('city') && !$member->info->city_id)
                                                    <option>{{ __('validation.attributes.city') }}</option>
                                                @endif
                                                @foreach($cities as $city)
                                                        @if(old('city'))
                                                            <option value="{{ $city->id }}" {{ (old('city') == $city->id) ? 'selected' : '' }}>{{ $city->city }}</option>
                                                        @elseif($member->info->city_id)
                                                            <option value="{{ $city->id }}" {{ ($member->info->city_id == $city->id) ? 'selected' : '' }}>{{ $city->city }}</option>
                                                        @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('city'))
                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('birth',__('validation.attributes.birth'), ['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    {{ Form::date('birth',(old('birth') || ($member->info->birth)) ? (old('birth')) ?: $member->info->birth : gmdate('Y-m-d',strtotime("-18 years")),['class' => 'form-control','placeholder' => 'birth', 'required']) }}
                                    @if($errors->has('birth'))
                                        <span class="text-danger">{{ $errors->first('birth') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('sex',__('validation.attributes.sex'),['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    <select name="sex" id="sex" title="sex" class="form-control" >
                                        @if(!old('sex'))
                                            <option disabled selected value>{{ __('validation.attributes.sex') }}</option>
                                        @endif
                                        <option value="homme" {{ (old('sex') == 'homme') ? 'selected' : '' }}>Homme
                                        </option>
                                        <option value="femme" {{ (old('sex') == 'femme') ? 'selected' : '' }}>Femme
                                        </option>
                                    </select>
                                    @if($errors->has('sex'))
                                        <span class="text-danger">{{ $errors->first('sex') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">{{ __('pages.auth.register.Account Details') }}</h4>

                            <div class="form-group">
                                {{ Form::label('identity', __('validation.attributes.identity'), ['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ Form::text('name',$member->name,['class' => 'form-control', 'placeholder' => __('validation.attributes.username'),'required','minlenght' => '3','maxlenght' => '15']) }}
                                            @if($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::email('email',$member->info->emails[0]->email,['class' => 'form-control', 'placeholder' => __('validation.attributes.email'),'required','minlenght' => '5','maxlenght' => '80']) }}
                                            @if($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('password', __('validation.attributes.password'), ['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ Form::password('password',['class' => 'form-control', 'placeholder' => __('validation.attributes.password'),'minlenght' => '6']) }}
                                            @if($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => __('validation.attributes.password_confirmation'),'minlenght' => '6']) }}
                                            @if($errors->has('password_confirmation'))
                                                <span
                                                    class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('identity',__('validation.attributes.identity'),['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    <select name="identity" id="identity" title="identity" class="form-control"
                                            required>
                                        @if(!old('identity'))
                                            <option
                                                value="{{ $identity }}">
                                                @if($identity == 'email')
                                                    {{ __('validation.attributes.email') }}
                                                @endif
                                                @if($identity == 'name')
                                                        {{ __('validation.attributes.username') }}
                                                    @endif
                                                @if($identity == 'tel')
                                                        {{ __('validation.attributes.phone') }}
                                                    @endif
                                            </option>
                                        @endif
                                        <option
                                            value="name" {{ (old('identity') == 'username') ? 'selected' : '' }}>{{ __('validation.attributes.username') }}</option>
                                        <option
                                            value="email" {{ (old('identity') == 'email') ? 'selected' : '' }}>{{ __('validation.attributes.email') }}</option>
                                        <option
                                            value="tel" {{ (old('identity') == 'phone') ? 'selected' : '' }}>{{ __('validation.attributes.phone') }}</option>
                                    </select>
                                    @if($errors->has('identity'))
                                        <span class="text-danger">{{ $errors->first('identity') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('cin',__('validation.attributes.cin'),['class' => 'col-lg-3 control-label']) }}
                                <div class="col-md-9">
                                    {{ Form::text('cin', null, ['class' => 'form-control', 'placeholder' => __('validation.attributes.cin')]) }}
                                    @if($errors->has('cin'))
                                        <span class="text-danger">{{ $errors->first('cin') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <label>{{__('validation.attributes.face')}}</label>
                                <div id="filesinput">
                                    <!-- Our File Inputs -->
                                    <div class="wrap-custom-file">
                                        <input type="file" name="face" id="face" accept=".gif, .jpg, .png"/>
                                        <label for="face" class="covimgs"
                                               style="background-image: url({{ asset(($member->info->face) ? 'storage/' . $member->info->face:'img/user.jpg') }})">
                                            <span>{{__('validation.attributes.face')}}</span>
                                            <i class="fa fa-edit text-dark"></i>
                                        </label>

                                    </div>
                                    <!-- End Page Wrap -->
                                </div>
                                <small class="help-block">Allowed images: jpg, gif, png.
                                </small>
                                @if ($errors->has('face'))
                                    <div class="help-block">{{ $errors->first('face') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i> {{ __('validation.attributes.edit') }}
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

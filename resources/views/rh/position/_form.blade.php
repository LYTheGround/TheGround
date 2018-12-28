@if(isset($info))
    {{ Form::model($info,['method' => 'PUT', 'url' => route('position.update',compact('position')), 'enctype'=>"multipart/form-data"]) }}
@else
    {{ Form::open(['method' => 'POST', 'url' => route('position.store'), 'enctype'=>"multipart/form-data"]) }}
@endif
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('first_name',__('validation.attributes.first_name'),['class' => 'control-label']) }}
            {{ Form::text('first_name',null,['class' => 'form-control','placeholder' => __('validation.attributes.first_name'),'required']) }}
            @if ($errors->has('first_name'))
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('last_name',__('validation.attributes.last_name'),['class' => 'control-label']) }}
            {{ Form::text('last_name',null,['class' => 'form-control','placeholder' => __('validation.attributes.last_name'),'required']) }}
            @if ($errors->has('last_name'))
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">

            {{ Form::label('tel',__('validation.attributes.phone'),['class' => 'control-label']) }}
            {{ Form::tel('tel',(isset($info)) ? $info->tels[0]->tel : null,['class' => 'form-control','placeholder' => __('validation.attributes.phone'),'required']) }}
            @if ($errors->has('tel'))
                <span class="text-danger">{{ $errors->first('tel') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('email',__('validation.attributes.email'),['class' => 'control-label']) }}
            {{ Form::email('email',(isset($info)) ? $info->emails[0]->email : null,['class' => 'form-control','placeholder' => __('validation.attributes.email'),'required']) }}
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('address',__('validation.attributes.address'),['class' => 'control-label']) }}
            {{ Form::text('address',null,['class' => 'form-control','placeholder' => __('validation.attributes.address')]) }}
            @if ($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('position',__('validation.attributes.position'),['class' => 'control-label']) }}
            {{ Form::text('position',(isset($info)) ? $info->position->position : null,['class' => 'form-control','placeholder' => __('validation.attributes.position'),'required']) }}
            @if ($errors->has('position'))
                <span class="text-danger">{{ $errors->first('position') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('sex',__('validation.attributes.sex'),['class' => 'control-label']) }}
            <select name="sex" title="sex" id="sex" class="form-control" required>
                @if(isset($info))
                    @if(!$info->sex && !old('sex'))
                        <option disabled selected value>{{ __('validation.attributes.sex') }}</option>
                    @endif
                @elseif(!old('sex'))
                    <option disabled selected value>{{ __('validation.attributes.sex') }}</option>
                @endif
                <option
                    value="homme" {{ (old('sex') && old('sex') == 'homme') ? 'selected' : ((isset($info)) && ($info->sex == 'homme')) ? 'selected' :'' }}>{{__('validation.attributes.homme')}}</option>
                <option
                    value="femme" {{ (old('sex') && old('sex') == 'femme') ? 'selected' : ((isset($info)) && ($info->sex == 'femme')) ? 'selected' :'' }}>{{__('validation.attributes.femme')}}</option>

            </select>
            @if ($errors->has('sex'))
                <span class="text-danger">{{ $errors->first('sex') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('city',__('validation.attributes.city'),['class' => 'control-label']) }}
            <select id="city" title="city" name="city" class="form-control" required>
                @if(!old('city'))
                    <option disabled selected value>{{ __('validation.attributes.city') }}</option>
                @endif
                @foreach($cities as $city)
                    @if(old('city') == $city->id)
                        <option value="{{$city->id}}" selected>{{$city->city}}</option>
                    @elseif((!old('city') && (isset($info)) && ($info->city_id == $city->id)))
                        <option value="{{$city->id}}" selected>{{$city->city}}</option>
                    @else
                        <option value="{{$city->id}}">{{$city->city}}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('city_id'))
                <span class="text-danger">{{ $errors->first('city_id') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('birth',__('validation.attributes.birth'),['class' => 'control-label']) }}
            {{ Form::date('birth',(isset($info)) ? $info->birth : null,['class' => 'form-control','placeholder' => __('validation.attributes.birth'), 'required']) }}
            @if ($errors->has('birth'))
                <span class="text-danger">{{ $errors->first('birth') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('cin',__('validation.attributes.cin'),['class' => 'control-label']) }}
            {{ Form::text('cin',null,['class' => 'form-control','placeholder' => __('validation.attributes.cin')]) }}
            @if ($errors->has('cin'))
                <span class="text-danger">{{ $errors->first('cin') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="form-group text-center">
    <label>{{__('validation.attributes.face')}}</label>
    <div id="filesinput">
        <!-- Our File Inputs -->
        <div class="wrap-custom-file">
            <input type="file" name="face" id="image1" accept=".gif, .jpg, .png"/>
            <label for="image1" class="covimgs"
                   style="background-image: url('{{ (isset($info) && ($info->face)) ? asset('storage/' . $info->face) : asset('img/user.jpg') }}');">
                <span>{{ __('validation.attributes.face') }}</span>
                <i class="fa {{ (isset($info) && ($info->face)) ? 'fa-edit' : 'fa-plus-circle' }}"></i>
            </label>
        </div>
        <!-- End Page Wrap -->
    </div>
    <small class="help-block">{{ __('validation.attributes.img_input') }}</small>
    @if ($errors->has('img'))
        <div class="help-block">{{ $errors->first('img') }}</div>
    @endif
</div>

<div class="m-t-20 text-right">
    <button class="btn btn-primary">{{ $submit }}</button>
</div>
{{ Form::close() }}

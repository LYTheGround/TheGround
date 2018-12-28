@if(isset($info))
    {{ Form::model($info,['method' => 'PUT', 'url' => route('client.update',compact('client'))]) }}
@else
    {{ Form::open(['method' => 'POST', 'url' => route('client.store')]) }}
@endif

<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('name',__('validation.attributes.name'),['class' => 'control-label']) }}
            {{ Form::text('name',null,['class' => 'form-control', 'placeholder' => __('validation.attributes.name'), 'required']) }}

            @if ($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('email',__('validation.attributes.email'),['class' => 'control-label']) }}
            {{ Form::email('email',(!old('email')) ? (isset($info->emails[0])) ? $info->emails[0]->email : null : old('email'),['class' => 'form-control', 'placeholder' => __('validation.attributes.email')]) }}

            @if ($errors->has('email'))
                <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('tel',__('validation.attributes.phone'),['class' => 'control-label']) }}
            {{ Form::text('tel',(!old('tel')) ? (isset($info->tels[0])) ? $info->tels[0]->tel : null : old('tel'),['class' => 'form-control', 'placeholder' => __('validation.attributes.phone'), 'required']) }}

            @if ($errors->has('tel'))
                <div class="text-danger">{{ $errors->first('tel') }}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('fax',__('validation.attributes.fax'),['class' => 'control-label']) }}
            {{ Form::text('fax',null,['class' => 'form-control', 'placeholder' => __('validation.attributes.fax')]) }}

            @if ($errors->has('fax'))
                <div class="text-danger">{{ $errors->first('fax') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            {{ Form::label('speaker',__('validation.attributes.speaker'),['class' => 'control-label']) }}
            {{ Form::text('speaker',null,['class' => 'form-control', 'placeholder' => __('validation.attributes.speaker'), 'required']) }}

            @if ($errors->has('speaker'))
                <div class="text-danger">{{ $errors->first('speaker') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            {{ Form::label('address',__('validation.attributes.address'),['class' => 'control-label']) }}
            {{ Form::text('address',null,['class' => 'form-control', 'placeholder' => __('validation.attributes.address'), 'required']) }}

            @if ($errors->has('address'))
                <div class="text-danger">{{ $errors->first('address') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            {{ Form::label('build',__('validation.attributes.build'),['class' => 'control-label']) }}
            {{ Form::number('build',null,['class' => 'form-control', 'placeholder' => __('validation.attributes.build'), 'required']) }}

            @if ($errors->has('build'))
                <div class="text-danger">{{ $errors->first('build') }}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            {{ Form::label('floor',__('validation.attributes.floor'),['class' => 'control-label']) }}
            {{ Form::number('floor',null,['class' => 'form-control', 'placeholder' => __('validation.attributes.floor')]) }}

            @if ($errors->has('floor'))
                <div class="text-danger">{{ $errors->first('floor') }}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            {{ Form::label('apt_nbr',__('validation.attributes.apt_nbr'),['class' => 'control-label']) }}
            {{ Form::number('apt_nbr',null,['class' => 'form-control', 'placeholder' => __('validation.attributes.apt_nbr')]) }}

            @if ($errors->has('apt_nbr'))
                <div class="text-danger">{{ $errors->first('apt_nbr') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('zip',__('validation.attributes.zip'),['class' => 'control-label']) }}
            {{ Form::text('zip',null,['class' => 'form-control', 'placeholder' => __('validation.attributes.zip')]) }}

            @if ($errors->has('zip'))
                <div class="text-danger">{{ $errors->first('zip') }}</div>
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
            @if ($errors->has('city'))
                <div class="text-danger">{{ $errors->first('city') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            {{ Form::label('description',__('validation.attributes.description'),['class' => 'control-label']) }}
            {{ Form::textarea('description',(!old('description')) ? (isset($info->client->description)) ? $info->client->description : null : old('description'),['class' => 'form-control', 'placeholder' => __('validation.attributes.description')]) }}

            @if ($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="m-t-20 text-right">
    <button class="btn btn-primary">{{ $submit }}</button>
</div>

{{ Form::close() }}

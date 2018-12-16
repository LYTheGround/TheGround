@extends('layouts.app')
@section('page-title')
    {{ $unload->name }}
@stop
@section('content')
    <div class="content .container-fluid">
        <div class="row">
            <h1>{{ $unload->name }}</h1>
        </div>
        <div class="card-box">
            {{ Form::open(['method' => 'PUT', 'url' => route('unload.update',compact('unload')),'class' => 'form-horizontal','enctype' => 'multipart/form-data']) }}
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">{{ ucfirst(__('validation.attributes.name')) }} : </label>
                            <input type="text" name="name" title="name" value="{{ $unload->name }}" id="name"
                                   class="form-control"
                                   placeholder="Nom de la charge" required>
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prince">{{ __('validation.attributes.prince') }} :</label>
                            <input type="number" name="prince" title="prince" value="{{ $unload->prince }}" id="prince"
                                   class="form-control"
                                   placeholder="Prince" required>
                            @if($errors->has('prince'))
                                <span class="text-danger">{{ $errors->first('prince') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="charge">{{ __('validation.attributes.chargeOn') }} :</label>
                            <select name="charge" id="charge" class="form-control" title="charge">
                                <option value="taxes" {{ ($unload->taxes) ? 'selected' : '' }}>{{ __('validation.attributes.taxes') }}</option>
                                <option value="tva" {{ ($unload->tva) ? 'selected' : '' }}>{{ __('validation.attributes.tva') }}</option>
                            </select>
                        </div>
                        @if($errors->has('charge'))
                            <span class="text-danger">{{ $errors->first('charge') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">{{ __('validation.attributes.description') }} : </label>
                            <textarea name="description" class="form-control" id="description" cols="30"
                                      rows="10">{{ $unload->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="form-group">
                            <label>{{ __('validation.attributes.justify') }}</label>
                            <div id="filesinput">
                                <!-- Our File Inputs -->
                                <div class="wrap-custom-file">
                                        <input type="file" name="justify" id="image4" accept=".gif, .jpg, .png" />
                                        <label  for="image4" class="covimgs" {{isset($unload->justify) ? 'style=background-image:'."url(".asset("storage/". $unload->justify).")" : '' }}>
                                            <span>Select Justify</span>
                                            <i class="fa fa-plus-circle"></i>
                                        </label>
                                </div>
                                <!-- End Page Wrap -->
                            </div>
                            @if ($errors->has('justify'))
                                <div class="help-block">{{ $errors->first('justify') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 text-right">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

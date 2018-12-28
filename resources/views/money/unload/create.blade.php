@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('pages.money.unload.create')) }}
@stop
@section('content')
    <div class="content .container-fluid">
        <div class="row">
            <h1>{{ ucfirst(__('pages.money.unload.create')) }}</h1>
        </div>
        <div class="card-box">
            {{ Form::open(['method' => 'POST', 'url' => route('unload.store'),'class' => 'form-horizontal','enctype' => 'multipart/form-data']) }}
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">{{ ucfirst(__('validation.attributes.name')) }} : </label>
                            <input type="text" name="name" title="name" id="name" class="form-control"
                                   placeholder="{{ ucfirst(__('validation.attributes.name')) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prince">{{ __('validation.attributes.prince') }} :</label>
                            <input type="text" name="prince" title="prince" id="prince" class="form-control"
                                   placeholder="{{ __('validation.attributes.prince') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="charge">{{ __('validation.attributes.chargeOn') }} :</label>
                            <select name="charge" id="charge" class="form-control" title="charge" required>
                                <option disabled selected value>{{ __('validation.attributes.chargeOn') }}</option>
                                <option value="taxes">{{ __('validation.attributes.taxes') }}</option>
                                <option value="tva">{{ __('validation.attributes.tva') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">{{ __('validation.attributes.description') }} : </label>
                            <textarea name="description" class="form-control" id="description" cols="30"
                                      rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="form-group">
                            <label>{{ __('validation.attributes.justify') }}</label>
                            <div id="filesinput">
                                <!-- Our File Inputs -->
                                <div class="wrap-custom-file">
                                    <input type="file" name="justify" id="image1" accept=".gif, .jpg, .png"/>
                                    <label for="image1"
                                           class="covimgs" {{'style=background-image:'."url(".asset("img/placeholder.jpg").")"}} >
                                        <span>{{ __('pages.product.form.selectImg') }}</span>
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
                    <input type="submit" value="Create" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

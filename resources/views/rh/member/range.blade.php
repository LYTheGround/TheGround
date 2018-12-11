@extends('layouts.app')
@section('page-title')
   {{ __('pages.rh.user.range.range_title') . ' :' }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <h1>{{ __('pages.rh.user.range.range_title') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="dash-widget dash-widget5">
                    <span class="dash-widget-icon @if($member->company->premium->sold > 10) bg-success @elseif ($member->company->premium->sold > 5) bg-warning @else bg-danger @endif">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </span>
                    <div class="dash-widget-info m-b-10">
                        <span>sold de la compagnie : </span>
                        <h2>{{ $member->company->premium->sold . ' jours' }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="dash-widget dash-widget5">
                    <span class="dash-widget-icon bg-info">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </span>
                    <div class="dash-widget-info m-b-10">
                        <span>{{ __('pages.rh.user.range.limit_left',['value' => \App\Premium::diffDaysLimit($member->premium->limit)]) }}</span>
                        <h2>{{ __('validation.attributes.sold') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                {{ Form::open(['method' => 'PUT', 'url' => route('member.range.update',compact('member')),'class' => 'form-horizontal']) }}
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-12 m-b-30">
                            <label for="range" class="control-label">{{ __('pages.rh.user.range.range') }}:</label>
                            <input type="number" name="range" value="{{ old('range') ?: '1' }}" id="range" class="form-control" placeholder="{{ __('pages.rh.user.range.range') }}"
                                   min="1" max="{{ $member->company->premium->sold }}" required>
                        </div>
                        @if($errors->has('range'))
                            <span class="error-box text-danger">{{ $errors->first('range') }}</span>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="{{ __('validation.attributes.edit') }}">
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

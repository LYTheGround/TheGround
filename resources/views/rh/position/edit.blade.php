@extends("layouts.app")
@section('page-title')
    {{__('pages.rh.position.edit.title')}}
@stop
@section('content')

    <div class="content container-fluid">
        <div class="row">
            <h1 class="page-title">{{__('pages.rh.position.edit.title')}}</h1>
        </div>
        <div class="card-box">
            <div class="row">
                @include('rh.position._form',['submit' => __('validation.attributes.edit'),'info' => $position->info])
            </div>
        </div>
    </div>

@stop

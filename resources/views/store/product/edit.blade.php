@extends("layouts.app")
@section('page-title')
    {{__('pages.product.edit.title')}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{__('pages.product.edit.title')}}</h4>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-xs-12">
                    @include('store.product._form',['submit' => __('validation.attributes.edit'), 'fa' => 'fa fa-edit'])
                </div>
            </div>
        </div>
    </div>
 @stop

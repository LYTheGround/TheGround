@extends('layouts.app')
@section('page-title')
    DV Create
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <h4>create devi</h4>
        </div>
        {{ Form::open(['method' => 'POST','url' => route('dv.store',compact('buy')),'class' => 'form-horizontal']) }}
        <div class="row m-b-30">
            <table class="col-xs-12">
                <tr>
                    <td colspan="3">
                        <select name="provider" id="provider" class="form-control">
                            @foreach($providers as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->info_box->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table></div>
            <div class="row">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                    <tr>
                        <th>product</th>
                        <th>Qt</th>
                        <th class="text-center">PU</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bcs as $bc)
                        <tr>
                            <td><a href="#">{{ $bc->product->name }}</a></td>
                            <td><a href="#">{{ $bc->qt }}</a></td>
                            <td><a href="#"><input type="number" step="0.01" name="pu[{{$bc->id}}]" class="form-control" placeholder="PU" required></a></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right">
                            {{ Form::submit('store',['class' => 'btn btn-primary']) }}
                        </td>
                    </tr>
                    {{ Form::close() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

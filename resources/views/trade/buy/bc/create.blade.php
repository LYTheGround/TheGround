@extends('layouts.app')
@section('page-title')
    BC
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <h3>BC</h3>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {{ Form::open(['method'=>'POST','url' => route('bc.products',compact('buy')),'class'=> 'form-horizontal','id' => 'form-bc']) }}
                <div class="form-group">
                    {{ Form::label('product','Product : ',['class'=>'class-control']) }}
                    {{ Form::text('product',null,['class' => 'form-control', 'id' => 'bc-product', 'placeholder' => 'Product']) }}
                </div>
                <div class="form-group text-right">
                    {{ Form::submit('Search',['class' => 'btn btn-success']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-box" id="target-list-product" style="display: none">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                        <tr>
                            <th>product</th>
                            <th>Qt</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buy->bcs as $bc)
                            <tr>
                                <td>
                                    <a href="#" class="avatar">{{ strtoupper(substr($bc->product->name,0,1))  }}</a>
                                    <h2><a href="#">{{ $bc->product->name }}</a></h2>
                                </td>
                                <td>{{ $bc->qt}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                           aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" ><i
                                                        class="fa fa-trash-o m-r-5"></i> delete</a>
                                                f<form >f
                                                </form>
                                            </li>

                                        </ul>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

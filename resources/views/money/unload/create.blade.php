@extends('layouts.app')
@section('page-title')
    unload create
@stop
@section('content')
    <div class="content .container-fluid">
        <div class="row">
            <h1>Unload Create</h1>
        </div>
        <div class="card-box">
            <div class="row">
                {{ Form::open(['method' => 'POST', 'url' => route('unload.store'),'enctype' => 'multipart/form-data']) }}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="prince">Montant a Charger</label>
                                <input type="text" name="prince" title="prince" id="prince" class="form-control" placeholder="Prince" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="justify">Montant a Charger</label>
                                <input type="file" name="justify" title="justify" id="justify" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="charge">Charges sur:</label>
                                <select name="charge" id="charge" class="form-control" title="charge">
                                    <option value="taxes">Taxes</option>
                                    <option value="tva">Tva</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group text-right">
                                <input type="submit" value="add" class="btn btn-primary">
                            </div>
                        </div>

                    </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
@stop

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
            {{ Form::open(['method' => 'POST', 'url' => route('unload.store'),'class' => 'form-horizontal','enctype' => 'multipart/form-data']) }}
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-4"><div class="form-group">
                            <label for="name">Nom Charger</label>
                            <input type="text" name="name" title="name" id="name" class="form-control"
                                   placeholder="Nom de la charge" required>
                        </div></div>
                    <div class="col-md-4"><div class="form-group">
                            <label for="prince">Montant a Charger</label>
                            <input type="text" name="prince" title="prince" id="prince" class="form-control"
                                   placeholder="Prince" required>
                        </div></div>
                    <div class="col-md-4"><div class="form-group">
                            <label for="charge">Charges sur:</label>
                            <select name="charge" id="charge" class="form-control" title="charge">
                                <option value="taxes">Taxes</option>
                                <option value="tva">Tva</option>
                            </select>
                        </div></div>
                </div>
                <div class="col-xs-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="form-group">
                            <label>pièce justificatif</label>
                            <div id="filesinput" >
                                <!-- Our File Inputs -->
                                <div class="wrap-custom-file">
                                    <input type="file" name="justify" id="image1" accept=".gif, .jpg, .png" />
                                    <label  for="image1" class="covimgs" {{'style=background-image:'."url(".asset("img/placeholder.jpg").")"}} >
                                        <span>Select justify image</span>
                                        <i class="fa fa-plus-circle"></i>
                                    </label>
                                </div>
                                <!-- End Page Wrap -->
                            </div>
                            <small class="help-block">Allowed images: jpg, gif, jpeg, png. Maximum 1 image only.</small>
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
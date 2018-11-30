@extends("layouts.app")
@section('title')
    {{__('pages.position.title_index')}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-3">
                <h4 class="page-title">{{__('pages.auth.position.index.title')}}</h4>
            </div>
            <div class="col-sm-8 col-xs-9 text-right m-b-20">
                <a href="#" data-toggle="modal" data-target="#add_position"
                   class="btn btn-primary rounded pull-right"><i
                        class="fa fa-plus"></i> {{__('validation.attributes.create')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="display datatable table table-stripped">
                                <thead>
                                <tr>
                                    <th>{{__('validation.attributes.username')}}</th>
                                    <th class="text-center">{{__('validation.attributes.phone')}}</th>
                                    <th class="text-center">{{__('validation.attributes.email')}}</th>
                                    <th class="text-center">{{__('validation.attributes.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($positions)
                                    @foreach($positions as $position)
                                        <tr>
                                            <td>
                                                <a href="{{ route('position.show',compact('position')) }}">
                                                    <span
                                                        class="avatar">{{ substr($position->info->last_name, 0, 1) }}</span>
                                                    <h2>{{strtoupper($position->info->last_name) . ' ' . ucfirst($position->info->first_name)}}</h2>
                                                </a>

                                            </td>
                                            <td class="text-center">{{$position->info->tels[0]->tel}}</td>
                                            <td class="text-center">{{$position->info->emails[0]->email}}</td>

                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                       data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="#" data-toggle="modal"
                                                               data-target="#edit_client{{$position->id}}"><i
                                                                    class="fa fa-pencil m-r-5"></i> {{ __('validation.attributes.edit') }}
                                                            </a></li>
                                                        <li><a href="#" data-toggle="modal"
                                                               data-target="#delete_client{{$position->id}}"><i
                                                                    class="fa fa-trash-o m-r-5"></i> {{ __('validation.attributes.delete') }}
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="add_position" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('pages.auth.position.create.title') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="m-b-30">
                        {{ Form::open(['method' => 'POST', 'url' => route('position.store'), 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-focus">
                                        {{ Form::label('first_name',__('validation.attributes.first_name'),['class'=> 'control-label']) }}
                                        {{ Form::text('first_name', null, ['class'=> 'form-control','placeholder' => __('validation.attributes.first_name'), 'required']) }}
                                        @if ($errors->has('first_name'))
                                            <div class="help-block">{{ $errors->first('first_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-focus">
                                        {{ Form::label('last_name',__('validation.attributes.last_name'),['class'=> 'control-label']) }}
                                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __('validation.attributes.last_name'), 'required']) }}
                                        @if ($errors->has('last_name'))
                                            <div class="help-block">{{ $errors->first('last_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-focus">
                                        {{ Form::label('tel', __('validation.attributes.phone'), ['class'=>'control-label']) }}
                                        {{ Form::tel('tel', null, ['class' => 'form-control', 'placeholder' => __('validation.attributes.phone'), 'required']) }}
                                        @if ($errors->has('tel'))
                                            <div class="help-block">{{ $errors->first('tel') }}</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-focus">
                                        {{ Form::label('email', __('validation.attributes.email') . '* :',['class' => 'control-label']) }}
                                        {{ Form::email('email', null,['class' => 'form-control', 'placeholder' => __('validation.attributes.email')]) }}
                                        @if ($errors->has('email'))
                                            <div class="help-block text-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{__('pages.position.details.address')}}</label>
                            <input class="form-control" type="text" name="address" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <div class="help-block">{{ $errors->first('address') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('pages.position.details.sex')}}</label>
                                    <select name="sex" class="select select2-hidden-accessible" tabindex="-1"
                                            aria-hidden="true">
                                        <option value="0">Choise sex</option>
                                        <option value="man">{{__('pages.position.details.man')}}</option>
                                        <option value="women">{{__('pages.position.details.women')}}</option>
                                    </select>
                                    @if ($errors->has('sex'))
                                        <div class="help-block">{{ $errors->first('sex') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('pages.position.details.city')}}</label>
                                    <select name="city_id" class="select select2-hidden-accessible" tabindex="-1"
                                            aria-hidden="true">
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->city}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <div class="help-block">{{ $errors->first('city') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('pages.position.details.birth')}}</label>
                                    <input class="form-control" type="date" name="birth" value="{{ old('birth') }}">
                                    @if ($errors->has('birth'))
                                        <div class="help-block">{{ $errors->first('birth') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('pages.position.details.cin')}}</label>
                                    <input class="form-control" type="text" name="cin" value="{{ old('cin') }}">
                                    @if ($errors->has('cin'))
                                        <div class="help-block">{{ $errors->first('cin') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{__('pages.position.details.facial')}}</label>
                            <div id="filesinput">
                                <!-- Our File Inputs -->
                                <div class="wrap-custom-file">
                                    <input type="file" name="face" id="add_image" accept=".gif, .jpg, .png"/>
                                    <label for="add_image" class="covimgs">
                                        <span>Select Image One</span>
                                        <i class="fa fa-plus-circle"></i>
                                    </label>
                                </div>
                                <!-- End Page Wrap -->
                            </div>
                            <small class="help-block">Max. file size: 50 MB. Allowed images: jpg, gif, png. Maximum 10
                                images only.
                            </small>
                            @if ($errors->has('img'))
                                <div class="help-block">{{ $errors->first('img') }}</div>
                            @endif
                        </div>

                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary btn-lg">{{__('validation.attributes.submit')}}</button>
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($positions as $position)
        <div id="edit_client{{$position->id}}" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Position</h4>
                    </div>
                    <div class="modal-body">
                        <div class="m-b-30">
                            <form action="{{URL::route('position.update',compact('position'))}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('pages.position.details.first_name')}}</label>
                                            <input class="form-control" type="text" name="first_name"
                                                   value="{{ old('first_name') != '' ? old('first_name') : $position->info->first_name }}">
                                            @if ($errors->has('first_name'))
                                                <div class="help-block">{{ $errors->first('first_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('pages.position.details.last_name')}}</label>
                                            <input class="form-control" type="text" name="last_name"
                                                   value="{{ old('last_name') != '' ? old('last_name') : $position->info->last_name }}">
                                            @if ($errors->has('last_name'))
                                                <div class="help-block">{{ $errors->first('last_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('pages.position.details.tel')}}</label>
                                            <input class="form-control" type="text" name="tel"
                                                   value="{{ old('tel') != '' ? old('tel') : $position->info->tels[0]->tel }}">
                                            @if ($errors->has('tel'))
                                                <div class="help-block">{{ $errors->first('tel') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('pages.position.details.email')}}</label>
                                            @if(isset($position->info->emails[0]->email) )
                                                <input class="form-control" type="text" name="email"
                                                       value="{{ old('email') != '' ? old('email') :   $position->info->emails[0]->email  }}">
                                            @else
                                                <input class="form-control" type="text" name="email"
                                                       value="{{ old('email') }}">
                                            @endif
                                            @if ($errors->has('email'))
                                                <div class="help-block">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{__('pages.position.details.address')}}</label>
                                    <input class="form-control" type="text" name="address"
                                           value="{{ old('address') != '' ? old('address') : $position->info->address }}">
                                    @if ($errors->has('address'))
                                        <div class="help-block">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('pages.position.details.sex')}}</label>
                                            <select name="sex" class="select select2-hidden-accessible" tabindex="-1"
                                                    aria-hidden="true">
                                                <option value="0">Choise sex</option>
                                                <option
                                                    value="man" {{$position->info->sex == 'man' ? 'selected' : ''}}>{{__('pages.position.details.man')}}</option>
                                                <option
                                                    value="women" {{$position->info->sex == 'women' ? 'selected' : ''}}>{{__('pages.position.details.women')}}</option>
                                            </select>
                                            @if ($errors->has('sex'))
                                                <div class="help-block">{{ $errors->first('sex') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('pages.position.details.city')}}</label>
                                            <select name="city_id" class="select select2-hidden-accessible"
                                                    tabindex="-1" aria-hidden="true">
                                                <option value="0">Choise city</option>
                                                @foreach($cities as $city)
                                                    <option
                                                        value="{{$city->id}}" {{$position->info->city->id == $city->id ? 'selected':''}}>{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('city'))
                                                <div class="help-block">{{ $errors->first('city') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('pages.position.details.birth')}}</label>
                                            <input class="form-control" type="date" name="birth"
                                                   value="{{ old('birth') != '' ? old('birth') : $position->info->birth }}">
                                            @if ($errors->has('birth'))
                                                <div class="help-block">{{ $errors->first('birth') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('pages.position.details.cin')}}</label>
                                            <input class="form-control" type="text" name="cin"
                                                   value="{{ old('cin') != '' ? old('cin') : $position->info->cin }}">
                                            @if ($errors->has('cin'))
                                                <div class="help-block">{{ $errors->first('cin') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{__('pages.position.details.facial')}}</label>
                                    <div id="filesinput">
                                        <!-- Our File Inputs -->
                                        <div class="wrap-custom-file">
                                            @if(isset($position->face))
                                                <label for="image1"
                                                       class="covimgs" {{isset($position->imgs[0]) ? 'style=background-image:'."url(".asset("storage/".$position->info->face).")" : '' }}>
                                                    <a href="#"
                                                       onClick='if(confirm("Do you remove it ??")){event.preventDefault();
                                                           window.location.href ="{{route('product.destroyImg',['img'=>$position->id])}}"}
                                                           else event.preventDefault()'>
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                </label>
                                            @else
                                                <input type="file" name="face" id="image" accept=".gif, .jpg, .png"/>
                                                <label for="image" class="covimgs">
                                                    <span>Select Image One</span>
                                                    <i class="fa fa-plus-circle"></i>
                                                </label>
                                            @endif
                                        </div>
                                        <!-- End Page Wrap -->
                                    </div>
                                    <small class="help-block">Max. file size: 50 MB. Allowed images: jpg, gif, png.
                                        Maximum 10 images only.
                                    </small>
                                    @if ($errors->has('face'))
                                        <div class="help-block">{{ $errors->first('face') }}</div>
                                    @endif
                                </div>

                                <div class="m-t-20 text-center">
                                    <button
                                        class="btn btn-primary btn-lg">{{__('pages.position.details.save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete_client{{$position->id}}" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">Position id: {{ $position->id }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>Are you sure want to delete this?</p>
                        <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <span
                                onclick="event.preventDefault();document.getElementById('{{ 'delete-position-' . $position->id }}').submit()"
                                class="btn btn-danger">Delete</span>
                            <form action="{{route('position.destroy',compact('position'))}}" method="POST"
                                  id="{{ 'delete-position-' . $position->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop

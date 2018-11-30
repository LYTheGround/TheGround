@extends("layouts.app")
@section('title')
    {{__('pages.position.title_show')}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{__('pages.position.title_show')}}</h4>
            </div>
            <div class="col-xs-5 text-right m-b-30">
                <a href="#" data-toggle="modal" data-target="#delete_position" class="btn btn-danger rounded ">
                    <i class="fa fa-plus"></i> {{__('pages.position.details.delete')}}
                </a>
                <a href="#" data-toggle="modal" data-target="#edit_position" class="btn btn-primary rounded ">
                    <i class="fa fa-plus"></i> {{__('pages.position.details.edit')}}
                </a>
            </div>
        </div>
        <div class="card-box m-b-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="row m-b-30">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    @if($position->info->face)
                                        <a href="#"><img class="avatar"
                                                         src="{{ ($position->info->face) ? asset('storage/'. $position->info->face) : asset('img/user.jpg') }}"
                                                         alt=""></a>
                                    @else
                                        <a href="#"><span
                                                class="avatar">{{ substr($position->info->first_name,0,1) }}</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0">{{$position->info->first_name .' '.$position->info->last_name}}</h3>
                                        @isset($position->info->sex)
                                            <div class="staff-id">{{__('pages.position.details.sex')}}
                                                : {{$position->info->birth =='women' ? __('pages.position.details.women') : __('pages.position.details.man')}}</div>@endisset
                                        @isset($position->info->birth)
                                            <div class="staff-id">{{__('pages.position.details.birth')}}
                                                : {{$position->info->birth}}</div>@endisset
                                        @isset($position->info->cin)
                                            <div class="staff-id">{{__('pages.position.details.cin')}}
                                                : {{$position->info->cin}}</div>@endisset
                                        <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send
                                                Email</a></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        @isset($position->info->tels[0]->tel)
                                            <li>
                                                <span class="title">{{__('pages.position.details.tel')}} :</span>
                                                <span class="text"><a
                                                        href="#">{{$position->info->tels[0]->tel}}</a></span>
                                            </li>
                                        @endisset
                                        @isset($position->info->emails[0]->email)
                                            <li>
                                                <span class="title">{{__('pages.position.details.email')}} :</span>
                                                <span class="text"><a href="#">{{$position->info->emails[0]->email}}</a></span>
                                            </li>
                                        @endisset

                                        @isset($position->info->address)
                                            <li>
                                                <span class="title">{{__('pages.position.details.address')}} :</span>
                                                <span class="text">{{$position->info->address}}</span>
                                            </li>
                                        @endisset
                                        @isset($position->info->city->city)
                                            <li>
                                                <span class="title">{{__('pages.position.details.city')}} :</span>
                                                <span class="text">{{$position->info->city->city}}</span>
                                            </li>
                                        @endisset

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_position" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Position</h4>
                </div>
                <div class="modal-body">
                    <div class="m-b-30">
                        <form action="{{URL::route('position.update',compact('position'))}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('pages.position.details.first_name')}}</label>
                                        <input class="form-control" type="text" name="first_name" value="{{ old('first_name') != '' ? old('first_name') : $position->info->first_name }}">
                                        @if ($errors->has('first_name'))
                                            <div class="help-block">{{ $errors->first('first_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('pages.position.details.last_name')}}</label>
                                        <input class="form-control" type="text" name="last_name" value="{{ old('last_name') != '' ? old('last_name') : $position->info->last_name }}">
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
                                        <input class="form-control" type="text" name="tel" value="{{ old('tel') != '' ? old('tel') : $position->info->tels[0]->tel }}">
                                        @if ($errors->has('tel'))
                                            <div class="help-block">{{ $errors->first('tel') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('pages.position.details.email')}}</label>
                                        @if(isset($position->info->emails[0]->email) )
                                            <input class="form-control" type="text" name="email" value="{{ old('email') != '' ? old('email') :   $position->info->emails[0]->email  }}">
                                        @else
                                            <input class="form-control" type="text" name="email" value="{{ old('email') }}">
                                        @endif
                                        @if ($errors->has('email'))
                                            <div class="help-block">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{__('pages.position.details.address')}}</label>
                                <input class="form-control" type="text" name="address" value="{{ old('address') != '' ? old('address') : $position->info->address }}">
                                @if ($errors->has('address'))
                                    <div class="help-block">{{ $errors->first('address') }}</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('pages.position.details.sex')}}</label>
                                        <select name="sex" class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                            <option value="0">Choise sex</option>
                                            <option value="man" {{$position->info->sex == 'man' ? 'selected' : ''}}>{{__('pages.position.details.man')}}</option>
                                            <option value="women" {{$position->info->sex == 'women' ? 'selected' : ''}}>{{__('pages.position.details.women')}}</option>
                                        </select>
                                        @if ($errors->has('sex'))
                                            <div class="help-block">{{ $errors->first('sex') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('pages.position.details.city')}}</label>
                                        <select name="city_id" class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                            <option value="0">Choise city</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" {{$position->info->city->id == $city->id ? 'selected':''}}>{{$city->city}}</option>
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
                                        <input class="form-control" type="date" name="birth" value="{{ old('birth') != '' ? old('birth') : $position->info->birth }}">
                                        @if ($errors->has('birth'))
                                            <div class="help-block">{{ $errors->first('birth') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('pages.position.details.cin')}}</label>
                                        <input class="form-control" type="text" name="cin" value="{{ old('cin') != '' ? old('cin') : $position->info->cin }}">
                                        @if ($errors->has('cin'))
                                            <div class="help-block">{{ $errors->first('cin') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{__('pages.position.details.facial')}}</label>
                                <div id="filesinput" >
                                    <!-- Our File Inputs -->
                                    <div class="wrap-custom-file">
                                        @if(isset($position->face))
                                            <label  for="image1" class="covimgs" {{isset($position->imgs[0]) ? 'style=background-image:'."url(".asset("storage/".$position->info->face).")" : '' }}>
                                                <a href="#" onClick='if(confirm("Do you remove it ??")){event.preventDefault();
                                                    window.location.href ="{{route('product.destroyImg',['img'=>$position->id])}}"}
                                                    else event.preventDefault()'>
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </label>
                                        @else
                                            <input type="file" name="face" id="image" accept=".gif, .jpg, .png" />
                                            <label  for="image" class="covimgs" >
                                                <span>Select Image One</span>
                                                <i class="fa fa-plus-circle"></i>
                                            </label>
                                        @endif
                                    </div>
                                    <!-- End Page Wrap -->
                                </div>
                                <small class="help-block">Max. file size: 50 MB. Allowed images: jpg, gif, png. Maximum 10 images only.</small>
                                @if ($errors->has('face'))
                                    <div class="help-block">{{ $errors->first('face') }}</div>
                                @endif
                            </div>

                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary btn-lg">{{__('pages.position.details.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="delete_position" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">Position id: {{ $position->id }}</h4>
                </div>
                <div class="modal-body card-box">
                    <p>Are you sure want to delete this?</p>
                    <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <span onclick="event.preventDefault();document.getElementById('{{ 'delete-position-' . $position->id }}').submit()" class="btn btn-danger">Delete</span>
                        <form action="{{route('position.destroy',compact('position'))}}" method="POST" id="{{ 'delete-position-' . $position->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

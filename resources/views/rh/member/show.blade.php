@extends('layouts.app')
@section('page-title')
    {{ ucfirst($member->name) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ ucfirst(__('pages.rh.user.profile')) }}</h4>
            </div>
            <div class="col-xs-5 text-right m-b-30">
                @can('range',$member)
                    <a href="{{ route('member.range',compact('member')) }}" class="btn btn-primary rounded"><i
                            class="fa fa-plus"></i> Range</a>
                    @if($member->premium->category->category != 'pdg' && $member->premium->update_status <= gmdate('Y-m-d'))
                        <a href="{{ route('member.status',compact('member')) }}" class="btn btn-success rounded"><i
                                class="fa fa-plus"></i> Status</a>
                    @endif
                @endcan
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#">
                                    <img class="avatar"
                                         src="{{ ($member->info->face) ? asset('storage/' . $member->info->face) : asset('img/user.jpg') }}"
                                         alt="{{ $member->name }}" title="{{ $member->name }}">
                                </a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 m-b-0">{{ $member->info->last_name . ' ' . $member->info->first_name }}</h3>
                                        <small
                                            class="text-muted">{{ ucfirst($member->premium->category->category) }}</small>
                                        <div class="staff-id">Employee ID : {{ $member->slug }}</div>
                                        <div class="staff-msg"></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li  class="row text-left">
                                            <span class="title">{{ __('validation.attributes.phone') }} :</span>
                                            <span class="text"><a href="#">{{ $member->info->tels[0]->tel }}</a></span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.email') }} :</span>
                                            <span class="text">
                                                <a href="#" title="{{ $member->info->emails[0]->email }}">{{ $member->info->emails[0]->email }}</a>
                                            </span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.birth') }} :</span>
                                            <span class="text">{{ ($member->info->birth) ? Carbon\Carbon::parse($member->info->birth)->format('d-m-Y') : 'inconnu' }}</span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.address') }} :</span>
                                            <span class="text">
                                                {{ $member->info->address . ', ' . ucfirst($member->info->city->city) }}
                                            </span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.sex') }} :</span>
                                            <span class="text">{{ ($member->info->sex) ?: 'inconnu' }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

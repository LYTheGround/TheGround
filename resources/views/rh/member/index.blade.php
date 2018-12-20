@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__("pages.rh.user.members")) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1 class="page-title">{{ ucfirst(__("pages.rh.user.members")) }}</h1>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th>{{ __('validation.attributes.name') }}</th>
                                <th>{{ __('validation.attributes.email') }}</th>
                                <th>{{ __('validation.attributes.phone') }}</th>
                                <th>{{ __('validation.attributes.status') }}</th>
                                @can('range',auth()->user()->member)
                                    <th class="text-right">{{ __('validation.attributes.action') }}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>
                                        @if($member->info->face)
                                            <img src="{{ asset('storage/' . $member->info->face) }}" class="avatar"
                                                 alt="{{ $member->name }}" title="{{ $member->name }}">
                                        @else
                                            <a href="#" class="avatar"
                                               title="{{ $member->name }}">{{ strtoupper(substr($member->name,0,1))  }}</a>
                                        @endif
                                        <h2>
                                            <a href="{{ route('member.show',compact('member')) }}">{{ strtoupper($member->info->last_name)  . ' ' . ucfirst($member->info->first_name)  }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $member->info->emails[0]->email }}</td>
                                    <td>{{ $member->info->tels[0]->tel }}</td>
                                    <td><span
                                            class="label {{ ($member->premium->status->status != 'active') ? ($member->premium->status->status != 'inactive') ? 'label-danger-border' : 'label-warning-border' : 'label-success-border'}}">{{ ucfirst(__('pages.premium.statuses.' . $member->premium->status->status)) }}</span>
                                    </td>
                                    @can('range',auth()->user()->member)
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="{{ route('member.status',compact('member')) }}"><i
                                                                class="fa fa-plus m-r-5"></i> Range</a></li>
                                                    <li><a href="{{ route('member.status',compact('member')) }}"><i
                                                                class="fa fa-pencil m-r-5"></i> Status</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

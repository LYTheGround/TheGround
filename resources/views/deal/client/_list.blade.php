<div class="card-box">
    <div class="card-block">
        <div class="table-responsive">
            <table class="display datatable table table-stripped">
                <thead>
                <tr>

                    <th>{{__('validation.attributes.name')}}</th>
                    <th>{{__('validation.attributes.city')}}</th>
                    <th>{{__('validation.attributes.phone')}}</th>
                    <th>{{__('validation.attributes.speaker')}}</th>
                    <th>{{__('validation.attributes.email')}}</th>
                    <th>{{__('validation.attributes.action')}}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)

                        <tr>
                            <td>
                                <span class="avatar">{{ substr($client->info_box->name,0,1) }}</span>
                                <a href="{{ route('client.show',compact('client'))}}">{{$client->info_box->name}}</a>
                            </td>
                            <td>{{$client->info_box->city->city}}</td>
                            <td>{{ $client->info_box->tels[0]->tel}}</td>
                            <td>{{$client->info_box->speaker}}</td>
                            <td>{{$client->info_box->emails[0]->email}}</td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#" class="action-icon dropdown-toggle"
                                       data-toggle="dropdown" aria-expanded="false"><i
                                            class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="{{URL::route('client.edit', compact('client')) }}"><i
                                                    class="fa fa-pencil m-r-5"></i> {{__('validation.attributes.edit')}}
                                            </a></li>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#delete_client{{ $client->id }}">
                                                <i class="fa fa-trash-o m-r-5"></i> {{__('validation.attributes.delete')}}
                                            </a>
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

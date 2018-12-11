<div id="delete_client{{ $client->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">{{ $client->info_box->name}}</h4>
            </div>
            <div class="modal-body card-box">
                <p>{{ __('pages.diver.sure') }}</p>
                {!! __('pages.deal.client.delete.modal_delete') !!}
                <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <span onclick="event.preventDefault();document.getElementById('{{ 'delete-client-' . $client->id }}').submit()" class="btn btn-danger">Delete</span>
                    <form action="{{route('client.destroy',compact('client'))}}" method="POST" id="{{ 'delete-client-' . $client->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_position" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('pages.rh.position.create.title') }}</h4>
            </div>
            <div class="modal-body">
                <div class="m-b-30">
                    @include('rh.position._form',['submit' => __('validation.attributes.create')])
                </div>
            </div>
        </div>
    </div>
</div>

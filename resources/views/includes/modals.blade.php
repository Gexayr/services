<!-- Modal -->
<div class="modal fade" id="addService" tabindex="-1" role="dialog" aria-labelledby="addServiceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('services.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceLabel">Add Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="service-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="service-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description</label>
                        <textarea class="form-control" id="message-text" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

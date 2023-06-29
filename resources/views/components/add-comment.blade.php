<form method="POST" action="{{route('comment.store')}}" class="modal fade" id="addComment">
    @csrf
    <input type="hidden" id="commentTaskId" name="taskId"/>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Comment for this task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="taskDescription" class="form-label">Task Comment</label>
                    <textarea name="body" id="commentBody" class="form-control" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>

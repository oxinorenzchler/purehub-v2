<!-- Modal -->
<div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePostModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove post?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <form id="deletePostForm" action="{{ route('delete.post') }}" method="POST">
        	@csrf
        	@method('DELETE')
        	<input type="text" name="postid" id="deletePostID">
        	<button class="btn btn-primary">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="border p-2 mt-5 mb-5">
	<h4>Hey, what's up?</h4>
	<form id="post-form" action="{{ route('add.post') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<textarea id="post-content-input" name="content" class="form-control">

		</textarea>
		<div class="form-row">
			<div class="col">
				<div class="form-group">
					<label for="file-input" class="btn btn-sm btn-danger">Upload</label>
					<input id="file-input" type="file" name="file" class="d-none">
				</div>
			</div>
			<div class="col">
				<div class="form-group float-right">
					<button class="btn btn-primary" id="post-submit-btn">Post</button>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<small class="post-msg" class="form-text text-muted"></small>
	</form>
<script type="text/javascript" src="{{ asset('js/post.js') }}"></script>
</div>
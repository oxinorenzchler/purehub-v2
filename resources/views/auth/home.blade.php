@extends('layouts.template')
@section('content')
<div class="container-fluid">
	<div class="col-md-6 offset-md-3">
		@include('partials.post_form')

		<div id="posts-section">
			@foreach (App\Post::getAllPost() as $post)
			<div class="post-item-{{$post->id}} card mb-5">
				<div class="d-flex justify-content-between">
					<a href="">{{$post->user->name}}</a>
					<div class="justify-content-end">
						<a onclick="toggleEditPostModal({{$post->id}},'{{str_replace(PHP_EOL, ' ', $post->content)}}', '{{$post->image}}')">Edit</a>
						<a onclick="toggleDeletePostModal({{$post->id}})">Remove</a>
					</div>
				</div>
				<p class="content-{{$post->id}}">{{$post->content}}</p>
				@if($post->image != null)
				<img src="{{ asset($post->image) }}" height="50" width="50">
				@endif
				{{$post->created_at->diffForHumans()}}
			</div>
			@endforeach		
		</div>
	</div>

</div>	
<!-- Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editPostModalLabel">Edit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="edit-post-form" action="{{route('edit.post')}}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<input type="text" name="postid" id="editPostID">
					<textarea id="edit-post-content-input" name="content" class="form-control mb-3"></textarea>
				<img id="edit-img-preview" src="" class="img-fluid d-block mx-auto" style="max-height: 200px !important;">
					<label for="edit-file-input" class="btn btn-sm btn-danger">Change</label>
								<input id="edit-file-input" type="file" name="file" class="d-none">
					<small class="post-msg" class="form-text text-muted"></small>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reset()">Cancel</button>
				<button id="post-edit-btn" class="btn btn-primary" onclick="saveEditPost()">Save</button>
			</div>
		</div>
	</div>
</div>
@include('partials.delete_post_modal')
@endsection
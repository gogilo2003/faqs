@extends('admin::layout.main')

@section('title')
	FAQs
@stop

@section('page_title')
	New Question
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin-faqs') }}"><i class="fa fa-list"></i> List Questions</a></li>
	<li class="active"><span><i class="fa fa-plus"></i> New Question</span></li>
@stop

@section('sidebar')
	@parent
	@include('faqs::admin.sidebar')
@stop

@section('content')

	<form method="post" action="{{route('admin-faqs-add')}}" page="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('question') ? ' has-error':'' !!}">
					<label for="question">Title</label>
					<input type="text" autofocus required class="form-control" id="question" name="question" placeholder="Enter question"{!! ((old('question')) ? ' value="'.old('question').'"' : '') !!}>
					{!! $errors->has('question') ? '<span class="text-danger">'.$errors->first('question').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group{!! $errors->has('response') ? ' has-error':'' !!}">
					<label for="response">Response</label>
					{!! $errors->has('response') ? '<span class="text-danger">'.$errors->first('response').'</span>' : '' !!}
					<textarea name="response" id="response" class="form-control tinymce" rows="5">{!! old('response') ? old('response') : '' !!}</textarea>
				</div>
			</div>
			<div class="col-md-12">
		        {{ csrf_field() }}
				<button type="submit" class="btn btn-primary btn-round"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>

	</form>

@stop

@section('styles')
	<style type="text/css">

	</style>
@stop
@section('scripts_top')
	<script type="text/javascript">

	</script>
@stop

@section('scripts_bottom')
	<script type="text/javascript">

	</script>
@stop

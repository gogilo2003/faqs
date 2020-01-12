@extends('admin::layout.main')

@section('title')
	FAQs
@stop

@section('page_title')
	Edit Question
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin-faqs') }}"><i class="fa fa-list"></i> List Questions</a></li>
	<li class="active"><span><i class="fa fa-edit"></i> Edit ({{ $faq->question }})</span></li>
@stop

@section('sidebar')
	@parent
	@include('faqs::admin.sidebar')
@stop

@section('content')

	<form method="post" action="{{route('admin-faqs-edit-post')}}" page="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('question') ? ' has-error':'' !!}">
					<label for="question">Question</label>
					<input type="text" autofocus required class="form-control" id="question" name="question" placeholder="Enter question" value="{{ (old('question') ? old('question') : $faq->question) }}">
					{!! $errors->has('question') ? '<span class="text-danger">'.$errors->first('question').'</span>' : '' !!}
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group{!! $errors->has('response') ? ' has-error':'' !!}">
					<label for="response">Response</label>
					{!! $errors->has('response') ? '<span class="text-danger">'.$errors->first('response').'</span>' : '' !!}
					<textarea name="response" id="response" class="tinymce" rows="10">{!! old('response') ? old('response') : $faq->response !!}</textarea>
				</div>
			</div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary btn-round"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
		{{ csrf_field() }}
		<input type="hidden" name="id" id="inputId" class="form-control" value="{{ $faq->id }}">

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

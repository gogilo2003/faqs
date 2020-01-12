@extends('admin::web.layout.main')

@section('title')
	Packages
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Packages</li>
@endsection

@section('content')
<div class="container">
	<div class="row">
		@forelse ($faqs as $faq)
		<div class="col-md-3">
			@include('faqs::web.inc.faq', ['faq' => $faq])
		</div>
		@empty
			<p class="text-center col-md-12">No faqs listed at the moment</p>
		@endforelse
	</div>
</div>
@endsection

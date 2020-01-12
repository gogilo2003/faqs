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
		@forelse ($packages as $package)
		<div class="col-md-3">
			@include('tour-packages::web.inc.package', ['package' => $package])
		</div>
		@empty
			<p class="text-center col-md-12">No packages listed at the moment</p>
		@endforelse
	</div>
</div>
@endsection
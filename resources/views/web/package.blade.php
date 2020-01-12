@extends('admin::web.layout.main')

@section('meta')
	<meta name="author" content="Georsamarts ICT Solutions">
    <meta name="description" content="{{ str_words_alt($package->content,160) }}">
    <meta name="keywords" content="keywords separated by comma">
	<title>{{ $package->title }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/packages') }}">Packages</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $package->title }}</li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 text-justify">
				<h3 class="text-gray mt-3 text-uppercase">{{ $package->title }}</h3>
				<img class="img-responsive" style="width: 100%" src="{{ $package->picture->url }}" alt="{{ $package->picture->title }}">
				{!! $package->details !!}
			</div>
			<div class="col-md-4 pt-2">
				<div class="card mt-5">
					<div class="card-header">
						More Packages
					</div>
					<div class="list-group">
					@foreach ($packages as $package)
						@include('tour-packages::web.inc.package-alt', ['package' => $package])
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


@push('styles')

		<style type="text/css">
			a.list-group-item{
				display: grid;
				grid-template-columns: 64px auto;
				grid-gap: 4px;
				text-decoration: none;
			}
		</style>

@endpush
<a href="{{ route('package',$package->slug) }}" class="list-group-item">
	<div class="thumb">
		<img src="{{ $package->picture->thumbnail }}" alt="{{ $package->picture->title }}" class="img-fluid rounded-circle shadow border border-info">
	</div>
	<div class="detail">
		<h4 class="text-uppercase border-bottom border-info text-info">{{ $package->title }}</h4>
		<p class="text-justify" style="color: #999">{{ str_words($package->summary,8) }}</p>
	</div>
</a>

<div class="card bordered-0">
    <img src="{{ $package->picture->url }}" class="card-img-top" alt="{{ $package->picture->title }}">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="{{ route('package',[$package->slug]) }}" class="btn btn-primary">Read More</a>
    </div>
</div>

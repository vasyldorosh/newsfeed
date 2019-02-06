<a class="card__link-wrapper js-item-card" href="{{ $item['url'] }}" target="_blank">
    <div class="card__gradient"></div>
    <img class="card-img-top card__image" src="/i.php?image={{ $item['image_url'] }}" alt="{{ $item['title'] }}">
    <div class="card-body card__body">
        <h5 class="card-title card__title card_inverse">{{ $item['title'] }}</h5>
        @if($is_text)
        <p class="card-text card__text">{{ $item['description'] }}</p>
        @endif
        @if($item['resource'])
        <a class="text-muted card__footer card_inverse" href="//{{ $item['resource'] }}" target="_blank">{{ $item['resource'] }}</a>
        @endif
    </div>
</a>
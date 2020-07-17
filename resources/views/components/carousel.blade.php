{{--  implement carousel  --}}
<div id="carouselIndicators" class="carousel position-relative slide border border-dark rounded p-2 h-100" data-ride="carousel">
    <div class="carousel-inner h-100">
        @php
            $count = 1;
        @endphp
        @foreach ($content['books'] as $value)
            <div class="carousel-item {{ ($count==1) ? 'active' : '' }}">
                <img src="{{ (isset($value->image)) ? $value->image : asset('storage/img/books/thumb-default.jpg') }}" class="d-block w-100" alt="{{ $value->name }}">
            </div>
            @php
                $count++;
            @endphp
        @endforeach

        @foreach ($content['writers'] as $value)
            <div class="carousel-item">
                <img src="{{ (isset($value->image)) ? $value->image : asset('storage/img/writers/thumb-default.jpg') }}" class="d-block w-100" alt="{{ $value->name }}">
            </div>
            @php
                $count++;
            @endphp
        @endforeach

        @foreach ($content['pubs'] as $value)
            <div class="carousel-item">
                <img src="{{ (isset($value->image)) ? $value->image : asset('storage/img/pubs/thumb-default.jpg') }}" class="d-block w-100" alt="{{ $value->name }}">
            </div>
            @php
                $count++;
            @endphp
        @endforeach
    </div>
    <ol class="carousel-indicators">
        @for ($i = 0; $i < $count; $i++)
            <li data-target="#carouselIndicators" class="{{ ($i==0) ? 'active' : '' }}"></li>
        @endfor
    </ol>
    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
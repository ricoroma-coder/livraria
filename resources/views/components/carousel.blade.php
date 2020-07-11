{{--  implement carousel  --}}
<div id="carouselIndicators" class="carousel position-relative slide border border-dark rounded p-2 h-100" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselIndicators"class="active"></li>
        <li data-target="#carouselIndicators"></li>
        <li data-target="#carouselIndicators"></li>
    </ol>
    <div class="carousel-inner h-100">
        <div class="carousel-item active">
            <img src="{{ asset('img/livro1.jpg') }}" class="d-block w-100" alt="Livro 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/livro2.jpg') }}" class="d-block w-100" alt="Livro 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/livro3.jpg') }}" class="d-block w-100" alt="Livro 3">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
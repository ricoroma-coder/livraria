
{{--  implement rank  --}}
<div class="row m-0 w-100 h-auto">
    {{--  using $title  --}}
    <p class="title">{{ $title }} Top Rankeadas</p>

    {{--  open card-deck  --}}
    <div class="card-deck h-auto w-auto mr-auto ml-auto flex-column">

        {{--  adding cards with $content  --}}
        @foreach ($content as $value)

            <div class="card mb-3 w-100 h-auto" style="max-height: 150px;">
                <div class="row no-gutters h-100">
                    <div class="col-md-4 h-100">
                        <img src="{{ asset('img/livro1.jpg') }}" class="card-img h-100" alt="...">
                    </div>
                    <div class="col-md-8 h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $value['name'] }}</h5>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div> 

</div>
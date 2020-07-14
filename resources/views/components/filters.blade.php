<div class="row m-0 w-100 h-auto" id="filter">
    <div class="row m-0 w-100 border border-outline-dark bg-white p-1">
        <div class="col-sm-11" style="height: 50px;">
            <p class="title m-0">Filtrar</p>
        </div>

        <div class="col-sm-1 p-1">
            <div id="filter-arrow" class="close"></div>
        </div>
    </div>

    <div id="filter-form" class="row m-0 w-100 close">
        <form action="#" class="ajax-form w-100">
            @foreach ($content as $value)
    
                <div class="col-sm-{{12/sizeof($content)}} p-2">
                    @if (is_array($value))
                        @component('components.filter-'.$value['name'], ['content' => $value['content']])
                        @endcomponent
                    @else
                        @component('components.filter-'.$value)
                        @endcomponent
                    @endif
                    
                </div>
                
            @endforeach
            <div class="row m-0 w-100 p-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>
    </div>
    

</div>
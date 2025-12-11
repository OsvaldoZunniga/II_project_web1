@php
    $list = is_array($trips) ? $trips : (array) $trips;
    ;
@endphp

@if(empty($list))
    <div class="d-flex justify-content-center align-items-center" style="min-height: 40vh;">
        <div class="alert alert-info small text-center">No hay viajes realizadas.</div>
    </div>
@else
    <div class="container py-4">
        <div class="row justify-content-center">
            @foreach($list as $ride)
                <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
                    @include('components.trips-realized-passenger', ['ride' => $ride])
                </div>
            @endforeach
        </div>
    </div>
@endif
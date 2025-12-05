@php
    $list = is_array($rides) ? $rides : (array) $rides;
@endphp
@if(empty($list))
    <div class="col-12">
        <div class="alert alert-info small">No hay rides realizados.</div>
    </div>
@else
    <div class="row">
        @foreach($list as $ride)
            <div class="col-12 col-sm-6 col-md-4 mb-4 style='max-width: 800px;'">
                @include('components.ride-card-base', ['ride' => $ride])
            </div>
        @endforeach
    </div>
@endif
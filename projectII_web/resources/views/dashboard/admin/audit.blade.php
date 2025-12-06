@php
    $list = is_array($auditData) ? $auditData : $auditData->toArray();
@endphp
@if(empty($list))
    <div class="col-12">
        <div class="alert alert-info small">No hay registros realizados.</div>
    </div>
@else
    <div class="row">
        @foreach($list as $audit)
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                @include('components.ride-card-searched', ['audit' => $audit])
            </div>
        @endforeach
    </div>
@endif
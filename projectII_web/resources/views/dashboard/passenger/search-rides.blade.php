<div class="container py-5 h-100" style="padding-top: 40px; padding-bottom: 40px;">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card fondo text-white shadow border-0 text-center">
                    <div class="card-body p-4">
                        <h1 class="fw-bold mb-2" style="color: #eaf7d2;">Rides Disponibles</h1>
                        <p style="color: #d6e5c0;">Encuentra el viaje perfecto para tu destino</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros y Ordenamiento -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card fondo text-white shadow border-0">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('passenger.search.rides') }}">
                            <div class="row g-3">
                                <!-- Búsqueda por ubicaciones -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold" style="color: #1A281E;">
                                        Lugar de Salida
                                    </label>
                                    <input type="text" class="form-control" name="salida" 
                                           value="{{ $filtros['salida'] }}" 
                                           placeholder="Ej: San José, Cartago...">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-bold" style="color: #1A281E;">
                                        Lugar de Llegada
                                    </label>
                                    <input type="text" class="form-control" name="llegada" 
                                           value="{{ $filtros['llegada'] }}" 
                                           placeholder="Ej: Heredia, Alajuela...">
                                </div>
                                
                                <!-- Ordenamiento -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold" style="color: #1A281E;">
                                        Ordenar por
                                    </label>
                                    <select class="form-select" name="orden">
                                        <option value="fecha_asc" {{ $orden === 'fecha_asc' ? 'selected' : '' }}>
                                            Fecha (Más próximo)
                                        </option>
                                        <option value="fecha_desc" {{ $orden === 'fecha_desc' ? 'selected' : '' }}>
                                            Fecha (Más lejano)
                                        </option>
                                        <option value="salida_asc" {{ $orden === 'salida_asc' ? 'selected' : '' }}>
                                            Origen (A-Z)
                                        </option>
                                        <option value="salida_desc" {{ $orden === 'salida_desc' ? 'selected' : '' }}>
                                            Origen (Z-A)
                                        </option>
                                        <option value="llegada_asc" {{ $orden === 'llegada_asc' ? 'selected' : '' }}>
                                            Destino (A-Z)
                                        </option>
                                        <option value="llegada_desc" {{ $orden === 'llegada_desc' ? 'selected' : '' }}>
                                            Destino (Z-A)
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-outline-light btn-lg px-4" style="width:auto;min-width:180px;">
                                        Buscar Rides
                                    </button>
                                    <a href="{{ route('passenger.search.rides') }}" class="btn btn-outline-light btn-lg px-4 ms-2" style="background:#27AE60;color:#fffde8;width:auto;min-width:180px;">
                                        Limpiar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h4 style="color: #1A281E;">
                    Rides Disponibles ({{ count($rides) }})
                </h4>
            </div>
        </div>

        <div class="row">
            @if($rides->isEmpty())
                <div class="col-12">
                    <div class="card fondo text-white border-0 shadow">
                        <div class="card-body text-center p-5">
                            <h4 style="color:#d6e5c0;">No se encontraron rides</h4>
                            <p style="color:#d6e5c0;">
                                @if(!empty($filtros['salida']) || !empty($filtros['llegada']))
                                    Intenta modificar tus criterios de búsqueda
                                @else
                                    No hay rides disponibles en este momento
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @else
                @foreach($rides as $ride)
                    @include('components.ride-card-passenger', ['ride' => $ride])
                @endforeach
            @endif
        </div>
    </div>
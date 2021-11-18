@extends('layouts.app')

@section('content')

<section class="content">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.vehicle.list') }}" class="btn btn-primary">
                    <i class="right fas fa-angle-left fa-lg"></i>&nbsp;
                    Vehicles
                </a>


            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="text-muted justify-content-center d-flex pb-3 mb-2 pt-3 bg-light">
                <h3><strong>VEHICLE DETAILS</strong></h3>
            </div>
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Name</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->name !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Brand</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->brand->name !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Logo</dt>
                <dd class="col-sm-8"><img src="{{url('/images/vehicles/logos/') .'/'. $vehicle->logoFile->file}}" class=" img-fluid img-thumbnail" alt="Logo" style="height:100px;" /></dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Main Image</dt>
                <dd class="col-sm-8"><img src="{{url('/images/vehicles/images/') .'/'. $vehicle->mainImage->file}}" class=" img-fluid img-thumbnail" alt="Logo" style="height:400px;" /></dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Slogan</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->slogan !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Description</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->description !!}</dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>

    @if($vehicle->stats)
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title text-muted pt-2">
                <strong>Vehicle States</strong>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="text-muted justify-content-center d-flex pb-3 mb-2 pt-3 bg-light">
                <h3><strong>VEHICLE STATS</strong></h3>
            </div>
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Engine</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->stats->engine !!} <strong>- v10</strong></dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Power</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->stats->power !!} <strong> - kW</strong></dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">0-100 km/h</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->stats->zero_to_hundred !!} <strong> - seconds</strong></dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Top Speed</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->stats->top_speed !!}<strong> - km/h</strong></dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Weight</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->stats->weight !!} <strong> - kg</strong></dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>
    @endif
</section>

@endsection
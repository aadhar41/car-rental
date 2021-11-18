@extends('layouts.app')

@section('content')

<section class="content">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.vehicle.list') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;
                    Listing
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
                <dd class="col-sm-8">
                    <?php if (str_contains($vehicle->logoFile->file, 'unsplash') || str_contains($vehicle->logoFile->file, 'lorempixel') || str_contains($vehicle->logoFile->file, 'placeholder') || str_contains($vehicle->logoFile->file, 'robohash')) { ?>
                        <img src="{{$vehicle->logoFile->file}}" class="img-fluid" alt="Image" style="height:100px;" />
                    <?php } else { ?>
                        <img src="{{url('/images/vehicles/logos/'.$vehicle->logoFile->file)}}" class="img-fluid img-thumbnail" alt="Image" style="height:100px;" />
                    <?php } ?>
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Main Image</dt>
                <dd class="col-sm-8">
                    <?php if (str_contains($vehicle->mainImage->file, 'unsplash') || str_contains($vehicle->mainImage->file, 'lorempixel') || str_contains($vehicle->mainImage->file, 'placeholder') || str_contains($vehicle->mainImage->file, 'robohash')) { ?>
                        <img src="{{$vehicle->mainImage->file}}" class="img-fluid" alt="Image" style="height:400px;" />
                    <?php } else { ?>
                        <img src="{{url('/images/vehicles/images/'.$vehicle->mainImage->file)}}" class="img-fluid img-thumbnail" alt="Image" style="height:400px;" />
                    <?php } ?>

                </dd>
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

    @if(isset($vehicle->stats))
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title text-muted pt-2">
                <strong>Stats</strong>
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

    @if(isset($vehicle->features))
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title text-muted pt-2">
                <strong>Features</strong>
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
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Colour Name</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->features->colour !!} </dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Colour</dt>
                <dd class="col-sm-8 text-muted">
                    <div class="img-thumbnail" style="background-color: <?php echo $vehicle->features->colour_code; ?>; width: 100px; height:40px; border: 2px solid #fff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); text-align: center;">

                    </div>
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Persons</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->features->persons !!} </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Gear Box</dt>
                <dd class="col-sm-8 text-muted">{!! $vehicle->features->gear_box !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>
    @endif

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title text-muted pt-2">
                <strong>Pricing</strong>
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
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">1-2 Days ( $ per/day )</dt>
                <dd class="col-sm-8 text-muted">
                    @if(isset($vehicle->package1->rate))
                    {!! $vehicle->package1->rate !!}
                    @else
                    N/A
                    @endif
                </dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">3-4 Days ( $ per/day )</dt>
                <dd class="col-sm-8 text-muted">
                    @if(isset($vehicle->package2->rate))
                    {!! $vehicle->package2->rate !!}
                    @else
                    N/A
                    @endif
                </dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">5+ Days ( $ per/day )</dt>
                <dd class="col-sm-8 text-muted">
                    @if(isset($vehicle->package3->rate))
                    {!! $vehicle->package3->rate !!}
                    @else
                    N/A
                    @endif
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>

    @if(($vehicle->bucket1) || ($vehicle->bucket2) || ($vehicle->bucket3) || ($vehicle->bucket4))
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title text-muted pt-2">
                <strong>Attached Buckets</strong>
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
            <dl>
                @if(isset($vehicle->bucket1))
                <dt class="col-sm-3 bg-light text-muted color-palette p-2">{!! $vehicle->bucket1->bucketdetails->name !!}</dt>
                <dd class="col-sm-3 text-muted">{!! $vehicle->bucket1->rate !!} </dd>
                @endif

                @if(isset($vehicle->bucket2))
                <dt class="col-sm-3 bg-light text-muted color-palette p-2">{!! $vehicle->bucket2->bucketdetails->name !!}</dt>
                <dd class="col-sm-3 text-muted">{!! $vehicle->bucket2->rate !!} </dd>
                @endif

                @if(isset($vehicle->bucket3))
                <dt class="col-sm-3 bg-light text-muted color-palette p-2">{!! $vehicle->bucket3->bucketdetails->name !!}</dt>
                <dd class="col-sm-3 text-muted">{!! $vehicle->bucket3->rate !!} </dd>
                @endif

                @if(isset($vehicle->bucket4))
                <dt class="col-sm-3 bg-light text-muted color-palette p-2">{!! $vehicle->bucket4->bucketdetails->name !!}</dt>
                <dd class="col-sm-3 text-muted">{!! $vehicle->bucket4->rate !!} </dd>
                @endif
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>
    @endif
</section>

@endsection
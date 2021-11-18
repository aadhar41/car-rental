@extends('layouts.app')

@section('content')

<form action="{{ route('admin.vehicle.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
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
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="name">Vehicle Name</label>
                            <input type="text" name="name" value="{{ old('name', $vehicle->name) }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Vehicle Name" autocomplete="off" />
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="vehicle_brand">Vehicle Brand:</label>
                            <select name="vehicle_brand" id="vehicle_brand" class="form-control {{ $errors->has('vehicle_brand') ? 'is-invalid' : '' }}">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ (old("vehicle_brand", $vehicle->brand_id) == $brand->id ? "selected":"") }}> {{ $brand->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('vehicle_brand'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('vehicle_brand') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="vehicle_logo">Vehicle Logo</label>
                            <input type="file" name="vehicle_logo" id="vehicle_logo" class="form-control {{ $errors->has('vehicle_logo') ? 'is-invalid' : '' }}" />
                            @if(isset($vehicle->logoFile->file))
                            <?php if (str_contains($vehicle->logoFile->file, 'unsplash') || str_contains($vehicle->logoFile->file, 'lorempixel') || str_contains($vehicle->logoFile->file, 'placeholder') || str_contains($vehicle->logoFile->file, 'robohash')) {  ?>
                                <img src="{{ $vehicle->logoFile->file }}" class="img-thumbnail mt-2" alt="Image" />
                            <?php } else { ?>
                                <img class="img-thumbnail mt-2" src="{{url('/images/vehicles/logos/'.$vehicle->logoFile->file)}}" style="height:150px;" alt="Logo">
                            <?php } ?>
                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{url('/images/users/default.jpg')}}" alt="Logo">
                            @endif
                            @if($errors->has('vehicle_logo'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('vehicle_logo') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="vehicle_image">Vehicle Image</label>
                            <input type="file" name="vehicle_image" id="vehicle_image" class="form-control {{ $errors->has('vehicle_image') ? 'is-invalid' : '' }}" />
                            @if(isset($vehicle->mainImage->file))
                            <?php if (str_contains($vehicle->mainImage->file, 'unsplash') || str_contains($vehicle->mainImage->file, 'lorempixel') || str_contains($vehicle->mainImage->file, 'placeholder') || str_contains($vehicle->mainImage->file, 'robohash')) {  ?>
                                <img src="{{ $vehicle->mainImage->file }}" class="img-thumbnail mt-2" alt="Image" />
                            <?php } else { ?>
                                <img class="img-thumbnail mt-2" src="{{url('/images/vehicles/images/'.$vehicle->mainImage->file)}}" style="height:150px;" alt="Logo">
                            <?php } ?>
                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{url('/images/users/default.jpg')}}" alt="Logo">
                            @endif
                            @if($errors->has('vehicle_image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('vehicle_image') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="slogan">Slogan</label>
                            <textarea name="slogan" id="slogan" rows="4" class="ckeditor-1 form-control {{ $errors->has('slogan') ? 'is-invalid' : '' }}" placeholder="Slogan">{{ old('slogan',$vehicle->slogan) }}</textarea>
                            @if($errors->has('slogan'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('slogan') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="4" class="ckeditor-1 form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description', $vehicle->description) }}</textarea>
                            @if($errors->has('description'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>



        </div>

        @if(isset($vehiclestat))
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    Vehicle Stats
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
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="engine">Engine</label>
                            <input type="text" name="engine" value="{{ old('engine', $vehiclestat->engine) }}" id="engine" class="form-control {{ $errors->has('engine') ? 'is-invalid' : '' }}" placeholder="Engine" autocomplete="off" />
                            @if($errors->has('engine'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('engine') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="power">Power</label>
                            <input type="text" name="power" value="{{ old('power', $vehiclestat->power) }}" id="power" class="form-control {{ $errors->has('power') ? 'is-invalid' : '' }}" placeholder="Power" autocomplete="off" />
                            @if($errors->has('power'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('power') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="zero_to_hundred">Zero to Hundred</label>
                            <input type="text" name="zero_to_hundred" value="{{ old('zero_to_hundred', $vehiclestat->zero_to_hundred) }}" id="zero_to_hundred" class="form-control {{ $errors->has('zero_to_hundred') ? 'is-invalid' : '' }}" placeholder="Zero to hundred" autocomplete="off" />
                            @if($errors->has('zero_to_hundred'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('zero_to_hundred') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="top_speed">Top Speed</label>
                            <input type="text" name="top_speed" value="{{ old('top_speed', $vehiclestat->top_speed) }}" id="top_speed" class="form-control {{ $errors->has('top_speed') ? 'is-invalid' : '' }}" placeholder="Top Speed" autocomplete="off" />
                            @if($errors->has('top_speed'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('top_speed') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="text" name="weight" value="{{ old('weight', $vehiclestat->weight) }}" id="weight" class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" placeholder="Weight" autocomplete="off" />
                            @if($errors->has('weight'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('weight') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>
        @endif

        @if(isset($vehiclefeature))
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    Vehicle Features
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
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="colour">Colour</label>
                            <input type="text" name="colour" value="{{ old('colour', $vehiclefeature->colour) }}" id="colour" class="form-control {{ $errors->has('colour') ? 'is-invalid' : '' }}" placeholder="colour" autocomplete="off" />
                            @if($errors->has('colour'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('colour') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="colour_code">Colour Code</label>
                            <input type="text" name="colour_code" value="{{ old('colour_code', $vehiclefeature->colour_code) }}" id="colour_code" class="form-control {{ $errors->has('colour_code') ? 'is-invalid' : '' }}" placeholder="colour_code" autocomplete="off" />
                            @if($errors->has('colour_code'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('colour_code') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="persons">Persons</label>
                            <input type="text" name="persons" value="{{ old('persons', $vehiclefeature->persons) }}" id="persons" class="form-control {{ $errors->has('persons') ? 'is-invalid' : '' }}" placeholder="Zero to hundred" autocomplete="off" />
                            @if($errors->has('persons'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('persons') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="gear_box">Gear Box</label>
                            <input type="text" name="gear_box" value="{{ old('gear_box', $vehiclefeature->gear_box) }}" id="gear_box" class="form-control {{ $errors->has('gear_box') ? 'is-invalid' : '' }}" placeholder="Top Speed" autocomplete="off" />
                            @if($errors->has('gear_box'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('gear_box') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>
        @endif
    </section>
</form>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection
@extends('layouts.app')

@section('content')

<form action="{{ route('admin.vehicle.store') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('POST') }}
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
                            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Vehicle Name" autocomplete="off" />
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
                                <option value="{{ $brand->id }}" {{ (old("vehicle_brand") == $brand->id ? "selected":"") }}> {{ $brand->name }}</option>
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
                            @if($errors->has('vehicle_logo'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('vehicle_logo') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="vehicle_image">Vehicle Image</label>
                            <input type="file" name="vehicle_image" id="vehicle_image" class="form-control {{ $errors->has('vehicle_image') ? 'is-invalid' : '' }}" />
                            @if($errors->has('vehicle_image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('vehicle_image') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="slogan">Slogan</label>
                            <textarea name="slogan" id="slogan" rows="4" class="ckeditor-1 form-control {{ $errors->has('slogan') ? 'is-invalid' : '' }}" placeholder="Slogan">{{ old('slogan') }}</textarea>
                            @if($errors->has('slogan'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('slogan') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="4" class="ckeditor-1 form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </div>
    </section>
</form>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection
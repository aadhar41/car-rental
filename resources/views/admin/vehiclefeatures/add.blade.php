@extends('layouts.app')

@section('content')

<form action="{{ route('admin.vehiclefeature.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="brand">Brand:</label>
                            <select name="brand" id="brand" class="form-control {{ $errors->has('brand') ? 'is-invalid' : '' }}">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ (old("brand") == $brand->id ? "selected":"") }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brand'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('brand') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div id="vehicle_div">
                            <div class="form-group">
                                <label for="vehicle">Vehicle :</label>
                                <select name="vehicle" id="vehicle" class="form-control {{ $errors->has('vehicle') ? 'is-invalid' : '' }}">
                                    <option value="">Select Brand First</option>
                                </select>
                                @if($errors->has('vehicle'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('vehicle') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="colour">Colour</label>
                            <input type="text" name="colour" value="{{ old('colour') }}" id="colour" class="form-control {{ $errors->has('colour') ? 'is-invalid' : '' }}" placeholder="Colour" autocomplete="off" />
                            @if($errors->has('colour'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('colour') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="colour_code">Colour Code</label>
                            <input type="text" name="colour_code" value="{{ old('colour_code') }}" id="colour_code" class="form-control {{ $errors->has('colour_code') ? 'is-invalid' : '' }}" placeholder="Colour Code" autocomplete="off" />
                            @if($errors->has('colour_code'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('colour_code') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="persons">persons</label>
                            <input type="text" name="persons" value="{{ old('persons') }}" id="persons" class="form-control {{ $errors->has('persons') ? 'is-invalid' : '' }}" placeholder="Persons" autocomplete="off" />
                            @if($errors->has('persons'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('persons') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="gear_box">Gear Box</label>
                            <input type="text" name="gear_box" value="{{ old('gear_box') }}" id="gear_box" class="form-control {{ $errors->has('gear_box') ? 'is-invalid' : '' }}" placeholder="Gear Box" autocomplete="off" />
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
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </div>
    </section>
</form>


<script>
    $(document).ready(function() {
        var brand_id = $("#brand").val();
        getbrandvehicles(brand_id);

        $('#brand').on('change', function() {
            var brand_id = this.value;
            getbrandvehicles(brand_id);
        });

        function getbrandvehicles(brand_id) {
            $.ajax({
                url: "{!! route('getbrandvehicles') !!}",
                type: "POST",
                data: {
                    brand_id: brand_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'html',
                success: function(result) {
                    $("#vehicle_div").html(result);
                    // $('#city_id').html('<option>Select City</option>');
                    // $.each(result, function(key, value) {
                    //     $("#city_id").append('<option value="' + value.id + '">' + value.city_name + '</option>');
                    // });
                    // var temps = $('#temps').val();
                    // $('#city_id').val(temps).trigger('change');
                }
            });
        }

    });
</script>
@endsection
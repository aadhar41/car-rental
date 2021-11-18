@extends('layouts.app')

@section('content')

<form action="{{ route('admin.vehiclestat.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="brand">Vehicle Brand:</label>
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
                                <label for="vehicle">Vehicle Model:</label>
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
                            <label for="engine">Engine</label>
                            <input type="text" name="engine" value="{{ old('engine') }}" id="engine" class="form-control {{ $errors->has('engine') ? 'is-invalid' : '' }}" placeholder="Engine" autocomplete="off" />
                            @if($errors->has('engine'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('engine') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="power">Power</label>
                            <input type="text" name="power" value="{{ old('power') }}" id="power" class="form-control {{ $errors->has('power') ? 'is-invalid' : '' }}" placeholder="Power" autocomplete="off" />
                            @if($errors->has('power'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('power') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="zero_to_hundred">Zero to Hundred</label>
                            <input type="text" name="zero_to_hundred" value="{{ old('zero_to_hundred') }}" id="zero_to_hundred" class="form-control {{ $errors->has('zero_to_hundred') ? 'is-invalid' : '' }}" placeholder="Zero to hundred" autocomplete="off" />
                            @if($errors->has('zero_to_hundred'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('zero_to_hundred') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="top_speed">Top Speed</label>
                            <input type="text" name="top_speed" value="{{ old('top_speed') }}" id="top_speed" class="form-control {{ $errors->has('top_speed') ? 'is-invalid' : '' }}" placeholder="Top Speed" autocomplete="off" />
                            @if($errors->has('top_speed'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('top_speed') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="    ">Weight</label>
                            <input type="text" name="weight" value="{{ old('weight') }}" id="weight" class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" placeholder="Weight" autocomplete="off" />
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
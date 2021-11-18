<div class="form-group">
    <label for="vehicle">Vehicle :</label>
    <select name="vehicle" id="vehicle" class="form-control {{ $errors->has('vehicle') ? 'is-invalid' : '' }}">
        <option value="0"> Select Vehicle</option>
        @foreach($vehicles as $vehicle)
        <option value="{{ $vehicle['id'] }}" {{ (old("vehicle") == $vehicle['id'] ? "selected":"") }}> {{ $vehicle['name'] }}</option>
        @endforeach
    </select>
</div>
<script>
    $('#vehicle').on('change', function() {
        var vehicle_id = this.value;
        getavailablebuckets(vehicle_id);
    });

    function getavailablebuckets(vehicle_id) {
        $.ajax({
            url: "{!! route('getavailablebuckets') !!}",
            type: "POST",
            data: {
                vehicle_id: vehicle_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'html',
            success: function(result) {
                $("#bucket_div").html(result);
            }
        });
    }
</script>
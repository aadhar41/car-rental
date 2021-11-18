<div class="form-group">
    <label for="bucket">Buckets :</label>
    <select name="bucket" id="bucket" class="form-control {{ $errors->has('bucket') ? 'is-invalid' : '' }}">
        <option value="">Select Bucket</option>
        @foreach($buckets as $id => $bucket)
        <option value="{{ $id }}" {{ (old("bucket") == $id ? "selected":"") }}>{{ $bucket }}</option>
        @endforeach
    </select>
    @if($errors->has('bucket'))
    <div class="invalid-feedback">
        <strong>{{ $errors->first('bucket') }}</strong>
    </div>
    @endif
</div>
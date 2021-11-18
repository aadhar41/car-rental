@extends('layouts.app')

@section('content')

<form action="{{ route('admin.membership.store') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('POST') }}
    @csrf
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.membership.list') }}" class="btn btn-primary">
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
                            <label for="name">Package Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Package Name" autocomplete="off" value="{{ old('name') }}" />
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="days">Days</label>
                            <input type="number" name="days" value="{{ old('days') }}" id="days" class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}" placeholder="Days" autocomplete="off" value="{{ old('days') }}" />
                            @if($errors->has('days'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('days') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="rate">Rate</label>
                            <input type="text" name="rate" value="{{ old('rate') }}" id="rate" class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" placeholder="Rate" autocomplete="off" value="{{ old('rate') }}" />
                            @if($errors->has('rate'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('rate') }}</strong>
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

@endsection
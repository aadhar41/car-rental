@extends('layouts.app')

@section('content')

<form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('POST') }}
    @csrf
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.brand.list') }}" class="btn btn-primary">
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
                            <label for="name">Brand Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Brand Name" autocomplete="off" value="{{ old('name') }}" />
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="brand_logo">Brand Logo</label>
                            <input type="file" name="brand_logo" id="brand_logo" class="form-control {{ $errors->has('brand_logo') ? 'is-invalid' : '' }}" />
                            @if($errors->has('brand_logo'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('brand_logo') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="brand_image">Brand Image</label>
                            <input type="file" name="brand_image" id="brand_image" class="form-control {{ $errors->has('brand_image') ? 'is-invalid' : '' }}" />
                            @if($errors->has('brand_image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('brand_image') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">
                &nbsp;
                <!-- <button type="submit" class="btn btn-primary">Add</button> -->
            </div>

        </div>

        <div class="card ">
            <div class="card-header">
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
                            <label for="heading">Heading</label>
                            <textarea name="heading" id="heading" rows="10" class="ckeditor form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}" placeholder="Heading">{{ old('heading') }}</textarea>
                            @if($errors->has('heading'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('heading') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="slogan">Slogan</label>
                            <textarea name="slogan" id="slogan" rows="10" class="ckeditor form-control {{ $errors->has('slogan') ? 'is-invalid' : '' }}" placeholder="slogan">{{ old('slogan') }}</textarea>
                            @if($errors->has('slogan'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('slogan') }}</strong>
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

@include('partials._ckeditor')

@endsection
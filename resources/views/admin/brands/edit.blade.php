@extends('layouts.app')

@section('content')

<form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
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
                            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Brand Name" autocomplete="off" value="{{ old('name', $brand->name) }}" />
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="number" name="order" id="order" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" placeholder="Order ( sequence )" autocomplete="off" value="{{ old('order', $brand->order) }}" />
                            @if($errors->has('order'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('order') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="brand_logo">Brand Logo</label>
                            <input type="file" name="brand_logo" id="brand_logo" class="form-control {{ $errors->has('brand_logo') ? 'is-invalid' : '' }}" />
                            @if(isset($brand->logoFile->file))
                            <?php if (str_contains($brand->logoFile->file, 'unsplash') || str_contains($brand->logoFile->file, 'lorempixel') || str_contains($brand->logoFile->file, 'placeholder') || str_contains($brand->logoFile->file, 'robohash')) {  ?>
                                <img src="{{ $brand->logoFile->file }}" class="img-thumbnail mt-2" alt="Image" />
                            <?php } else { ?>
                                <img class="img-thumbnail mt-2" src="{{url('/images/brands/logos/'.$brand->logoFile->file)}}" alt="Logo">
                            <?php } ?>
                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{url('/images/users/default.jpg')}}" alt="Logo">
                            @endif
                            @if($errors->has('brand_logo'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('brand_logo') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="brand_image">Brand Image</label>
                            <input type="file" name="brand_image" id="brand_image" class="form-control {{ $errors->has('brand_image') ? 'is-invalid' : '' }}" />
                            @if(isset($brand->mainImage->file))
                            <?php if (str_contains($brand->mainImage->file, 'unsplash') || str_contains($brand->mainImage->file, 'lorempixel') || str_contains($brand->mainImage->file, 'placeholder') || str_contains($brand->mainImage->file, 'robohash')) {  ?>
                                <img src="{{ $brand->mainImage->file }}" class="img-thumbnail mt-2" alt="Image" height="150" />
                            <?php } else { ?>
                                <img class="img-thumbnail mt-2" style="height: 250px;" src="{{url('/images/brands/images/'.$brand->mainImage->file)}}" alt="Logo">
                            <?php } ?>
                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{url('/images/users/default.jpg')}}" alt="Logo">
                            @endif
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
                            <textarea name="heading" id="heading" rows="10" class="ckeditor form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}" placeholder="Heading">{{ old('heading', $brand->heading) }}</textarea>
                            @if($errors->has('heading'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('heading') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="slogan">Slogan</label>
                            <textarea name="slogan" id="slogan" rows="10" class="ckeditor form-control {{ $errors->has('slogan') ? 'is-invalid' : '' }}" placeholder="slogan">{{ old('slogan', $brand->slogan) }}</textarea>
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
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>
    </section>
</form>

@include('partials._ckeditor')

@endsection
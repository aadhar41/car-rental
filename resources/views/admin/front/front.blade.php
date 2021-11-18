@extends('layouts.app')

@section('content')
<form action="{{ route('admin.front.update', $listings->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Front Page Content</h3>

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
                            <label for="herosection">Hero Section</label>
                            <textarea name="herosection" id="herosection" rows="4" class="ckeditor form-control {{ $errors->has('herosection') ? 'is-invalid' : '' }}" placeholder="Hero Section">{{ old('herosection', $listings->herosection) }}</textarea>
                            @if($errors->has('herosection'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('herosection') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="about-content-text">About Content Text</label>
                            <textarea name="aboutcontent_text" id="about-content-text" rows="10" class="ckeditor form-control {{ $errors->has('aboutcontent_text') ? 'is-invalid' : '' }}" placeholder="About Content Text">{{ old('aboutcontent_text', $listings->aboutcontent_text) }}</textarea>
                            @if($errors->has('aboutcontent_text'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('aboutcontent_text') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="about_image">About Image</label>
                            <input type="file" name="about_image" id="about_image" class="form-control" />
                            <br />
                            @if(isset($listings->aboutcontent_image))
                            <img src="{{url('/images/about/'.$listings->aboutcontent_image)}}" class="img-fluid" alt="Image" height="150" width="150" />
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="iconicdreams_h2">Iconic dreams h2</label>
                            <input type="text" name="iconicdreams_h2" value="{{ old('iconicdreams_h2', $listings->iconicdreams_h2) }}" id="iconicdreams_h2" class="form-control {{ $errors->has('iconicdreams_h2') ? 'is-invalid' : '' }}" placeholder="Iconic dreams h6" />
                            @if($errors->has('iconicdreams_h2'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('iconicdreams_h2') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="iconicdreams_h6">Iconic dreams h6</label>
                            <input type="text" name="iconicdreams_h6" value="{{ old('iconicdreams_h6', $listings->iconicdreams_h6) }}" id="iconicdreams_h6" class="form-control {{ $errors->has('iconicdreams_h6') ? 'is-invalid' : '' }}" placeholder="Iconic dreams h6" />
                            @if($errors->has('iconicdreams_h6'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('iconicdreams_h6') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="iconicdreams_p">Iconic dreams Description</label>
                            <textarea name="iconicdreams_p" id="iconicdreams_p" rows="10" class="ckeditor form-control {{ $errors->has('iconicdreams_p') ? 'is-invalid' : '' }}" placeholder="About Content Text">{{ old('iconicdreams_p', $listings->iconicdreams_p) }}</textarea>
                            @if($errors->has('iconicdreams_p'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('iconicdreams_p') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="iconicdreams_image">Iconic dreams Image</label>
                            <input type="file" name="iconicdreams_image" id="iconicdreams_image" class="form-control" />
                            <br />
                            @if(isset($listings->iconicdreams_image))
                            <img src="{{url('/images/iconicdreams/'.$listings->iconicdreams_image)}}" class="img-fluid" alt="Image" height="150" width="150" />
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
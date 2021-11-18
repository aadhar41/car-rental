@extends('layouts.app')

@section('content')

<form action="{{ route('admin.userprofile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if(isset($user->profile->image))
                                <?php if (str_contains($user->profile->image, 'unsplash') || str_contains($user->profile->image, 'lorempixel') || str_contains($user->profile->image, 'placeholder') || str_contains($user->profile->image, 'robohash')) {  ?>
                                    <img src="{{ $user->profile->image }}" class="img-fluid" alt="Image" />
                                <?php } else { ?>
                                    <img class="profile-user-img img-fluid img-circle" src="{{url('/images/users/'.$user->profile->image)}}" alt="User profile picture">
                                <?php } ?>
                                @else
                                <img class="profile-user-img img-fluid img-circle" src="{{url('/images/users/default.jpg')}}" alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{!! $user->name !!}</h3>

                            @if(isset($user->profile->title))
                            <p class="text-muted text-center mt-1">
                                {{ $user->profile->title }}
                            </p>
                            @endif

                            @if(isset($user->email))
                            <p class="text-muted text-center">
                                {!! $user->email !!}
                            </p>
                            @endif

                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            @if(isset($user->profile->education))
                            <p class="text-muted">
                                {!! $user->profile->education !!}
                            </p>
                            @else
                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>
                            @endif

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            @if(isset($user->profile->location))
                            <p class="text-muted">{!! $user->profile->location !!}</p>
                            @else
                            <p class="text-muted">
                                Malibu, California
                            </p>
                            @endif

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                            @if(isset($user->profile->skills))
                            <p class="text-muted">
                                {!! $user->profile->skills !!}
                            </p>
                            @else
                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>
                            @endif

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                            @if(isset($user->profile->note))
                            <p class="text-muted text-align-justify">{!! $user->profile->note !!}</p>
                            @else
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-muted"></h3>

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
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" autocomplete="off" value="{{ old('name', $user->name) }}" />
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" />
                                        @if($errors->has('image'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        @if(isset($user->profile->location))
                                        <input type="text" name="location" id="location" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" placeholder="Location" autocomplete="off" value="{{ old('location', $user->profile->location) }}" />
                                        @else
                                        <input type="text" name="location" id="location" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" placeholder="Location" autocomplete="off" value="{{ old('location') }}" />
                                        @endif

                                        @if($errors->has('location'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        @if(isset($user->profile->education))
                                        <textarea name="education" id="education" rows="4" class=" form-control {{ $errors->has('education') ? 'is-invalid' : '' }}" placeholder="Education">{{ old('education', $user->profile->education) }}</textarea>
                                        @else
                                        <textarea name="education" id="education" rows="4" class=" form-control {{ $errors->has('education') ? 'is-invalid' : '' }}" placeholder="Education">{{ old('education') }}</textarea>
                                        @endif
                                        @if($errors->has('education'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('education') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Profile</h3>

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
                                        <label for="title">Title</label>
                                        @if(isset($user->profile->title))
                                        <textarea name="title" id="title" rows="2" class=" form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Title">{{ old('title', $user->profile->title) }}</textarea>
                                        @else
                                        <textarea name="title" id="title" rows="2" class=" form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Title">{{ old('title') }}</textarea>
                                        @endif
                                        @if($errors->has('title'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="skills">Skills</label>
                                        @if(isset($user->profile->skills))
                                        <textarea name="skills" id="skills" rows="4" class="ckeditor form-control {{ $errors->has('skills') ? 'is-invalid' : '' }}" placeholder="Skills">{{ old('skills', $user->profile->skills) }}</textarea>
                                        @else
                                        <textarea name="skills" id="skills" rows="4" class="ckeditor form-control {{ $errors->has('skills') ? 'is-invalid' : '' }}" placeholder="Skills">{{ old('skills') }}</textarea>
                                        @endif
                                        @if($errors->has('skills'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('skills') }}</strong>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="note">Note</label>
                                        @if(isset($user->profile->note))
                                        <textarea name="note" id="note" rows="4" class="ckeditor form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" placeholder="Note">{{ old('note', $user->profile->note) }}</textarea>
                                        @else
                                        <textarea name="note" id="note" rows="4" class="ckeditor form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" placeholder="Note">{{ old('note') }}</textarea>
                                        @endif
                                        @if($errors->has('note'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('note') }}</strong>
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
                </div>

            </div>
        </div>
    </section>
</form>

@include('partials._ckeditor')

@endsection
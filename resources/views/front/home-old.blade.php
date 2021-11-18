    @include("partials._header")

    <section class="herosection">
        <!--   <video  autoplay class="w-100">
                <source src="images/videoplayback_Trim.mp4" type="video/mp4">
                <source src="images/videoplayback_Trim.ogg" type="video/ogg">
            </video> -->
        <video preload="" playsinline="" autoplay="" muted="" loop="">
            <source src="../images/videobg.mp4" type="video/mp4">
            <source src="../images/videoplayback_Trim.ogg" type="video/ogg">
            Your browser does not support the video tag.
        </video>

        <div class="container-fluid">
            <div class="row justify-content-center align-self-center">
                <div class="col-md-12">
                    {!! $data->herosection !!}
                </div>

            </div>
        </div>
        <a href="javascript:void(0);" class="downarrow"><img src="{{ asset('images/arrow.png') }}" alt="arrow"> </a>

    </section>

    <section class="aboutcontent">
        <div class="container-fluid">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6">
                    <div class="leftcontent text-left">
                        {!! Str::limit($data->aboutcontent_text, 900, $end='...') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="rightimg">
                        <img src="{{url('/images/about/'.$data->aboutcontent_image)}}" class="img-fluid" alt="Image" />
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ourexclusivegarage">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Our Exclusive <strong>Garage</strong></h2>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">


                @if(count($brands)==0)
                <div class="container p-5 text-muted col-lg-12 text-center">
                    <h1 class="display-4">Opps!</h1>
                    <p class="lead">Currently there are no brands available.</p>
                    <hr class="my-4">
                    <p>Please visit after some time.</p>
                </div>
                @else
                @foreach($brands as $brand)
                @if(isset($brand->mainImage->file))
                <div class="col-md-4">
                    <a href="{{ route('brand', $brand->slug) }}">
                        <div class="car-box">
                            <?php if (str_contains($brand->mainImage->file, 'unsplash') || str_contains($brand->logoFile->file, 'lorempixel') || str_contains($brand->logoFile->file, 'placeholder') || str_contains($brand->mainImage->file, 'robohash')) { ?>
                                <img src="{{$brand->mainImage->file}}" class="img-fluid" alt="Image" />
                            <?php } else { ?>
                                <img src="{{url('/images/brands/images/'.$brand->mainImage->file)}}" class="img-fluid" alt="Image" />
                            <?php } ?>

                            <div class="overlay">
                                <h4>{{ $brand->name }}</h4>
                                <div class="hoverbox">
                                    <img src="{{url('images/brands/logos/'.$brand->logoFile->file)}}" alt="Logo" />
                                    <span>SEE THE RANGE <i class="fa fa-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @endforeach
                @endif

            </div>

        </div>

    </section>


    <section class="iconicdreams">
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12 text-center ">
                    <h2>{!! $data->iconicdreams_h2 !!}</h2>
                    <h6>{!! $data->iconicdreams_h6 !!}</h6>
                    @if(count($brands)==0)
                    <div class="container p-5 text-muted col-lg-12 text-center">
                        <h1 class="display-4">Opps!</h1>
                        <p class="lead">Currently there are no brands available.</p>
                    </div>
                    @else
                    <ul>
                        @foreach($brands as $brand)
                        @if(isset($brand->logoFile->file))
                        @if(!isset($brand->mainImage->file))
                        <li class="css-extra">
                            <a href="{{ route('brand', $brand->slug) }}">
                                <?php if (str_contains($brand->logoFile->file, 'unsplash') || str_contains($brand->logoFile->file, 'placeholder') || str_contains($brand->logoFile->file, 'robohash') || str_contains($brand->logoFile->file, 'lorempixel')) { ?>
                                    <img src="{{ $brand->logoFile->file }}" class="img-fluid" alt="Image" />
                                <?php } else { ?>
                                    <img src="{{url('/images/brands/logos/'.$brand->logoFile->file)}}" alt="Logo" />
                                <?php } ?>
                            </a>
                        </li>
                        @else
                        <li class="css-main">
                            <a href="{{ route('brand', $brand->slug) }}">
                                <?php if (str_contains($brand->logoFile->file, 'unsplash') || str_contains($brand->logoFile->file, 'placeholder') || str_contains($brand->logoFile->file, 'robohash') || str_contains($brand->logoFile->file, 'lorempixel')) { ?>
                                    <img src="{{ $brand->logoFile->file }}" class="img-fluid" alt="Image" />
                                <?php } else { ?>
                                    <img src="{{url('/images/brands/logos/'.$brand->logoFile->file)}}" alt="Logo" />
                                <?php } ?>
                            </a>
                        </li>
                        @endif
                        @endif
                        @endforeach
                    </ul>
                    @endif
                    {!! Str::limit($data->iconicdreams_p, 900, $end='...') !!}
                </div>
            </div>
            <div class="carimg">
                <img src="{{url('/images/iconicdreams/'.$data->iconicdreams_image)}}" class="img-fluid" alt="Image" />
            </div>
        </div>
    </section>

    <!-- testimonials -->
    <section class="whychoose">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h2>Why Choose <span>Gall Exotics?</span></h2>
                </div>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="iconbox">
                            <img src="images/caricon.png" alt="">
                        </div>
                        <h4>Latest Vehicles</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <div class="col-md-3 text-center">
                        <div class="iconbox">
                            <img src="images/staricon.png" alt="">
                        </div>
                        <h4>Best in Class Services</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <div class="col-md-3 text-center">
                        <div class="iconbox">
                            <img src="images/hearticon.png" alt="">
                        </div>
                        <h4>Client Satisfaction</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <div class="col-md-3 text-center">
                        <div class="iconbox">
                            <img src="images/guarantee-icon.png" alt="">
                        </div>
                        <h4>Services Guarantee</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- testimonials -->



    @include('partials._contactus')

    @include('partials._socialmedia')

    @include('partials._footer')
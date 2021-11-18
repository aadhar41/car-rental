    @include("partials._header")

    <section class="herosection innerbanner">
        <video preload="" playsinline="" autoplay="" muted="" loop="">
            <source src="{{ asset('images/videobg.mp4') }}" type="video/mp4">
            <source src="{{ asset('images/videoplayback_Trim.ogg') }}" type="video/ogg">
            Your browser does not support the video tag.
        </video>

        <div class="container-fluid">
            <div class="row justify-content-center align-self-center">
                <div class="col-md-12 text-center">
                    <div class="carlogo">
                        <!-- placeholder -->
                        <?php if (str_contains($brand->logoFile->file, 'unsplash') || str_contains($brand->logoFile->file, 'lorempixel') || str_contains($brand->logoFile->file, 'placeholder') || str_contains($brand->logoFile->file, 'robohash')) { ?>
                            <img src="{{ $brand->logoFile->file }}" class="img-fluid" alt="Image" />
                        <?php } else { ?>
                            <img src="{{$brand->brandLogoUrl().$brand->logoFile->file}}" alt="Logo" />
                        <?php } ?>
                    </div>
                    <h1>{!! $brand->heading !!} </h1>
                    <h5 class="text-center color-white">{!! $brand->slogan !!}</h5>
                </div>

            </div>
        </div>
        <a href="javascript:void(0);" class="downarrow">
            <img src="{{ asset('images/arrow.png') }}" alt="arrow" />
        </a>

    </section>

    <section class="aboutcontent carsingle">
        <div class="container-fluid">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6">
                    <div class="leftcontent">
                        <h2>BEHIND THE BADGE</h2>
                        <h4>Why we chose Ferrari for our Luxury Car Rentals service in Sydney</h4>
                        <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="rightimg">
                        <img src="../images/cardetailsright.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="vehicleavailable">
        <div class="headingbox text-center" style="background: url('{{ asset('images/bg-footer.jpg') }}')  top center no-repeat;">

            <h2>VEHICLES AVAILABLE</h2>
            <h4>List of current {!! $brand->name !!} vehicles available through our Luxury Car Rentals service in Sydney</h4>

        </div>
        <?php
        $vehicleCount = count($brand->associatedVehicles);
        ?>
        @if($vehicleCount==0)

        <div class="container p-5 text-muted col-lg-12 text-center">
            <h1 class="display-4">Opps!</h1>
            <p class="lead">Currently there are no vehicle available.</p>
            <hr class="my-4">
            <p>Please visit after some time.</p>
        </div>

        @else
        <div class="container-fluid">

            <div class="row">
                @foreach ($brand->associatedVehicles as $key => $vehicle)
                <div class="col-md-4">
                    <div class="car-box">
                        <div class="imgbox">
                            <?php if (str_contains($vehicle->mainImage->file, 'unsplash') || str_contains($vehicle->mainImage->file, 'lorempixel') || str_contains($vehicle->mainImage->file, 'placeholder') || str_contains($vehicle->mainImage->file, 'robohash')) { ?>
                                <img src="{{ $vehicle->mainImage->file }}" class="img-fluid" alt="Image" />
                            <?php } else { ?>
                                <img src="{{$vehicle->vehicleImageUrl().$vehicle->mainImage->file}}" alt="Image" class="img-fluid img1">
                                <img src="{{$vehicle->vehicleImageUrl().$vehicle->mainImage->file}}" alt="Image" class="img-fluid img2">
                            <?php } ?>
                            <a href="{{ route('vehicle', $vehicle->slug) }}"" class=" overlay">
                                <span>Quick View</span>
                            </a>
                        </div>

                        <p>{!! $brand->name !!}</p>
                        <a href="{{ route('vehicle', $vehicle->slug) }}"">
                            <h3>{!! $vehicle->name !!}</h3>
                        </a>
                    </div>

                </div>
                @endforeach

            </div>

        </div>
        @endif
    </section>


    <!-- testimonials -->
    <section class=" whychoose">
                            <div class="container">
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <h2>Why Choose <span>Gall Exotics?</span></h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <div class="iconbox">
                                                <img src="{{ asset('images/caricon.png') }}" alt="">
                                            </div>
                                            <h4>Latest Vehicles</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <div class="iconbox">
                                                <img src="{{ asset('images/staricon.png') }}" alt="">
                                            </div>
                                            <h4>Best in Class Services</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <div class="iconbox">
                                                <img src="{{ asset('images/hearticon.png') }}" alt="">
                                            </div>
                                            <h4>Client Satisfaction</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <div class="iconbox">
                                                <img src="{{ asset('images/guarantee-icon.png') }}" alt="">
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
    @include("partials._header")

    <section class="innerslider text-center d-flex align-items-center" style="background:url(images/carbg.png) top center no-repeat;">
        <div class="container">
            <h2>SERVICES</h2>
        </div>
    </section>

    @if($servicesCount==0)

    <div class="container p-5 text-muted col-lg-12 text-center">
        <h1 class="display-4">Opps!</h1>
        <p class="lead">Currently there are no service available.</p>
        <hr class="my-4">
        <p>Please visit after some time.</p>
    </div>

    @else

    <section class="ourexclusivegarage Servicespage">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center p-3">

                @foreach ($data as $service)
                <div class="col-md-4">
                    <div class="car-box">
                        <!-- <img src="{{ $service->image }}" class="img-fluid" alt="Image" /> -->
                        <?php if (str_contains($service->image, 'unsplash') || str_contains($service->image, 'lorempixel') || str_contains($service->image, 'placeholder') || str_contains($service->image, 'robohash')) { ?>
                            <img src="{{$service->image}}" class="img-fluid" alt="Image" />
                        <?php } else { ?>
                            <img src="{{url('/images/services/'.$service->image)}}" class="img-fluid" alt="Image" />
                        <?php } ?>
                        <div class="overlay">
                            <h4>{{ $service->name }}</h4>
                            <a href="javascript:void(0);" class="btn btn-primary">SEE MORE &nbsp;<i class="fa fa-chevron-right"></i></a>
                        </div>
                        <!--    
                                <div class="ribbon-wrapper ribbon-xl">
                                    <div class="ribbon bg-danger text-xl">
                                        New
                                    </div>
                                </div> 
                                -->
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    @endif

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

    @include('partials._servicesScripts')

    @include('partials._footer')
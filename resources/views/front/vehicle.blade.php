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
                        <?php if (str_contains($vehicle->logoFile->file, 'unsplash') || str_contains($vehicle->logoFile->file, 'lorempixel') || str_contains($vehicle->logoFile->file, 'placeholder') || str_contains($vehicle->logoFile->file, 'robohash')) {  ?>
                            <img src="{{ $vehicle->logoFile->file }}" class="img-fluid" alt="Image" />
                        <?php } else { ?>
                            <img src="{{$vehicle->vehicleLogoUrl().$vehicle->logoFile->file}}" alt="Logo" />
                        <?php } ?>
                    </div>
                    <h1>@excerpt($vehicle->name)</h1>
                    <h5 class="text-center color-white">@excerpt($vehicle->slogan) </h5>
                </div>

            </div>
        </div>
        <a href="#" class="downarrow"><img src="{{ asset('images/arrow.png') }}" alt="arrow"> </a>

    </section>

    <section class="carstats">
        <div class="container">
            @if($vehicle->stats)
            <ul>
                <li>
                    <h5>ENGINE</h5>
                    <h2 class="counter-count">{!! $vehicle->stats->engine !!}</h2>
                    <p>V10</p>
                </li>
                <li>
                    <h5>POWER</h5>
                    <h2 class="counter-count">{!! $vehicle->stats->power !!}</h2>
                    <p>kW</p>
                </li>
                <li>
                    <h5>0 - 100 km/h</h5>
                    <h2 class="counter-count">{!! $vehicle->stats->zero_to_hundred !!}</h2>
                    <p>seconds</p>
                </li>
                <li>
                    <h5>TOP SPEED</h5>
                    <h2 class="counter-count">{!! $vehicle->stats->top_speed !!}</h2>
                    <p>km/h</p>
                </li>

                <li>
                    <h5>WEIGHT</h5>
                    <h2 class="counter-count">{!! $vehicle->stats->weight !!}</h2>
                    <p>kg</p>
                </li>
            </ul>
            @else
            <ul>
                <li>
                    <h5>ENGINE</h5>
                    <h2 class="counter-count">N/A</h2>
                    <p>V10</p>
                </li>
                <li>
                    <h5>POWER</h5>
                    <h2 class="counter-count">N/A</h2>
                    <p>kW</p>
                </li>
                <li>
                    <h5>0 - 100 km/h</h5>
                    <h2 class="counter-count">N/A</h2>
                    <p>seconds</p>
                </li>
                <li>
                    <h5>TOP SPEED</h5>
                    <h2 class="counter-count">N/A</h2>
                    <p>km/h</p>
                </li>

                <li>
                    <h5>WEIGHT</h5>
                    <h2 class="counter-count">N/A</h2>
                    <p>kg</p>
                </li>
            </ul>
            @endif

        </div>
    </section>

    @if($vehicle->features)
    <section class="carfeatures">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="insidebox">
                        <div class="iconbox">
                            <img src="{{ asset('images/color.png') }}" alt="">
                        </div>
                        <div class="rtcontent">
                            <strong>COLOUR</strong>
                            <span>{!! $vehicle->features->colour !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="insidebox">
                        <div class="iconbox">
                            <img src="{{ asset('images/person.png') }}" alt="">
                        </div>
                        <div class="rtcontent">
                            <strong>Persons</strong>
                            <span>{!! $vehicle->features->persons !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="insidebox">
                        <div class="iconbox">
                            <img src="{{ asset('images/settings.png') }}" alt="">
                        </div>
                        <div class="rtcontent">
                            <strong>GEAR BOX</strong>
                            <span>{!! $vehicle->features->gear_box !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <section class="carfeatures">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="insidebox">
                        <div class="iconbox">
                            <img src="{{ asset('images/color.png') }}" alt="">
                        </div>
                        <div class="rtcontent">
                            <strong>COLOUR</strong>
                            <span>BLACK</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="insidebox">
                        <div class="iconbox">
                            <img src="{{ asset('images/person.png') }}" alt="">
                        </div>
                        <div class="rtcontent">
                            <strong>Persons</strong>
                            <span>2</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="insidebox">
                        <div class="iconbox">
                            <img src="{{ asset('images/settings.png') }}" alt="">
                        </div>
                        <div class="rtcontent">
                            <strong>GEAR BOX</strong>
                            <span>7-speed dual clutch</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="iconicdreams">
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12 text-center ">
                    <h2>@excerpt($vehicle->name)</h2>
                    @excerpt_long($vehicle->description)
                    <h3 class="my-4">PRICING</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>1 - 2 Days</th>
                                        <th>3 - 4 Days</th>
                                        <th>5+ Days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if(isset($vehicle->package1->rate))
                                            ${!! $vehicle->package1->rate !!} /days
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($vehicle->package2->rate))
                                            ${!! $vehicle->package2->rate !!} /days
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($vehicle->package3->rate))
                                            ${!! $vehicle->package3->rate !!} /days
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        @if(isset($vehicle->bucket1->bucketdetails->name))
                                        <th>
                                            {!! $vehicle->bucket1->bucketdetails->name !!}
                                        </th>
                                        @endif

                                        @if(isset($vehicle->bucket2->bucketdetails->name))
                                        <th>
                                            {!! $vehicle->bucket2->bucketdetails->name !!}
                                        </th>
                                        @endif

                                        @if(isset($vehicle->bucket3->bucketdetails->name))
                                        <th>
                                            {!! $vehicle->bucket3->bucketdetails->name !!}
                                        </th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        @if(isset($vehicle->bucket1->rate))
                                        <td>
                                            {!! $vehicle->bucket1->rate !!}
                                        </td>
                                        @endif


                                        @if(isset($vehicle->bucket2->rate))
                                        <td>
                                            {!! $vehicle->bucket2->rate !!}
                                        </td>
                                        @endif

                                        @if(isset($vehicle->bucket3->rate))
                                        <td>
                                            {!! $vehicle->bucket3->rate !!}
                                        </td>
                                        @endif

                                    </tr>
                                    <!-- <tr>
                                        <td>Mon-Fri 400klms</td>
                                        <td>Enquire Today</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Membership Discount</th>
                                        <th>1-6 day rate</th>
                                        <th>7+ day rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Silver Package</strong></td>
                                        <td style="text-align: center;">N/A</td>
                                        <td style="text-align: center;">N/A</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gold Package</strong></td>
                                        <td style="text-align: center;">N/A</td>
                                        <td style="text-align: center;">N/A</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>




                </div>
            </div>

        </div>
        <div class="carimg mb-0">
            <!-- <img src="{{ asset('images/vehicles/images/'.$vehicle->mainImage->file) }}" alt="Image" style="width: 100%; height:700px;" /> -->
            <img src="{{ asset('images/innerbanner.png') }}" alt="" class="img-fluid" />
        </div>
    </section>

    @include('partials._socialmedia')

    <a href="{{ route('vehicle', $similarVehicle->slug) }}" class="fixedcar" title="{{ $similarVehicle->name }}">
        <div class="carimg">
            <?php if (str_contains($similarVehicle->logoFile->file, 'unsplash') || str_contains($similarVehicle->logoFile->file, 'lorempixel') || str_contains($similarVehicle->logoFile->file, 'placeholder') || str_contains($similarVehicle->logoFile->file, 'robohash')) {  ?>
                <img src="{{ $similarVehicle->mainImage->file }}" class="img-fluid" alt="Image" />
            <?php } else { ?>
                <img src="{{ asset('images/vehicles/images/'.$similarVehicle->mainImage->file) }}" alt="Logo" />
            <?php } ?>
        </div>
        <i class="fa fa-chevron-right"></i>

    </a>

    @include('partials._footer')
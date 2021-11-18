<!doctype html>
<html lang="en">

@include('partials._head')

<body>
    <header class="header ">

        <div class="topbar">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="javascript:void(0);">VIP PLATINUM MEMBERSHIP <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:void(0);">GIFT CARDS</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="YOUR MAIN QUESTIONS ANSWERED HERE">
                                            FAQ
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="javascript:void(0);">Action</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Another action</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Something else here</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="javascript:void(0);"> WHO WE ARE</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="javascript:void(0);">WE ALSO DO MORE: EUROPEAN CAR SERVICE & TUNING</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="javascript:void(0);"> MAKE YOUR SPORTS CAR AN ASSET – JOIN THE TEAM</a>
                                    </li>

                                </ul>

                            </div>
                        </nav>
                        <ul>

                        </ul>

                    </div>
                </div>
            </div>

        </div>

        <div class="topmenu">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('home') }}" class="brand">
                            <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid" style="height: 140px; width: 100px;">
                        </a>
                    </div>
                    <div class="col-md-9">
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('home') }}">HOME </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">OUR EXCLUSIVE GARAGE </a>
                            </li>
                            <li>
                                <a href="{{ route('services') }}">WHAT SERVICES WE OFFER</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn btn-primary">
                                    <img src="{{ asset('images/messageicon.png') }}" alt="">
                                    <span>Chat to Us
                                        <br>
                                        Make Your Booking
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        </div>

    </header>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
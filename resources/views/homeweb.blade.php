<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Welcome</title>
    <style>
        /* :root{
            filter: invert(100%);
        } */
    </style>
  </head>
  <body>

    {{-- topbar --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">KANTIN <sup>TB</sup></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="#">Home</a>
                    <a class="nav-link" href="#">Features</a>
                    <a class="nav-link" href="#">Pricing</a>
                </div>
            </div>
            <form class="form-inline my-2 my-lg-0">
                @if (Auth::user())
                    @if (Auth::user()->id_level == 1)
                        <a href="{{ url('/adashboard') }}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</a>
                    @elseif(Auth::user()->id_level == 2)
                        <a href="{{ url('/wdashboard') }}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</a>
                    @elseif(Auth::user()->id_level == 3)
                        <a href="{{ url('/kdashboard') }}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</a>
                    @elseif(Auth::user()->id_level == 4)
                        <a href="{{ url('/odashboard') }}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</a>
                    @endif
                @else
                    <a href="{{ url('/login') }}" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</a>
                @endif
            </form>
        </nav>

    {{-- jumbotron --}}
        {{-- <div class="jumbotron jumbotron-fluid">
            <div class="container">

            </div>
        </div> --}}
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary mt-5">
            <div class="page-header-content pt-10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 aos-init aos-animate" data-aos="fade-up">
                            <h1 class="page-header-title">Wellcome to. <br> KANTIN <sup>TB</sup> Management Application</h1>
                            <p class="page-header-text mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit reprehenderit officiis qui aut dolores voluptas quo, delectus repellat ex fugit veritatis, voluptate magnam quidem deleniti consequuntur animi officia error at?</p>
                            <br>
                            @if (Auth::user())
                                @if (Auth::user()->id_level == 1)
                                    <a href="{{ url('/adashboard') }}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</a>
                                @elseif(Auth::user()->id_level == 2)
                                    <a href="{{ url('/wdashboard') }}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</a>
                                @elseif(Auth::user()->id_level == 3)
                                    <a href="{{ url('/kdashboard') }}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</a>
                                @elseif(Auth::user()->id_level == 4)
                                    <a href="{{ url('/odashboard') }}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</a>
                                @endif
                            @else
                                <a href="{{ url('/login') }}" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</a>
                            @endif
                        </div>
                        <div class="col-lg-6 d-none d-lg-block aos-init aos-animate" data-aos="fade-up" data-aos-delay="50"><img class="img-fluid" src="{{asset('img/bg/canteen.jpg')}}"></div>
                    </div>
                </div>
            </div>
            {{-- <div class="svg-border-rounded text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
            </div> --}}
        </header>

        <br>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 embed-responsive embed-responsive-16by9">
                    <video src="{{asset('video/Kantin_sehat.mp4')}}" type="video/mp4" controls></video>
                </div>
                <div class="col-sm-6">
                    <h2>Healthy Canteen</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos quasi qui temporibus nam culpa similique expedita unde ipsam ea sunt. Non reiciendis possimus quam ipsa voluptatem alias ab repellendus fuga.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h2>Maintain a distance</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos quasi qui temporibus nam culpa similique expedita unde ipsam ea sunt. Non reiciendis possimus quam ipsa voluptatem alias ab repellendus fuga.</p>
                </div>
                <div class="col-sm-6 embed-responsive embed-responsive-16by9">
                    <video src="{{asset('video/Jaga_Jarak.mp4')}}" type="video/mp4" controls></video>
                </div>
            </div>
        </div>
        <br>

        <footer>

        </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

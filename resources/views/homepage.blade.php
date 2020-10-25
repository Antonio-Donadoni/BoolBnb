@extends('layouts.no-nav-app')

@section('jumbo')
  <div class="jumbotron jumbotron-fluid" style="background-image: url('https://a0.muscache.com/pictures/18084f37-67e0-400f-bfd8-55eea0e89508.jpg')">
    <div class="container">
      <div class="row">
        <div class="jumbo-left-side col-xs-12 col-md-6">
          <div class="text">
            <h1>Riscopri l'Italia</h1>
            <p>Scopri alloggi nelle vicinanze tutti da vivere, per lavoro o svago.</p>
            <form method="post">
              <input id="jumbo-search-bar" class="" type="search" name="" value="" placeholder="Inizia la ricerca...">

              <div class="form-group" style="display:none">
                  <label for="lon">LONGITUDINE</label>
                  <br>
                  <input id="jumbo-search-lon" type="text" name="lon" value="">
              </div>
              <div class="form-group" style="display:none">
                  <label for="lat">LATITUDINE</label>
                  <br>
                  <input id="jumbo-search-lat" type="text" name="lat" value="">
              </div>
            </form>
            <a class="btn btn-light" href="#">Esplora i dintorni</a>
          </div>
        </div>
      </div>
    </div>

    <div id="jumbo-navbar">
      <div id="jumbo-link-logo" class="navbar-brand">
        <img id="jumbo-img-logo" src="{{asset('imgs/airbnb.svg')}}" width="40px" height="auto" alt="logo">
        <span id="jumbo-span-logo">Boolbnb</span>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-4 ">
        <ul>
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('flats.create') }}">Affitta un appartamento</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('flats.index') }}">Area personale</a>
            </li>
          @endguest

          {{-- Dropdown --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-bars"></i>
              {{-- If the user is logged shows his firstname --}}
              @guest
                <i class="fas fa-user"></i>
              @else
                <span>{{ Auth::user()->firstname }}</span>
              @endguest
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              {{-- If the user is a guest, he can login/register --}}
              @guest
                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Registrati') }}</a>
              {{-- If he is already logged he can logout --}}
              @else
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              @endguest

              {{-- <div class="dropdown-divider"></div> --}}

              {{-- Other links --}}
              {{-- <a class="dropdown-item" href="{{ route('flats.create') }}">Affitta un appartamento</a> --}}
              {{-- <a class="dropdown-item" href="#">Proponi un'esperienza</a>
              <a class="dropdown-item" href="#">Assistenza</a> --}}
            </div>
          </li>
        </ul>
      </div>
    </div>

  </div>
@endsection

@section('content')

  <script type="text/javascript">

    function initVue() {
      const home = new Vue({
        el: '#home',
      });
    }

    function init() {
      initVue();
    }

    $(document).ready(init);

  </script>

  <div class="container">

    <div class="text">
      <h3>Appartamenti in evidenza</h3>
    </div>

    <div id="home">
      <div class="row homepage">

        @foreach ($sponsored as $flat)

          <flatcomponent
            :title = "'{{ $flat -> title }}'"
            :desc = "'{{ $flat -> desc }}'"
            :img = "'{{ $flat -> photos -> first() -> url }}'"
            :id = "'{{ $flat -> id }}'"
          ></flatcomponent>

          {{-- <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="card">
              <img src="{{ $flat -> photos -> first() -> url }}" class="card-img-top" alt="flat-img">
              <div class="card-body">
                <h5 class="card-title">{{ $flat -> title }}</h5>
                <p class="card-text text-muted">{{ $flat -> desc }}</p>
                <a href="#" class="btn btn-primary">Visualizza</a>
              </div>
            </div>
          </div> --}}

        @endforeach
      </div>
    </div>

    {{-- {{ $sponsored -> links() }} --}}

  </div>

@endsection

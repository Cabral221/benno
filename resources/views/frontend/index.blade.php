<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ appName() }}</title>
        <meta name="description" content="@yield('meta_description', appName())">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                margin-top: 2rem;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                max-width: 800px;
                margin: 0 2rem;
                border: 1px solid red;
                padding: 2rem 2rem;
            }

            .title {
                font-size: 1.8rem;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        @stack('after-styles')

        @include('includes.partials.ga')
    </head>
    <body>
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        @include('includes.partials.announcements')
        
        <div id="app">
            <div class="flex-center position-ref">
                <div class="top-right links">
                    @auth
                        @if ($logged_in_user->isUser())
                            <a href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a>
                        @endif
    
                        <a href="{{ route('frontend.user.account') }}">@lang('Account')</a>
                    @else
                        <a href="{{ route('frontend.auth.login') }}">@lang('Login')</a>
    
                        @if (config('boilerplate.access.user.registration'))
                            <a href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
                        @endif
                    @endauth
                </div><!--top-right-->
    
                <div class="content">
    
                    <div class="m-b-md">
                       <div class="title"> Parrainage</div> 
                       <div class="title"> BENNO BOKK YAKKAR</div>
                       <div class="title"> Saint-Louis</div>
                    </div><!--title-->
    
                    @include('includes.partials.messages')

                    <div class="body">
                        <div class="card border-warning mb-3">
                            {{-- <div class="card-title">Titre du card</div> --}}
                            <div class="card-body">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae iure pariatur expedita officiis, magnam aspernatur quis nulla tenetur ab mollitia similique exercitationem perferendis maxime porro ducimus itaque cum earum est!</div>
                        </div>
    
                        <div class="form">
                            <form action="{{ route('frontend.parrainer')}}" method="POST">
                                @csrf
                                <fieldset class="fieldset">
                                    <legend>Parrainage</legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">Prénom</label>
                                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Ex : Mansour">
                                                @error('first_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name">Nom</label>
                                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Ex : Faye">
                                                @error('last_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nce">Numéro de la carte d'electeur</label>
                                                <input type="number" name="nce" id="nce" class="form-control @error('nce') is-invalid @enderror" placeholder=" Ex: 000 000 000">
                                                @error('nce')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nin">Numéro d'identification national</label>
                                                <input type="number" name="nin" id="nin" class="form-control @error('nin') is-invalid @enderror" placeholder="Ex : 0 000 0000 000000">
                                                @error('nin')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="taille">Taille de l'electeur (en cm)</label>
                                                <input type="number" name="taille" id="taille" class="form-control @error('taille') is-invalid @enderror" placeholder="Ex : 123">
                                                @error('taille')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- <div class="input-group">
                                                <input type="tel" class="form-control">
                                                <span class="input-group-addon">Tel</span>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="phone">Téléphone</label>
                                                <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Ex : 70 000 00 00">
                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="form-group ml-0 mr-0">
                                                <button type="submit" class="btn btn-block btn-success">Soumettre</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div><!-- Body -->
    
                    {{-- <div class="links">
                        <a href="http://laravel-boilerplate.com" target="_blank"><i class="fa fa-book"></i> @lang('Docs')</a>
                        <a href="https://github.com/rappasoft/laravel-boilerplate" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                    </div><!--links--> --}}
                </div><!--content-->
            </div><!--app-->
        </div>

        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>

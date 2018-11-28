<div class="container">
    <div class="row">
        <div class="col">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary rounded">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse w-100" id="navbarNav">
                    {{--@if(Auth::guard('alumno')->check())--}}
                    <div class="row w-100">
                        <div class="col-11">
                            <h3 class="text-white text-left">@yield('navbarTitle')</h3>
                        </div>
                        <div class="col mt-2 text-right">
                            <a href="{{route('logout')}}">
                                <i class="fas fa-sign-out-alt font-size-1_5 text-white"></i>
                            </a>
                        </div>
                    </div>
                    {{--@endif--}}
                </div>
            </nav>
        </div>
    </div>
</div>
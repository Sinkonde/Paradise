@include('nav.sidenav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/tippy.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

    {{-- tippy --}}
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ asset('css/fontisto.css') }}" rel="stylesheet">
    @livewireStyles
    <title>{{config('app.name')}}</title>
</head>
<body  class="w-100 bg-gray-100 md:bg-gray-50 flex justify-between" x-data={nav:false,showCard:false}>
    {{-- side nav --}}
    <div class="hidden h-screen w-full md:w-2/12 bg-black md:sticky top-0 md:flex flex-col">
        @yield('sidenav')
    </div>

    <div class="h-screen w-full md:w-2/12 bg-black md:sticky top-0 fixed md:hidden flex-col" x-show="nav" @click="nav=false">
        @yield('sidenav')
    </div>

    {{-- main part --}}
    <div class="w-full md:w-10/12">
        <div class="w-full py-3 px-4 bg-white text-gray-500 shadow sticky top-0 flex justify-between font-thin z-50">
            <div class="flex overflow-hidden truncate">
                <a href="{{url()->previous()}}">
                    <div  title="Click to go back">
                        <svg class="hover:text-blue-700 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                </a>
                <div class="flex ml-5 overflow-hidden truncate pr-10">
                    @yield('title')
                </div>
            </div>
            <div class="flex">
                <div class="flex">
                    @yield('navs')
                </div>
                <div class="hidden md:flex md:ml-5" title="{{Auth::user()->first_name}}" @click="showCard=true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex md:hidden text-lg">
                    <i class="fi fi-nav-icon"  @click="nav=true"  @click.away="nav=false"></i>
                </div>
            </div>

            <div x-show="showCard" @click.away="showCard=false" class="hidden absolute md:flex flex-col rounded z-50 shadow-lg border right-2 mt-8 bg-white divide-y w-1/6">
                <a title="View my profile" href="{{route('users.show', Auth::user()->id)}}" class="px-2 py-1">My Profile</a>
                <a class="px-2 py-1 cursor-pointer hover:bg-gray-50" href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
            </div>
        </div>

        <div class="px-4">
            @yield('contents')
        </div>
    </div>
    @livewireScripts
</body>
</html>

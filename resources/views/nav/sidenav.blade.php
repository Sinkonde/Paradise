@include('nav.links')
@section('sidenav')
{{-- <script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script> --}}
    <div class="py-3 px-4 bg-gray-900 text-gray-200 font-bold overflow-hidden truncate text-center sticky top-0">
        The School Logo
    </div>


    <div class="flex flex-col flex-grow bg-gray-700 justify-between">
        <div class="flex flex-col">
            <div class="logo w-2/3 my-5 flex mx-auto">
                <img src="{{asset('img/logo3.png')}}" />
            </div>

            <div class="logo w-full mt-8 mx-auto flex flex-col text-center text-gray-400 overflow-hidden truncate" x-data={dropDown:null} @click.away="dropDown=null">

                <a href="{{route('home')}}">
                    <div class="flex justify-between hover:text-gray-200 px-3">
                        <div class="flex cursor-pointer mb-4 items-center">
                            <svg class="w-6 h-6 items-center" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="ml-2">Home</span>
                        </div>
                    </div>
                </a>

                <div class="flex justify-between hover:text-gray-200 px-3 mb-4">
                    <div class="flex cursor-pointer items-center" @click="dropDown='administration'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                        <span class="ml-2">Administration</span>
                    </div>
                    <div class=" text-xs pt-2">
                        <span class="fi fi-angle-right"></span>
                    </div>
                </div>

                <div class="text-xs text-white bg-gray-900 mb-6 -mt-2" id="administration" x-show="dropDown=='administration'">
                </div>

                <div class="flex justify-between hover:text-gray-200 px-3" @click="dropDown='academic'">
                    <div class="flex cursor-pointer mb-4 items-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                        <span class="ml-2">Academic</span>
                    </div>
                    <div class=" text-xs pt-2">
                        <span class="fi fi-angle-right"></span>
                    </div>
                </div>
                <div class="text-xs text-white bg-gray-900 mb-6 -mt-2" id="academic" x-show="dropDown=='academic'">
                </div>

                <div class="flex justify-between hover:text-gray-200 px-3" id="accountant">
                    <div class="flex cursor-pointer mb-4 items-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="ml-2">Accountant</span>
                    </div>
                    <div class=" text-xs pt-2">
                        <span class="fi fi-angle-right"></span>
                    </div>
                </div>

            </div>
        </div>

        {{-- bottom nav --}}
        <div class="flex justify-between p-3 bg-gray-800">
        </div>
    </div>
    @yield('links')
@endsection

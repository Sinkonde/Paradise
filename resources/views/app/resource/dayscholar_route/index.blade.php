@extends('index')
@section('contents')
    <div class="w-100 flex justify-center ">
        <div class="w-full flex flex-col py-4 bg-white shadow">
            <div class="w-full px-4 hidden md:flex text-sm">
                @if (count($routes) == 0)
                    <p class="text-2xl font-semibold">Nothing to list</p>
                @else
                <table class="w-full">
                    <thead>
                        <tr class=" border-b border-gray-100">
                            <th class="pb-4">SN</th>
                            <th class="pb-4 text-left">Route</th>
                            <th class="pb-4 text-left">This Year</th>
                            <th class="pb-4 text-left">Fees Per Year</th>
                            <th class="pb-4 text-left"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-50">
                        @foreach ($routes as $route)
                            <tr class="hover:bg-gray-50">
                                <td class="py-1 text-center">{{$loop->iteration}}</td>
                                <td class="py-1">
                                    <div class="flex flex-col">
                                        <p class="text-lg">{{title($route->name)}}</p>
                                        <p class="text-xs text-cool-gray-500">{{Str::ucfirst($route->description)}}</p>
                                    </div>
                                </td>
                                <td class="py-1" title="Make available in this year">
                                    @if ($route->route_year($academic_year->id)->count()==0)
                                        <form action="{{route('route-years.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="academic_year_id" value="{{$academic_year->id}}" />
                                            <input type="hidden" name="dayscholar_route_id" value="{{$route->id}}" />
                                            <button class="text-xs rounded border border-yellow-500 text-yellow-600 bg-yellow-50 px-4">Use it</button>
                                        </form>
                                    @else
                                        <span class="">Yes, in use. <a title="View plan" class="text-blue-600 hover:underline" href="route()">View Plan</a></span>
                                    @endif
                                </td>
                                <td class="py-1" title="Create Plan">
                                    @if ($route->route_year($academic_year->id)->count()>0)
                                    <button class="text-xs rounded border border-blue-500 text-blue-400 hover:bg-blue-50 px-4">Create Plan</button>
                                    @endif

                                </td>
                                <td class="py-1 flex flex-row">
                                    <a class="mr-2 text-blue-400 hover:underline hover:text-blue-600" href="{{route('routes.edit', $route->id)}}">Edit</a>
                                        <form action="{{route('routes.destroy', ['route' =>$route->id])}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            <button class="cursor-pointer hover:underline text-red-300 hover:text-red-500" role="button">Delete</button>
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

    <a title="Create new route" href="{{route('routes.create',['callback' => route('routes.index')])}}" class="absolute bottom-4 right-4">
        <button class="rounded-full p-2 bg-yellow-500 text-white hover:bg-yellow-600 shadow hover:shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </button>
    </a>
@endsection

@section('title')
    <p class="text-lg text-gray-600 font-thin">All Routes <span>({{$routes->count()}} routes)</span></p>
@endsection

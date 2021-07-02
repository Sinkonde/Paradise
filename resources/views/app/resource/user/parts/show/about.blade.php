@section('about')
@php
    $my_roles=[];
@endphp
<div class="w-full md:space-x-2 flex flex-col md:flex-row">
    <div class="w-full md:w-8/12 rounded border divide-y px-4 bg-white">
        <div class="flex justify-between py-4">
            <div>
                <p class="text-xs text-gray-400">Name</p>
                <p class="text-lg text-gray-600">{{ucwords(strtolower($user->first_name.' '.$user->second_name.' '.$user->sur_name))}}</p>
            </div>
            <div class="flex items-center">
                <a href="{{route('users.edit', $user->id)}}" class="text-blue-400 hover:underline">Edit info</a>
            </div>
        </div>
        <div class="flex flex-col py-4">
            <p class="text-xs text-gray-400">Gender</p>
                <p class="text-lg text-gray-600">
                    @if ($user->gender == 'm')
                        Male
                    @else
                        Female
                    @endif
                </p>
        </div>
        <div class="flex flex-col py-4">
            @if ($user->email)
                <div class="flex justify-between">
                    <div>
                        <p class="text-xs text-gray-400">Email</p>
                        <p class="text-lg text-gray-600">{{strtolower($user->email)}}</p>
                    </div>
                    @if (Auth::user()->id != $user->id)
                        <div class="flex items-center">
                            @if ($user->password)
                                <a title="From using the system" onclick="blockUser('{{$user->first_name.' '.$user->second_name}}')" href="#" class="text-red-500 hover:text-red-600 hover:bg-red-50 rounded-full px-3 py-1">Block</a>
                                @php
                                    $for = 'block_'.$user->id.csrf_token();
                                @endphp
                            @else
                                <a title="Of using the System" href="#" onclick="grantUser('{{$user->first_name.' '.$user->second_name}}')" class="text-green-500 hover:text-green-600 hover:bg-green-50 rounded-full px-3 py-1">Grant Access</a>
                                @php
                                    $for = 'grant_'.$user->id.csrf_token();
                                @endphp
                            @endif
                        </div>

                        <form id="userBlockGrant" action="{{route('users.update', $user->id)}}" method="post" class="hidden">
                            @csrf
                            {{method_field('patch')}}
                            <input type="hidden" name="for" value="{{$for}}" />
                        </form>
                    @endif
                </div>
            @else
                <p class="text-xs text-gray-400">Email</p>
                <p class="text-lg text-gray-600">&mdash;</p>
            @endif

        </div>

        <div class="flex justify-between py-4">
            <div class="flex flex-col">
                <p class="text-xs text-gray-400 mb-2">Roles</p>
                <div class="text-lg text-gray-600 flex flex-row">
                    @if ($user->roles)
                    @foreach ($user->roles as $role)
                        <span ondblclick="deleteRole('{{$role->name}}')" title="Double click to remove this role" class="mr-1 bg-green-50 text-green-700 text-xs rounded-full px-2 py-1 hover:bg-green-100 hover:text-green-800 cursor-pointer">{{$role->name}}</span>
                        @php
                            array_push($my_roles, $role->name)
                        @endphp
                    @endforeach
                    @endif

                    <form id="deleteRole" hidden action="{{route('users.store')}}"  method="post">
                        @csrf
                        <input name="role" id="roleValue" value="" />
                        <input name="user_id" value="{{$user->id}}" />
                        <input name="action" value="deleteRole" />
                    </form>
                </div>
            </div>
            <div x-data={form:false} class="@if (count($roles)==count($my_roles)) hidden @endif">
                <button @click="form=!form" class="rounded text-white bg-blue-400 hover:bg-blue-500 text-xs py-1 px-3">Add</button>
                <form @click.away="form=false" x-show="form" method="post" action="{{route('users.store')}}" class="text-left shadow border p-2 absolute rounded bg-white mt-2">
                    @csrf
                    <p class="text-sm mb-2 text-gray-500 font-thin">Choose Role</p>
                    <input type="hidden" value="{{$user->id}}" name="user_id" />
                    <input type="hidden" value="role" name="store" />
                    <select class="w-full font-thin border rounded bg-gray-50 mb-2 text-gray-500 focus:text-gray-700 text-xs" name="role">
                        @foreach ($roles as $role)
                            @if (!in_array($role->name, $my_roles))
                                <option value="{{$role->name}}">{{ucwords($role->name)}}</option>
                            @endif
                        @endforeach
                    </select>
                    <button class="text-xs w-full rounded bg-blue-300 hover:bg-blue-200 text-white">Okay</button>
                </form>
            </div>
        </div>
    </div>

    <div class="w-full md:w-4/12 md:px-2 mt-4 md:mt-0">
        @if (count($user->phones))
        <div class="w-full bg-white rounded border">
            <div class="pb-4 border-b border-gray-400 px-2 pt-4 text-lg font-semibold">Phones</div>
            <div class="divide-y">
                @if ($user->phones)
                    @foreach ($user->phones as $phone)
                        <div class="flex justify-between p-2">
                            <p>{{$phone->phone}}</p>
                            <a href="{{route('user-phones.edit', $phone->id)}}" class="text-blue-400 hover:underline">Edit</a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    function blockUser(name){
        event.preventDefault();
        if (confirm('Are you sure want to block '+name+' from using the system?')) {
            document.getElementById('userBlockGrant').submit();
        }
    }

    function grantUser(name){
        event.preventDefault();
        if (confirm('Are you sure want to Grant '+name+' access of from using this system?')) {
            document.getElementById('userBlockGrant').submit();
        }
    }

    function deleteRole(roleName){
        event.preventDefault();
        if (confirm('Are you sure want to delete '+roleName+' from this user?')) {
            document.getElementById('roleValue').value = roleName;
            document.getElementById('deleteRole').submit();
        }
    }
</script>
@endsection

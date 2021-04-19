@section('about')
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
                                <a href="#" onclick="grantUser('{{$user->first_name.' '.$user->second_name}}')" class="text-green-500 hover:text-green-600 hover:bg-green-50 rounded-full px-3 py-1">Grant Access</a>
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
</script>
@endsection

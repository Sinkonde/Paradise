@section('links')
<div class="block md:hidden">
    <div id="for_academic">
            @foreach ([['name'=>'students', 'link'=>'students'], ['name'=>'classes', 'link'=>'classes',], ['name'=>'teachers', 'link'=>'teachers', 'secure'=>""], ['name'=>'subjects', 'link'=>'subjects', 'secure'=>""], ['name'=>'exams', 'link'=>'exams', 'secure'=>""],['name'=>'reports', 'link'=>'student-reports']] as $link)
                @if (isset($link['secure']))
                    @can('view link')
                        <a class="pl-11 text-left block py-2 md:px-4 md:py-1 hover:bg-gray-800 text-teal-500 hover:text-teal-400 mdtext-sm text-md" href="{{route($link['link'].'.index')}}">{{ucfirst($link['name'])}}</a>
                    @endcan
                @else
                    <a class="pl-11 text-left block py-2 md:px-4 md:py-1 hover:bg-gray-800 text-teal-500 hover:text-teal-400 mdtext-sm text-md" href="{{route($link['link'].'.index')}}">{{ucfirst($link['name'])}}</a>
                @endif
            @endforeach
    </div>

    @hasanyrole('admin')
    <div id="for_administration">
        @foreach ([['name'=>'staff', 'link'=>'workers','query'=>null, 'secure'=>""],['name'=>'parents', 'link'=>'users', 'query'=>'view=parents', 'secure'=>""],['name'=>'users', 'link'=>'users','query'=>null, 'secure'=>""],['name'=>'depertments', 'link'=>'depertments','query'=>null, 'secure'=>""]] as $link)
            @if (isset($link['secure']))
                @can('view link')
                    <a class="pl-11 text-left block py-2 md:px-4 md:py-1 hover:bg-gray-800 text-teal-500 hover:text-teal-400 mdtext-sm text-md" href="{{route($link['link'].'.index')}}">{{ucfirst($link['name'])}}</a>
                @endcan
            @else
                <a class="pl-11 text-left block py-2 md:px-4 md:py-1 hover:bg-gray-800 text-teal-500 hover:text-teal-400 mdtext-sm text-md" href="{{route($link['link'].'.index')}}">{{ucfirst($link['name'])}}</a>
            @endif
        @endforeach
    </div>
    @endhasanyrole
</div>

<script>
    ['administration', 'academic'].forEach(element => {
        //var contents = document.getElementById('for_'+element);
        document.getElementById(element).innerHTML = document.getElementById('for_'+element).innerHTML;
        //element.innerHTML = ;
        //alert(contents.innerHTML)
        // tippy('#'+element, {
        //         content: contents.innerHTML,
        //         placement:'right',
        //         allowHTML:true,
        //         interactive:true,
        //         theme:'light',
        //         delay:[250,200]
        //         });
    });
</script>
@endsection

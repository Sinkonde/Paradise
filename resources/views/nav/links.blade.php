@section('links')
<div class="hidden">
    <div id="for_academic">
            @foreach ([['name'=>'students', 'link'=>'students'], ['name'=>'classes', 'link'=>'classes'], ['name'=>'teachers', 'link'=>'teachers'], ['name'=>'subjects', 'link'=>'subjects'], ['name'=>'exams', 'link'=>'exams'],['name'=>'reports', 'link'=>'student-reports']] as $link)
                <a class="pl-11 text-left block px-4 py-1 hover:bg-gray-800 text-teal-500 hover:text-teal-400 text-sm" href="{{route($link['link'].'.index')}}">{{ucfirst($link['name'])}}</a>
            @endforeach
    </div>

    <div id="for_administration">
        @foreach ([['name'=>'staff', 'link'=>'workers','query'=>null],['name'=>'parents', 'link'=>'users', 'query'=>'view=parents'],['name'=>'users', 'link'=>'users','query'=>null]] as $link)
            <a class="pl-11 text-left block px-4 py-1 hover:bg-gray-800 text-teal-500 hover:text-teal-400 text-sm" href="{{route($link['link'].'.index')}}{{__('?'.$link['query'])}}">{{ucfirst($link['name'])}}</a>
        @endforeach
    </div>
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

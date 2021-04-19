@section('total_students')
<div class="w-full flex flex-col rounded shadow  bg-white divide-y  text-center" title="Number of all students mb-4">
    <div class="w-full text-sm py-3">
        <p class="text-sm">All Registered Students</p>
    </div>
    <div class="w-full flex divide-x">
        <div class="flex flex-col items-center uppercase px-10 py-3 w-1/3">
            <p class="text-4xl">{{$totalStudents['boys']}}</p>
            <p class="text-xs">boys</p>
        </div>

        <div class="flex flex-col items-center uppercase px-10 py-3  w-1/3">
            <p class="text-4xl">{{$totalStudents['girls']}}</p>
            <p class="text-xs">girls</p>
        </div>

        <div class="flex flex-col items-center uppercase px-10 py-3  w-1/3">
            <p class="text-4xl" id="total">{{$totalStudents['girls']+$totalStudents['boys']}}</p>
            <p class="text-xs" >total</p>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
                var countUp = new CountUp('total', <?php echo $totalStudents['girls']+$totalStudents['boys'] ?>);
                countUp.start();
            }
</script>
@endsection

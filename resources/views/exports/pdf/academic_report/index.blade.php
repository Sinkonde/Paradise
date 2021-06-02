@include('exports.pdf.academic_report.title')
@include('exports.pdf.academic_report.result_footer')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ ltrim(public_path('css/app.css'), '/') }}" /> --}}
    <title>Document</title>
</head>
    <body>
        @if (isset($data['results']))
            @foreach ($data['results'] as $student => $results)
            <div style="@if(!$loop->last)page-break-after:always @endif">
                @yield('title')

                <x-academic-reort.student-info student="{{$student}}" />

                <x-academic-reort.results-table :results="$results" :report="$report" totalStudents="{{count($data['results'])}}" student="{{$student}}" />

                @yield('result_footer')
            </div>
            @endforeach
        @else
        <h3><i>No marks found!! Please ask to import them!!</i></h3>
        @endif
    </body>
</html>

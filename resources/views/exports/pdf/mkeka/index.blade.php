@include('exports.pdf.mkeka.title')
@include('exports.pdf.mkeka.top10')
@include('exports.pdf.mkeka.mkeka')
@include('exports.pdf.mkeka.summary')
@include('exports.pdf.mkeka.subs')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="page-break-after: always">
        @yield('title')
    </div>
    <div style="page-break-after: always">
        <p>A: TOP TEN STUDENTS</p>
        @yield('top10')
    </div>

    <div style="page-break-after: always">
        <p>B: RESULTS</p>
        @yield('mkeka')
    </div>

    <div style="page-break-after: always">
        <p>C: ANALYSIS</p>
        @yield('summary')
    </div>

    <div style="">
        <p>D: SUBJECTS</p>
        @yield('subs')
    </div>
</body>
</html>


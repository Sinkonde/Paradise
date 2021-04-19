
@include('exports.pdf.class.members.members')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Class {{$class->grade->name.' '.$class->stream->name}} - ({{$class->academic_year->year}})
    </title>
</head>
<body>
    
    @yield('members')
</body>
</html>

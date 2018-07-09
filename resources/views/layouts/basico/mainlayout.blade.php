<!DOCTYPE html>

<html lang="en">

 
<head>

       @include('layouts.basico.head')

     
</head>


 
<body>


@include('layouts.basico.nav')


{{--       @include('layouts.header')--}}



@yield('content')



@include('layouts.basico.footer')

@include('layouts.basico.footer-scripts')


 
</body>

</html>

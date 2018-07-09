<!DOCTYPE html>

<html lang="en">

 
<head>

       @include('layouts.basico.head2')

     
</head>


 
<body>


@include('layouts.basico.nav2')




@yield('content')


{{--@include('layouts.footer')--}}

@include('layouts.basico.footer-scripts')


 
</body>

</html>

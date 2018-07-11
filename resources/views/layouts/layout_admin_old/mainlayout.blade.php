<!DOCTYPE html>

<html lang="en">

 
<head>

       @include('layouts.layout_admin_old.head')

     
</head>


 
<body>


@include('layouts.nav')


{{--       @include('layouts.header')--}}



@yield('content')



@include('layouts.footer')

@include('layouts.footer-scripts')


 
</body>

</html>

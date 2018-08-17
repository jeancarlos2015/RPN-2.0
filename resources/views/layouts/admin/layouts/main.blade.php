@auth
<!DOCTYPE html>
<html lang="en">
@includeIf('layouts.admin.layouts.head')
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
@includeIf('layouts.admin.layouts.nav')
<div class="content-wrapper">
    @includeIf('layouts.admin.layouts.content')
    @includeIf('layouts.admin.layouts.footer')
    @includeIf('layouts.admin.layouts.scripts')
</div>
</body>
</html>
@endauth
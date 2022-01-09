<div>
    <!doctype html>
    <html lang="en">
    <head>
        <x-backend.header-layout :title="$title"/>
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- START: Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
                <x-backend.navbar-layout />
            <!-- /.navbar -->

            <!-- Start: Sidebar -->
            <x-backend.sidebar-layout :tagSubMenu="$tagSubMenu"/>
            <!-- End: Sidebar -->


            <!-- Start: Konten -->
            {{$slot}}
            <!-- End: Konten -->

            <!-- Start: Footer -->
            <x-backend.footer-layout />
        </div>
        <!-- END: ./wrapper -->
    </body>
    </html>
    <!-- START: Script -->
    <x-backend.script-layout />
    <!-- END: Script -->
</div>

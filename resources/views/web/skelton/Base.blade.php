<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    @include('web.skelton.Top')
  </head>
  <body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

    <!-- fixed-top-->
    @include('web.skelton.Nav')
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    @include('web.skelton.Side')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- ICO Token &  Distribution-->
          @yield('content')
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    @include('web.skelton.Bottom')
    
    @yield('script')
  </body>
</html>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        @include('partials._head')
    </head>

    <body>

        <div class="container">

            @include('partials._messages')

            @yield('content')

            @include('partials._footer')

        </div>

        @include('partials._javascript')

        @yield('scripts')
    </body>

</html>

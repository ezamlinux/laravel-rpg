<!DOCTYPE html>
<html class="is-clipped">
  <head>
    <title>
      {{ config('app.name') }} | RPG ADMINISTRATION
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <main id="app">
      <dashboard-component app="{{ config('app.name') }}">
    </main>

    <script src="{{ asset('js/rpg.js')}}"></script>
  </body>
</html>

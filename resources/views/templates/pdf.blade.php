<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ $title }}</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
</head>
<body id="pdf">
  <section id="header">
    @yield('header')
  </section>
  <section id="content">
    @yield('content')
  </section>
  <section id="footer">
    @yield('footer')
  </section>
</body>
</html>

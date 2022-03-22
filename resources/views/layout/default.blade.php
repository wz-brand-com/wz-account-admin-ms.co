

<html>
<head>
    <title>user wizard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>

<body style="background-color: #f3fdf3">
      
<div class="container">
   
    @yield('content')
</div>
     
</body>
  
</html>
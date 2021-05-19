<!DOCTYPE html>
<html lang="en">
<head>
    <title>Books Web App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px}
    </style>
    <style>
        body {
            padding-top: 5rem;
        }
        .navbar {
            color: #fff!important;
            background-color: #f44336!important;
        }
        button {
            color: #fff!important;
            background-color: #f44336!important;
            border: none!important;
        }
        input[type=text], select {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }

        input[type=submit] {
          width: 100%;
          color: #fff!important;
          background-color: #f44336!important;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }
    </style>
    <?= $this->renderSection('pageStyles') ?>
</head>
<body>
    <?= view('App\Views\_navbar') ?>

    <!-- Header -->
    <header class="w3-container w3-red w3-center" style="padding:128px 16p; margin-top:-24px;">
      <h1 class="w3-margin w3-jumbo">Books</h1>
    </header>

    <?= $this->renderSection('main') ?>

    <div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
        <h1 class="w3-margin w3-xlarge">TPSIT</h1>
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity">  
      <div class="w3-xlarge w3-padding-32">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
     </div>
     <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">acosta@itisrossi.vi.it</a></p>
    </footer>

    <script>
    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else { 
        x.className = x.className.replace(" w3-show", "");
      }
    }
    </script>
    <?= $this->renderSection('pageScripts') ?>
</body>
</html>
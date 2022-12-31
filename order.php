<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Snack-Bar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
		      <a class="navbar-brand" href="index.html"><span class="flaticon-pizza-1 mr-1"></span>Snack bar<br></a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="oi oi-menu"></span> Menu
		      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.html" class="nav-link">Naslovna</a></li>
	          <li class="nav-item"><a href="menu.html" class="nav-link">Menu</a></li>
	          <li class="nav-item active"><a href="order.html" class="nav-link">Narudžba</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Kontakt</a></li>
	        </ul>
	      </div>
		  </div>
	  </nav>
	  

<?php
    /*Dohvatanje parametara upita preko globalnog polja $_GET
    ...process.php??fname=&food=small_pizza&lettuce=on&pickles=on&tomato=on&mayonese=on&quantity=1
    */

    $ime=$_POST["fname"];
    $prezime= $_POST['lname'];
    $mail= $_POST['email'];
    $date=$_POST['date'];
    $jelo=$_POST["food"];
    $time=$_POST['time'];
    $kolicina=$_POST["quantity"];
    $placanje=$_POST["paying"];
    $pice=$_POST['drink'];
    
    $trenutno_vrijeme = date("Y-m-d");
    $trenutnosec=strtotime($trenutno_vrijeme);
    $narudzbasec=strtotime($date);
    $razlika= $narudzbasec-$trenutnosec;
    $dani = $razlika/86400;
 
    $now = new Datetime($time);
    $begintime = new DateTime('08:00');
    $endtime = new DateTime('16:00');
    
    $day =date('l',$narudzbasec);
 
    if($trenutnosec<$narudzbasec && $dani<5 && $day!="Sunday" && ($now >= $begintime && $now <= $endtime)){
      
        

    //Prilozi

    $prilozi=[];

    if(isset($_GET["pickles"])){
        $prilozi[]="krastavci";
    }
    if(isset($_GET["tomato"])){
        $prilozi[]="kečap";
    }
    if(isset($_GET["mayonese"])){
        $prilozi[]="majoneza";
    }
    if(isset($_GET["lettuce"])){
        $prilozi[]="salata";
    }

    $broj_priloga=count($prilozi);


    switch ($jelo) {
        case "sandwich":
            $cijena_jela =3.00;
          break;
        case "tost":
            $cijena_jela =2.50;
          break;
        case "lasagne":
          $cijena_jela =6.00;
          break;
        case "cevapi":
            $cijena_jela =7.00;
          break;
        case "small_pizza":
            $cijena_jela =3.00;
          break;
        
        default:
          echo $cijena_jela= 0;
      }

      switch ($pice) {
        case "nothing":
            $cijena_pica =0;
          break;
        case "water":
            $cijena_pica =2.00;
          break;
        case "coke":
            $cijena_pica =3.00;
          break;
        case "juice":
            $cijena_pica =3.00;
          break;
       
        
        default:
           $cijena_pica= 0;
      }
    #Kalkulacija cijena

    define("PDV_STOPA", 0.17);   #konstanta
    $kolicina=(int)$kolicina;    #pretvoba (casting) u cjelobrojni tip podataka-integer
    
          
    $cijena_prilog=0.5;         #ista cijena za sve priloge




    
    
    $narudzba=($cijena_jela+$cijena_prilog*$broj_priloga)*$kolicina + $cijena_pica;  //izmijenjeno
  
    $popust = ($cijena_jela*10)/100;
    $iznos_pdv=$narudzba*PDV_STOPA;
    $narudzba_s_pdvom=$narudzba+$iznos_pdv;
    $spopustom= $narudzba_s_pdvom - $popust;
   ?>
   <div class="col-md-12 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Ovo je Vaša narudžba!</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Naslovna</a></span> <span>Narudžba</span></p>
            </div>
<div style="width:50%" class="container-fluid">
<table  class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Ime</th>
      <td scope="col"><?php echo $ime?></t>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Prezime</th>
      <td><?php echo $prezime?></td>
      
    </tr>
    <tr>
      <th scope="row">Piće</th>
      <td><?php echo $pice?></td>
      
    </tr>
    <tr>
      <th scope="row">Cijena pića</th>
      <td><?php echo $cijena_pica."  KM"?></td>
      
    </tr>
    <tr>
      <th scope="row">Jelo</th>
      <td colspan="2"><?php echo $jelo?></td>
     
    </tr>
    <tr>
      <th scope="row">Cijena jela</th>
      <td><?php echo $cijena_jela." KM"?></td>
      
    </tr>
    <tr>
      <th scope="row">Kolicina</th>
      <td colspan="2"><?php echo $kolicina?></td>
     
    </tr>
    <tr>
      <th scope="row">Cijena bez pdva</th>
      <td colspan="2"><?php echo $narudzba." KM"?></td>
     
    </tr>
    <tr>
      <th scope="row">Cijena s pdvom</th>
      <td colspan="2"><?php echo $narudzba_s_pdvom." KM"?></td>
     
    </tr>
    <tr>
      <th scope="row">Popust</th>
      <td colspan="2"><?php if($placanje=="gotovina"){
          echo $popust." KM";}else{echo"Nema popusta";}?></td>
     
    </tr>
    <tr>
      <th scope="row">Ukupno za platiti</th>
      <th class="bg-success" colspan="2"><?php if($placanje=="gotovina"){
       echo $spopustom." KM";
   }else{
       echo $narudzba_s_pdvom."KM";
   }
 
    
       ?></th>
     
    </tr>
  </tbody>
</table>
</div>
<?php
}else{
    ?>
    <div class="col-md-12 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Vaša narudžba je odbijena!</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Naslovna</a></span> <span>Narudžba</span></p>
                <div style="margin-left:23%"class=" w-50 p-3 alert alert-danger " role="alert">
                    
            Vaša narudžba je vjerojatno odbijena zbog lošeg formatiranja vremena,
             molimo Vas provjerite je li datum narudžbe uredan
             ( ne primamo narudžbe za više od 5 dana),
              te je li vrijeme narudžbe unutar našeg radnog vremena!
</div>
            </div>
            
            <?php
}
?>


    <footer class="ftco-footer ftco-section img">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-6 col-md-8 mb-4 mb-md-4">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">O nama</h2>
              <p>Mi smo snack bar u Ljubuškom, nalazimo se preko puta policijske postaje, kod nas policajci marenduju.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          
          
          
          <div class="col-lg-6 col-md-8 mb-7 mb-md-7">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Imate li pitanja?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Hrvatskih branitelja 61, Ljubuški 88320 </span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">063-250-869</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@snackbar.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p>
  Copyright  2021  </p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>
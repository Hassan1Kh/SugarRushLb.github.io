<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugar Rush - Drinks and Sweets</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="card.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
  
    :root {
  --glow-color: hsl(186 100% 69%);
}
    *::before,
*::after {
  position: relative;
  box-sizing: border-box;
}
    .glowing-btn {
        background-color: rgba(0, 0, 0, 0.8);
  position: relative;
  color: var(--glow-color);
  cursor: pointer;
  padding: 0.35em 1em;
  border: 0.15em solid var(--glow-color);
  border-radius: 0.45em;
  perspective: 2em;
  font-family: "Raleway", sans-serif;
  font-size: 2em;
  font-weight: 900;
  letter-spacing: 0.5em;

  -webkit-box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
    0px 0px 0.5em 0px var(--glow-color);
  -moz-box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
    0px 0px 0.5em 0px var(--glow-color);
  box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
    0px 0px 0.5em 0px var(--glow-color);
  animation: border-flicker 2s linear infinite;
  width: 80%;
  margin-top: 1em;
}

.glowing-txt {
  
  margin-right: -0.8em;
  -webkit-text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3),
    0 0 0.45em var(--glow-color);
  -moz-text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3),
    0 0 0.45em var(--glow-color);
  text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3), 0 0 0.45em var(--glow-color);
  animation: text-flicker 3s linear infinite;
}

.faulty-letter {
  opacity: 0.5;
  animation: faulty-flicker 2s linear infinite;
}



.glowing-btn::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  opacity: 0;
  z-index: -1;
  background-color: var(--glow-color);
  box-shadow: 0 0 2em 0.2em var(--glow-color);
  transition: opacity 100ms linear;
}

.glowing-btn:hover {
  color: rgba(0, 0, 0, 0.8);
  text-shadow: none;
  animation: none;
}

.glowing-btn:hover .glowing-txt {
  animation: none;
}

.glowing-btn:hover .faulty-letter {
  animation: none;
  text-shadow: none;
  opacity: 1;
}

.glowing-btn:hover:before {
  filter: blur(1.5em);
  opacity: 1;
}

.glowing-btn:hover:after {
  opacity: 1;
}

@keyframes faulty-flicker {
  0% {
    opacity: 0.1;
  }
  2% {
    opacity: 0.1;
  }
  4% {
    opacity: 0.5;
  }
  19% {
    opacity: 0.5;
  }
  21% {
    opacity: 0.1;
  }
  23% {
    opacity: 1;
  }
  80% {
    opacity: 0.5;
  }
  83% {
    opacity: 0.4;
  }

  87% {
    opacity: 1;
  }
}

@keyframes text-flicker {
  0% {
    opacity: 0.1;
  }

  2% {
    opacity: 1;
  }

  8% {
    opacity: 0.1;
  }

  9% {
    opacity: 1;
  }

  12% {
    opacity: 0.1;
  }
  20% {
    opacity: 1;
  }
  25% {
    opacity: 0.3;
  }
  30% {
    opacity: 1;
  }

  70% {
    opacity: 0.7;
  }
  72% {
    opacity: 0.2;
  }

  77% {
    opacity: 0.9;
  }
  100% {
    opacity: 0.9;
  }
}

@keyframes border-flicker {
  0% {
    opacity: 0.1;
  }
  2% {
    opacity: 1;
  }
  4% {
    opacity: 0.1;
  }

  8% {
    opacity: 1;
  }
  70% {
    opacity: 0.7;
  }
  100% {
    opacity: 1;
  }
}



tbody td {
  /* 1. Animate the background-color
     from transparent to white on hover */
  background-color: rgba(255,255,255,0);
  transition: all 0.2s linear; 
  transition-delay: 0.3s, 0s;
  /* 2. Animate the opacity on hover */
  opacity: 0.6;
}
tbody tr:hover td {
  background-color: rgba(255,255,255,1);
  transition-delay: 0s, 0s;
  opacity: 1;
  font-size: 1em;
}

td {
  /* 3. Scale the text using transform on hover */
  transform-origin: center left;
  transition-property: transform;
  transition-duration: 0.4s;
  transition-timing-function: ease-in-out;
}
tr:hover td {
  transform: scale(1.1);
}







table {
  width: 100%;
  margin: 0;
  text-align: left;
}
th, td {
  padding: 0.5em;
}
.plus, .minus,.del{
  
  width: var(--space-6);
  height: var(--space-6);
  border: 1px solid var(--color-blue-500);
  border-radius: var(--round);
  background-color: var(--color-white);
}

.overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
  z-index: 1000; /* Ensure it's above other content */
}

.reservation-form {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  
}



.section {
	position: relative;
	height: 75rem;
}

.section .section-center {
	position: absolute;
	top: 50%;
	left: 0;
	right: 0;
	-webkit-transform: translateY(-50%);
	transform: translateY(-50%);
}

#booking {
	font-family: 'Lato', sans-serif;
}

.booking-form {
	background: #0f0f0f;
	max-width: 642px;
	width: 50%;
	margin: auto;
}

.booking-form .form-header {
	background-image: url('./resources/tables.jpg');
	background-size: cover;
	background-position: center;
	padding: 85px 25px 25px;
	position: relative;
	z-index: 20;
}

.booking-form .form-header::before {
	content: '';
	position: absolute;
	left: 0;
	right: 0;
	bottom: 0;
	top: 0;
	background: rgba(81, 81, 81, 0.8);
	z-index: -1;
}

.booking-form>form {
	padding: 30px;
}

.booking-form .form-header h2 {
	font-family: 'Medula One', cursive;
	margin-top: 0;
	margin-bottom: 15px;
	color: #fff;
    background:transparent;
	font-size: 58px;
	text-transform: capitalize;
}

.booking-form .form-header p {
	color: #fff;
	font-size: 18px;
}

.booking-form .form-group {
	position: relative;
	margin-bottom: 20px;
}

.booking-form .form-control {
	background-color: transparent;
	height: 45px;
	padding: 0px 20px;
	color: #fff;
	border: 2px solid rgba(255, 255, 255, 0.15);
	font-size: 16px;
	font-weight: 700;
	-webkit-box-shadow: none;
	box-shadow: none;
	border-radius: 40px;
	-webkit-transition: 0.2s all;
	transition: 0.2s all;
}

.booking-form .form-control::-webkit-input-placeholder {
	color: rgba(255, 255, 255, 0.15);
}

.booking-form .form-control:-ms-input-placeholder {
	color: rgba(255, 255, 255, 0.15);
}

.booking-form .form-control::placeholder {
	color: rgba(255, 255, 255, 0.15);
}

.booking-form .form-control:focus {
	background-color: #fff;
	color: #222;
}

.booking-form .form-control:focus::-webkit-input-placeholder {
	color: rgba(0, 0, 0, 0.3);
}

.booking-form .form-control:focus:-ms-input-placeholder {
	color: rgba(0, 0, 0, 0.3);
}

.booking-form .form-control:focus::placeholder {
	color: rgba(0, 0, 0, 0.3);
}

.booking-form input[type="date"].form-control:invalid {
	color: rgba(255, 255, 255, 0.15);
}

.booking-form input[type="date"]:focus:invalid {
	color: rgba(0, 0, 0, 0.3);
}

.booking-form select.form-control {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
}

.booking-form select.form-control+.select-arrow {
	position: absolute;
	right: 10px;
	bottom: 7px;
	width: 32px;
	line-height: 32px;
	height: 32px;
	text-align: center;
	pointer-events: none;
	color: rgba(255, 255, 255, 0.15);
	font-size: 14px;
}

.booking-form select.form-control+.select-arrow:after {
	content: '\279C';
	display: block;
	-webkit-transform: rotate(90deg);
	transform: rotate(90deg);
}

.booking-form select.form-control:focus+.select-arrow:after {
	color: rgba(0, 0, 0, 0.3);
}

.booking-form .form-label {
	color: #ff9000;
	text-transform: uppercase;
	line-height: 24px;
	height: 24px;
	font-size: 14px;
	font-weight: 400;
	margin-left: 20px;
}

.booking-form .form-btn {
	margin-top: 10px;
}

.booking-form .form-btn>button {
	color: #fff;
	background-color: #ff9000;
	font-weight: 700;
	height: 55px;
	font-size: 18px;
	border: none;
	display: block;
	text-transform: uppercase;
	width: 100%;
	border-radius: 40px;
}

@media only screen and (max-width: 1000px) {
  .section {
	position: relative;
	height: 20rem;
}
}
@media only screen and (max-width: 600px) {
  .glowing-btn{
    font-size: 1em;
  }
  .section {
	position: relative;
	height: 20rem;
}
}

</style>
</head>


<body>

<div class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a href="index.php" class="navbar-brand">Sugar Rush</a>
                    </div>

                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#menu" onclick="forworder()" >Menu</a></li>
                            <?php

                        if(isset($_SESSION['username'])){
                          echo '<li><a href="#" id="openFormBtn">Reservation</a></li>
                          <li><a href="History.php">History</a></li>';
                          }
                          ?>
                            <li><a href="#about"  onclick="forworder()">About Us</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                            <li><a href="#visit">Visit Us</a></li>
                            <!-- <li><a href="#">Contact Us</a></li>-->
                        </ul>
                        
                        <?php

                        if(isset($_SESSION['username'])){
                          echo ' <ul class="nav navbar-nav navbar-right">
                            
                          <li><a href="" class="dropdown-toggle" data-toggle="dropdown">Welcome '. $_SESSION['username'].' </a>
                              <ul class="dropdown-menu bg-dark">
                                  <li><a href="admin/logout.php" onclick="logout()">logout</a> </li>
                                  
                              </ul>';
                          }
                          else{
                            echo '<ul class="nav navbar-nav navbar-right">
                            
                            <li><a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Login / Sign Up <span class="caret"></span></a>
                                <ul class="dropdown-menu bg-dark">
                                    <li><a href="admin_login.php">Login</a></li>
                                    <li><a href="signup.php">Sign Up</a></li>
                                </ul>';
                          }
                          ?>
                        
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <header class="parallax" id="paralexo">
        
        <div class="header-content">

            <h1>Welcome to Sugar Rush</h1>
            <p>Your Sweet Treat Destination</p>
            <a href="#menu" class="cta-button" onclick="forworder()">Explore Menu</a>
        </div>
    </header>
    </div>

    


	<div class="container-fluid pl-5" id="content">
    
  <div id="reservationFormOverlay" class="overlay">
                        <div id="reservation-form" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="form-header">
							<h2>Reserve your tables</h2>
							<p>Reserve your table at our resturant.</p>
						</div>
						<form action="submit_reservation.php" method="POST">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <span class="form-label">Arrival date</span>
                <input class="form-control" type="date" name="arrival_date" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <span class="form-label">Arrival time</span>
                <input class="form-control" type="time" name="arrival_time" min="12:00" max="23:59" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <span class="form-label">Tables</span>
                <input class="form-control" type="number" name="tables" required>
                <span class="select-arrow"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <span class="form-label">Adults</span>
                <input class="form-control" type="number" name="adults" required>
                <span class="select-arrow"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <span class="form-label">Kids</span>
                <input class="form-control" type="number" name="kids" required>
                <span class="select-arrow"></span>
            </div>
        </div>
    </div>
    <input type="hidden" name="reservation_confirmed" value="1">
    <div class="form-btn">
        <button  type="submit" class="submit-btn">Reserve</button>
        <button id="closeFormBtn" type="button">Close</button>
    </div>
</form>

					</div>
				</div>
			</div>
		</div>
	</div>
                        </div>
	 <div style="padding-left: 15%;">
        <button  class='glowing-btn' id="sugarrush" onclick="btnclick('../getDataSet.php',this.id)"><span class='glowing-txt'>S<span class='faulty-letter'>u</span>gar Rush Bransh-Deirkifa</span></button>
        <button class='glowing-btn' id="hujeir" onclick="btnclick('../getDataSett.php',this.id)"><span class='glowing-txt'>H<span class='faulty-letter'>u</span>jeir Branch-Bourj Kalaway</span></button>
        <button  class='glowing-btn' id="legohouse" onclick="btnclick('../getDataSett.php',this.id)"><span class='glowing-txt' >L<span class='faulty-letter'>e</span>go Branch-Tyre</span></button>
        </div>   
    <section id="menu">
        <h2>Our Menu</h2>
        
     
    
        <div id="DIVID" class="container">
          

          <?php 
        require_once "../getDataSet.php";
        ?>  
          
          
        </div>
        <script >
    function btnclick(_url,clickedid){
      localStorage.setItem("branch",clickedid);
        $.ajax({
            url : _url,
            type : 'post',
            success: function(data) {
             $('#DIVID').html(data);
            },
            error: function() {
             $('#DIVID').text('An error occurred');
            }
        });

    }
</script>
        
        
        

    </section>

    <section id="about">
        <h2>About Us</h2>
    <p>Welcome to Sugar Rush, your ultimate destination for delightful drinks and mouthwatering sweets. At Sugar Rush, we believe in the power of sweetness to brighten your day and create lasting memories. Our story is all about passion for quality treats and a commitment to customer satisfaction.</p>

    <p>Our journey began with a small bakery in a cozy corner of town, where we crafted our first batch of delectable pastries and desserts. Over the years, we've expanded our offerings to include a wide range of treats, from artisanal chocolates to handcrafted beverages that will satisfy your sweet cravings.</p>

    <p>What sets us apart is our dedication to using only the finest ingredients. We source locally whenever possible and take pride in creating treats that are not only delicious but also made with love and care. Our team of talented bakers and baristas are always experimenting with new flavors and combinations to bring you the latest and greatest in the world of sweets.</p>

    <p>Whether you're looking for a cozy place to enjoy a cup of coffee, a special dessert for a celebration, or a unique gift for a loved one, Sugar Rush has you covered. We're more than just a sweet shop; we're a community of dessert enthusiasts who are excited to share our passion with you.</p>

    <p>Come visit us today and experience the magic of Sugar Rush. We can't wait to serve you and be a part of your sweetest moments.</p>
    </section>

<section id="contact">
    <h2>Contact Us</h2>
    <p>Have questions or need assistance? Reach out to us:</p>
    <ul>
        <li>Phone: <a href="tel:+96178954777">+961 78 954 777</a></li>
        <li>Email: <a href="mailto:info@sugarrush.com">info@sugarrush.com</a></li>
        
    </ul>
    <!-- You can also add a contact form or additional contact information here -->
</section>
<section id="visit" >
    <h2>Visit US</h2>
    <ul  style="display: flex;
    justify-content: center;
    padding: 10px;
    overflow-x: scroll;
    scrollbar-width: none;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
    -webkit-mask-size: 100%;
    mask-size: 100% ;">
        <li style="width:30%;"><a href="https://maps.app.goo.gl/nDycbVbpUCK9sVmeA"><iframe style="width:90%"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3336.429512132115!2d35.3936905!3d33.2552461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151e9b97cb6d7ac3%3A0xacddede2e38b56d1!2sSugar%20rush!5e0!3m2!1sen!2slb!4v1716280275749!5m2!1sen!2slb" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe></a></li>
        <li style="width:30%;"><a href="https://maps.app.goo.gl/mzyYjJYSoUvAE28a8"><iframe style="width:90%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3335.660416004292!2d35.4426273!3d33.2753815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151e912c67ba15e9%3A0x2c960bee760a754f!2sHujeir%20village!5e0!3m2!1sen!2slb!4v1716280477456!5m2!1sen!2slb" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </a></li>
        <li style="width:30%;"><a href="https://maps.app.goo.gl/1YsDiQtKiWbpev5J9"><iframe style="width:90%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3335.597935640317!2d35.2147866!3d33.2770168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151e7dcefa5c63c7%3A0x4d21b796caef4ea1!2sSugar%20Rush%20%2C%20Tyre!5e0!3m2!1sen!2slb!4v1716280362086!5m2!1sen!2slb" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </a></li>
    </ul>
    <!-- You can also add a contact form or additional contact information here -->
</section>


	</div>
    <button class="open-button" onclick="openForm()"><span class="glyphicon glyphicon-shopping-cart"></span></button>

<div class="form-popup" id="myForm">
  <form  class="form-container">
    <h3>Cart</h3>
    
<div id="tables">
            <table id="table">
                <thead>
                    <tr>
                   
                        <th>Item</th>
                        <th>Price</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
</div>

    <button type="submit" class="btn" id="order" >Order Now</button>
    <script type="text/javascript">
    //daddy code
    $ (document).ready(function() {
        //mama code
        $("button#order").click(function() {
            //children code
            var data = Object.entries(sessionStorage);
  var post=[];
  var total=[];
  for (let row of entries) {
    if(row[0]!="Total price"){
    
    /*for(let cell of row){
      if(sessionStorage.getItem(cell)){
        item.push(cell);
      }
      else{
        item.push(cell[0]);
        
      }
                        
    }*/
    post.push(row);
    }
    else{
      total.push(row);
    }
  }
  var branch=localStorage.getItem("branch");
            
            $.ajax({
                type: "POST",
                url: "order.php",
                dataType: 'text',
                data: {data:post ,branch:branch},
                success: function(data) {
                   alert(data);
                }
            });
        });
    });
</script>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

	<footer>
    <div class="container">
        <p>&copy; 2024 Sugar Rush. All rights reserved.</p>
    </div>
</footer>
    







    <script>
      window.onload = function () {
        localStorage.setItem("branch","sugarrush");
           if(!sessionStorage.getItem("Total price")){
          sessionStorage.setItem("Total price",0 );
        }
      };
        
      
      document.getElementById("openFormBtn").addEventListener("click", function() {
  document.getElementById("reservationFormOverlay").style.display = "block";
  document.body.classList.add("blur");
});

document.getElementById("closeFormBtn").addEventListener("click", function() {
  document.getElementById("reservationFormOverlay").style.display = "none";
  document.body.classList.remove("blur");
});



      
        function logout(){
          localStorage.clear();
          sessionStorage.clear();
        }
function minus(id){
  var update=[];
  entries = Object.entries(sessionStorage);
 var total=sessionStorage.getItem("Total price");
  if (sessionStorage.getItem(id)){
                        var values = sessionStorage.getItem(id).split(',');
    var quantity = parseInt(values[0]);
    var price = parseFloat(values[1]);
    
    var newquantity=quantity-1;
    var newprice=(price/quantity)*newquantity;
    if(newquantity == 0){
      sessionStorage.removeItem(id);
                          
    }else{
       update.push(newquantity);
    update.push(newprice);
    sessionStorage.setItem(id,update);
    }
    var newtotal=total-price+newprice;
    sessionStorage.setItem("Total price",newtotal);
   
    
                      }

                closeForm();
  openForm();
}
function plus(id){
  var total=sessionStorage.getItem("Total price");
  var update=[];
  entries = Object.entries(sessionStorage);
  if (sessionStorage.getItem(id)){
                        var values = sessionStorage.getItem(id).split(',');
    var quantity = parseInt(values[0]);
    var price = parseFloat(values[1]);
    var newquantity=quantity+1;
    var newprice=(price/quantity)*newquantity;
    update.push(newquantity);
    update.push(newprice);
    sessionStorage.setItem(id,update);
    var newtotal=total-price+newprice;
    sessionStorage.setItem("Total price",newtotal);
                      }
                      
                closeForm();
  openForm();
}
function del(id){
  var total=sessionStorage.getItem("Total price");
  if (sessionStorage.getItem(id)){
                        var values = sessionStorage.getItem(id).split(',');
    var price = parseFloat(values[1]);
    var newtotal=total-price;
    sessionStorage.setItem("Total price",newtotal);
                      }
                      
  sessionStorage.removeItem(id);
  closeForm();
  openForm();
}

function filltable(){
  var cart=[];
            // fills the form with the apropriate data
            entries = Object.entries(sessionStorage);
            // checks if there any product in the cart
            if (Object.entries(sessionStorage)!="") {
                //refer the table element in the html code
                const tbodyElement = document.getElementById('tbody');
                //create a body element
                
                var x=0;
                // loop over the data array
                for (let row of entries) {
                  
                  if(row[0]!="Total price"){
                    x++;
                    //create the table body and tr
                    const trElement = document.createElement('tr');
                    
                    const minus = document.createElement('td');
                    minus.innerHTML="<input type='button' class='minus"+x+" minus' value='-'  onclick='minus(this.id)'/>";
                   const plus = document.createElement('td');
                   plus.innerHTML="<input class='plus"+x+" plus' type='button' onclick='plus(this.id)'   value='+' />";
                   const del = document.createElement('td');
                   del.innerHTML="<input type='button' class='del"+x+" del' onclick='del(this.id)' value='X'/>"
                    //loop to fill the <td> in the tablev
                    
                      
                    for(let cell of row){
                      const item = document.createElement('td');
                      var store;
                      if(sessionStorage.getItem(cell)){
                        store=cell;
                        for(let exist of cart){
                          if(exist!=cell){
                            cart.push(cell);
                          }
                        }
                        
                        item.setAttribute("id",cell);
                         item.innerHTML = cell;
                      }
                      else{
                        item.setAttribute("id","price"+x);
                        if (sessionStorage.getItem(store)){
                        var values = sessionStorage.getItem(store).split(',');
    var quantity = parseInt(values[0]);
    var price = parseFloat(values[1]);  
    item.innerHTML = quantity + " Qty || " + price+ "$";

                      }
                        

                      }

                            trElement.appendChild(item);
                    }   
                    trElement.appendChild(minus);
                    const minusid= document.getElementsByClassName("minus"+x);
                    trElement.appendChild(plus);
                    const plusid= document.getElementsByClassName("plus"+x);
                    trElement.appendChild(del);
                    const delid= document.getElementsByClassName("del"+x);
                    tbodyElement.appendChild(trElement);
                    
                    minusid[0].setAttribute("id",row[0]);
                    
                    plusid[0].setAttribute("id",row[0]);
                    
                    delid[0].setAttribute("id",row[0]);
                  }
                }
                return(true);
}
// if the cart is empty it will show an alert 
            else{
              return(false);
                alert("Cart is Empty!!");
            }

}
       


       

        $(document).ready(function() {
            $('.menu-item').click(function() {
                var $submenu = $(this).find('.item-list');
                $('.item-list').not($submenu).slideUp();
                $submenu.slideToggle();
            });

            // Prevent submenu from closing when clicking inside the submenu
            $('.item-list').click(function(event){
                event.stopPropagation();
            });

            // Hide submenu when clicking outside the menu item or submenu
            $(document).click(function(event) { 
                if(!$(event.target).closest('.menu-item').length) {
                    $('.item-list').slideUp();
                }        
            });
        });
   
        
        
        

        function addtocart(id){
            var e = document.getElementById("quantity-select"+id);
            var item = document.querySelector(`.item-name${id}`);
            var price = document.querySelector(`.item-price${id}`);
    if (item) { // Check if item is found before accessing textContent
      var itemName = item.textContent;
    } else {
      console.error("Item with id", id, "not found.");
      // Handle the case where the item is not found (optional)
    }
    if (price) { // Check if item is found before accessing textContent
      var price = parseFloat(price.textContent);

    } 
    else {
      console.error("price with id", id, "not found.");
      // Handle the case where the item is not found (optional)
    }
        var quantity=e.value;
        price=price*parseFloat(quantity);
        var Totalprice=0;
        if(sessionStorage.getItem("Total price")){
          if(!sessionStorage.getItem(itemName)){
         Totalprice=price+parseFloat(sessionStorage.getItem("Total price"));}
         else{
          Totalprice=parseFloat(sessionStorage.getItem("Total price"));
         }
         sessionStorage.setItem("Total price",Totalprice );
        }
        else{
          sessionStorage.setItem("Total price",price );
        }
        
        
var array=[quantity,price]
        sessionStorage.setItem(itemName,array);
       
        console.log(price);
        closeForm();
  openForm();
        }

        function openForm() {
            
            var exist = filltable();
            // opens the form
           
            if(exist)
            document.getElementById("myForm").style.display = "block";
            
            

        }

       function closeForm() { 
        if(document.getElementById("tbody")!=""){
            const tbodyElement = document.getElementById("tbody");
            
                tbodyElement.innerHTML = "";
            }
           document.getElementById("myForm").style.display = "none";
           
       }

        </script>
    <script src="javascript.js"></script>

</body>
</html>

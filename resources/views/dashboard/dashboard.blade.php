<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Statistics UI Kit Flat Bootstrap responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Statistics UI Kit Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="../resources/views/dashboard/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="../resources/views/dashboard/css/style.css" type="text/css" media="all" />
<!--// css -->
<!-- font-awesome icons -->
<link href="../resources/views/dashboard/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- font -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //font -->
<script src="../resources/views/dashboard/js/jquery-1.11.3.min.js"></script>
<script src="../resources/views/dashboard/js/bootstrap.js"></script>


<script src="../resources/views/dashboard/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true   // 100% fit in a container
		});
	});
</script>

<!-- chart-grid-left -->
<link rel="stylesheet" href="../resources/views/dashboard/css/master.css">
<script src="../resources/views/dashboard/js/d3.min.js"></script>
<script src="../resources/views/dashboard/js/xcharts.min.js"></script>
<script src="../resources/views/dashboard/js/rainbow.min.js"></script>
<!-- //chart-grid-left -->
<!-- fabochart -->
<link href="../resources/views/dashboard/css/fabochart.css" rel="stylesheet" type="text/css">
<!-- //fabochart -->
<!--animate-->
<link href="../resources/views/dashboard/css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="../resources/views/dashboard/js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->

</head>
<body>
	<div class="content-top">
		<div class="container">
			<div class="logo">
				<h1 class="wow fadeInDown animated" data-wow-delay=".5s">Sharemarket Budding Investor</h1>
			</div>
			<!-- header -->
			<div class="header">
				<div class="top-navigation">
					<div class="top-nav">
						<nav class="navbar navbar-default">
							<div class="container">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">MENU						
								</button>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li><a href="#" class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>
									<li><a href="#"><i class="fa fa-bar-chart"></i> Stockmarket</a></li>
									<li><a href="#"><i class="fa fa-sort-amount-desc"></i> Leaderboard</a></li>
									<li><a href="#"><i class="fa fa-edit"></i> Account Summary</a></li>
									<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>							
								</ul>	
								<div class="clearfix"> </div>
							</div>	
						</nav>		
				  </div>
				</div>
			</div>
			<!-- //header -->
		<div class="content-grids">
				<!-- content-top-grids -->
				<div class="content-top-grids">
					<div class="col-md-4 content-left">
						<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
							<div class="skills-heading">
								<h3>Stockmarket</h3>
								
								 <ul>
                               <li>Company1</li>
                               <li>Company2</li>
                               <li>Company3</li>
                               <li>Company4</li>
                               <li>Company5</li>
							   <li>Company6</li>
							   <li>Company7</li>
							   <li>Company8</li>
							   <li>Company9</li>
                               </ul>
								
							</div>
							
				   
						</div>
              
					</div>
                  
                  <!--leaderboard main div -->
				  <div class="col-md-4 content-middle">
                  <!-- leaderboard -->
						<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
							<div class="contact-form-heading">
								<h3>leaderboard</h3>
                       
                               <ul>
                               <li>1. C</li>
                               <li>2. L</li>
                               <li>3. E</li>
                               <li>4. V</li>
                               <li>5. O</li>
							   <li>6. A</li>
							   <li>7. B</li>
							   <li>8. C</li>
							   <li>9. D</li>
                               </ul>
                               
							</div>
							
						</div>
                        
                       <!--leaderboard end--> 
				  </div>
                  
                  <!--leaderboard main div end-->
                 
					<div class="col-md-4 content-right">  
			
					<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
							<div class="skills-heading">
								<h3>Some Box</h3>
								
								<p>Some Other Details If Required</p>
								
							</div>
					</div>
					</div>

					<!-- <div class="col-md-4 content-right">  
						<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
                    
							<div class="contact-right-middle-heading wow fadeInUp animated" data-wow-delay=".5s">
								<h3>Login</h3>
							</div>
							<div class="login-info">
								<form>
									<input class="wow fadeInUp animated" data-wow-delay=".5s" type="text" class="user" name="email" placeholder="Email" required="">
									<input class="wow fadeInUp animated" data-wow-delay=".5s" type="password" name="password" class="lock" placeholder="Password">
								  <div class="forgot-top-grids">
										<div class="forgot-grid wow fadeInLeft animated" data-wow-delay=".5s">
										
                                          <ul>
												<li>
													<input type="checkbox" id="brand1" value="">
													<label for="brand1"><span></span>Remember me</label>
												</li>
										  </ul>
										</div>
                                      
										<div class="forgot wow fadeInRight animated" data-wow-delay=".5s">
											<a href="#">Forgot password?</a>
                                        </div></br>
                                         <div class="forgot wow fadeInRight animated" data-wow-delay=".5s">
											<a href="#">Register</a>
									     </div>
										<div class="clearfix"> </div>
									</div>
                                   
									<input class="wow fadeInRight animated" data-wow-delay=".5s" type="submit" name="Sign In" value="Login">
									
									<div class="login-icons wow fadeInRight animated" data-wow-delay=".5s">
									</div>
								</form>
							</div>
						</div>                 
					</div> 	 -->

                    </div> 
                </div>
		</div>	
		</div>
	</div>	
			<div class="container">
				
				<div class="col-md-4 content-left">
					<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
							<div class="skills-heading">
								<h3>Some Graph</h3>
								<ul>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
								</ul>
							</div>
					</div>
				</div>
				
				
				<div class="col-md-4 content-middle">
					<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
							<div class="skills-heading">
								<h3>Account Summary</h3>
                                
								<ul>
                                <li>Current Ballance:</li>
                                <li>Shares Bought:</li>
                                <li>Shares Sold:</li>
                                <li>Profit:</li>
                                <li>Initial Ballance: $1,000,000</li>
								</ul>
                                
							</div>
					</div>
                </div>
					
			</div>	
		
	
    
    <!-- copyright -->
				<div class="copyright wow fadeInRight animated" data-wow-delay=".5s">
					<p>© 2016 Statistics UI Kit . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></p>
				</div>
	<!-- //copyright -->
    
</body>	
</html>
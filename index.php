<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  	<meta charset="utf-8" />
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
  	<title>Coding the HTML</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<link rel="shortcut icon" href="/flash.ico">
  	<link rel="apple-touch-icon" href="/flash.png">
    <!--[if lt IE 9]>
	    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body>
<header class="container header clearfix">
		<div class="row">
				<h1 id="blog-title">
					<a href="#">
						<?php echo bloginfo( 'name' );?>
					</a>
				</h1>
				<h2 class="button" id="get-new">
					<a href="#">
						Get First Card!
					</a>
				</h2>
		</div>
</header>
<div class="content">
	<div id="mycard" class="flip-container">
			<div class="flipper">
				<div class="front">
					<div class="card-content">
						<h3 class="language category"></h3>
						<h3 class="context tag"></h3>
						<h1 class="function title">Get Started!</h1>
					</div>
				</div>
					<div class="back">
						<div class="card-content">
							<div class="post"></div>
							<div class="link">
								<a href="">Resource</a>
							</div>
						</div>
					</div>
			</div>
	</div>
</div>
<body>
<footer class="container footer">
	<?php wp_footer(); ?>
	<div id="usercontrols" class="row">
		<div id="answer" class="button grid3"><a href="#">Answer</a></div>
		<div id="save" class="button grid3"><a href="#">I Know This!</a></div>
		<div id="reject" class="button grid3"><a href="#">Save For Later</a></div>
	</div> 
</footer>
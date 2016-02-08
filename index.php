<?php
/**
 * index.php
 *
 * Here be the main and only template file for our theme
 *
 * @package flashcards 
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> >
<head>
  	<meta charset="<?php bloginfo( 'charset' ); ?>" />
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
  	<title>Coding the HTML</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<link rel="shortcut icon" href="/flash.ico">
  	<link rel="apple-touch-icon" href="/flash.png">
  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo" />
    <!--[if lt IE 9]>
	    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body>
	<header class="container header clearfix">
			<div class="row">
					<h1 id="blog-title">
						<a href="<?php echo esc_url( home_url() ); ?>">
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
		<div id="wrapper">
			<div id="js-data" class="container" aria-live="assertive">
				<!-- Our collection and single view data will be appended here -->
			</div>
		</div>
	<div id="usercontrols" class="row">
		<div id="answer" class="button"><a href="#">Answer</a></div>
		<div id="remove" class="button"><a href="#">Remove from Stack</a></div>
	</div> 
	<footer class="container footer">
		<?php wp_footer(); ?>
	</footer>
</body>
<script id="post-tmpl" type="text/template">
<div class="wrapper">
	<div class="content">
		<div id="mycard" class="flip-container">
			<div class="flipper">
				<div class="front">
					<div id="card-content">
						<div class="ajax-loader"><img src="<?php echo get_template_directory_uri() . '/spinner.svg' ?>" width="32" height="32" /></div>
						<h3 class="language category"><%= _embedded["https://api.w.org/term"][0][0].name %></h3>
						<h3 class="context tag"><%= _embedded["https://api.w.org/term"][1][0].name %></h3>
						<h1><%= title.rendered %></h1>
					</div>
				</div>
				<div class="back">
					<div class="card-content">
						<div class="post"><%= content.rendered %></div>
						<div class="extras">
							<%= flashcards_url %>
							<%= flashcards_example %>
							<%= flashcards_parameter %>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</script>
</html>
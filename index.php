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
  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo" />
  	<link href='https://fonts.googleapis.com/css?family=Roboto+Mono:300' rel='stylesheet' type='text/css'>
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
			<div id="js-data" class="container" aria-live="assertive">
				<!-- here be where the post be..... arrrrggghhh matey -->
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
						<div class="ajax-loader">
							<img src="<?php echo get_template_directory_uri() . '/assets/spinner.svg' ?>" width="32" height="32" />
						</div>
						<h3 class="language category"><%= _embedded["https://api.w.org/term"][0][0].name %></h3>
						<h3 class="context tag"><%= _embedded["https://api.w.org/term"][1][0].name %></h3>
						<h1 class="title"><%= title.rendered %></h1>
					</div>
				</div>
				<div class="back">
					<div class="card-content">
						<div class="post">
							<ul class="accordion">
								<div class="accordion-button">Summary</div>
								<div id="open-first" class="accordion-content">
									<li><%= content.rendered %></li>
								</div>
								<div class="accordion-button">Parameters</div>
								<div class="accordion-content">
									<li><%= flashcards_parameter %></li>
								</div>
								<div class="accordion-button">Example</div>
								<div class="accordion-content">
									<li><%= flashcards_example %></li>
								</div>
								<div class="accordion-button">Resource</div>
								<div class="accordion-content">
									<li><a class="resource" href="<%= flashcards_url %>">To find out more, use the interwebs.</a></li>
								</div>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</script>
</html>
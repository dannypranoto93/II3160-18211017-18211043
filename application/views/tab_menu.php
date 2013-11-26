<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html> 
<html lang="en">
	<head>
		<title></title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="http://fonts.googleapis.com/css?family=Sigmar+One:regular" rel="stylesheet" type="text/css" >
		<link href="<?php echo base_url('css/menu.css') ?>" rel="stylesheet">
	</head>
	<body>
		<header>	
			<div class="main-width">
				<h1 id="logo">ProgIn</h1>
				<nav>
					<ul>
						<li><a href="<?php echo site_url('Main/home'); ?>"><span>Home</span></a></li>
						<li><a href="<?php echo site_url('Main/sqldb'); ?>"><span>SQL db</span></a></li>
						<li><a href="<?php echo site_url('Main/csvdb'); ?>"><span>CSV db</span></a></li>				
						<li><a href="<?php echo site_url('Main/xmldb'); ?>"><span>XML db</span></a></li>
						<li><a href="<?php echo site_url('Main/htmldb'); ?>"><span>HTML</span></a></li>
						<li><a href="<?php echo site_url('Api/html_from_xml_all'); ?>"><span>Show All</span></a></li>
					</ul>
				</nav>
			</div>
		</header>
		<?php $this->load->view($page, $string) ?> 
	</body>
</html>
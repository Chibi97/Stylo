<?php 
	$links = selectMultipleRows($conn, "SELECT * FROM links");
?>

<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<div class="topbar-social">
					<a href="https://www.facebook.com/" class="topbar-social-item fab fa-facebook-f"></a>
					<a href="https://www.instagram.com/" class="topbar-social-item fab fa-instagram"></a>
					<a href="https://www.pinterest.com/" class="topbar-social-item fab fa-pinterest-p"></a>
					<a href="https://www.snapchat.com/" class="topbar-social-item fab fa-snapchat-ghost"></a>
					<a href="https://www.youtube.com/" class="topbar-social-item fab fa-youtube"></a>
				</div>

				<span class="topbar-child1">
					It's all about details.
				</span>

				<div class="topbar-child2">
					<!-- <span class="topbar-email">
						Admin linkovi, login, register
					</span> -->
				</div>
			</div>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="index.html" class="logo">
					<img src="images/icons/logo.png" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<?php foreach ($links as $link) :
							      if($link->name == "Admin panel") continue;
							?>
							<li>
								<a href='<?= $link->path ?>'><?= $link->name ?></a>
							</li>
							<?php endforeach ?>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
					  <a href="index.php?page=cart">
							<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							<span class="header-icons-noti">0</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
					 <a href="index.php?page=cart">
							<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							<span class="header-icons-noti">0</span>
						</a>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							It's all about details.
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								Admin, login, register
							</span>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="https://www.facebook.com/" class="topbar-social-item fab fa-facebook-f"></a>
							<a href="https://www.instagram.com/" class="topbar-social-item fab fa-instagram"></a>
							<a href="https://www.pinterest.com/" class="topbar-social-item fab fa-pinterest-p"></a>
							<a href="https://www.snapchat.com/" class="topbar-social-item fab fa-snapchat-ghost"></a>
							<a href="https://www.youtube.com" class="topbar-social-item fab fa-youtube"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="index.html">Home</a>
					</li>

					<li class="item-menu-mobile">
            <a href="product.html">Shop</a>
            <!-- <ul class="sub-menu">
							<li><a href="index.html">FOR HER</a></li>
							<li><a href="home-02.html">FOR HIM</a></li>
						</ul> -->
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>

					<li class="item-menu-mobile">
						<a href="product.html">Most popular items</a>
					</li>
          
					<li class="item-menu-mobile">
						<a href="about.html">About author</a>
					</li>

					<li class="item-menu-mobile">
						<a href="contact.html">Contact</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>
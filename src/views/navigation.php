<?php 
	$links = selectMultipleRows($conn, "SELECT * FROM links l INNER JOIN link_positions lp ON l.id_position = lp.id");
	$count_cart = selectMultipleRows($conn, "SELECT COUNT(*) AS num FROM shopping_cart WHERE id_user='1'");
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
				<span class="topbar-email">
					<ul>
						<?php foreach ($links as $link) :
							if ($link->position == "top-menu") : ?>
						<li><a href="<?= $link->path ?>">
								<?= $link->name ?>
							</a></li>
						<?php endif;
						endforeach; ?>
					</ul>
				</span>
			</div>
		</div>

		<div class="wrap_header">
			<!-- Logo -->
			<a href="index.html" class="logo">
				<img src="/images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Menu -->
			<div class="wrap_menu">
				<nav class="menu">
					<ul class="main_menu">
						<?php foreach ($links as $link) :
							    if($link->position == "main-menu") :
							?>
						<li>
							<a href='<?= $link->path ?>'>
								<?= $link->name ?></a>
						</li>
						<?php endif; endforeach; ?>
					</ul>
				</nav>
			</div>

			<!-- Header Icon -->
			<div class="header-icons">
				<a href="#" class="header-wrapicon1 dis-block">
					<img src="/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
				</a>

				<span class="linedivide1"></span>

				<div class="header-wrapicon2">
					<?php foreach ($links as $link) :
							if ($link->position == "icon-menu") : ?>
					<a href="<?= $link->path ?>">
						<img src="/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">
							<?= $count_cart->num ?></span>
					</a>
					<?php endif; 
							endforeach; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Header Mobile -->
	<div class="wrap_header_mobile">
		<!-- Logo moblie -->
		<a href="index.html" class="logo-mobile">
			<img src="/images/icons/logo.png" alt="IMG-LOGO">
		</a>

		<!-- Button show menu -->
		<div class="btn-show-menu">
			<!-- Header Icon mobile -->
			<div class="header-icons-mobile">
				<a href="#" class="header-wrapicon1 dis-block">
					<img src="/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
				</a>

				<span class="linedivide2"></span>

				<div class="header-wrapicon2">
					<?php foreach ($links as $link) :
						if ($link->position == "icon-menu") : ?>
					<a href="<?= $link->path ?>">
						<img src="/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">
							<?= $count_cart->num ?></span>
					</a>
					<?php endif; endforeach; ?>
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
	<div class="wrap-side-menu">
		<nav class="side-menu">
			<ul class="main-menu">
				<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
					<span class="topbar-child1">
						It's all about details.
					</span>
				</li>

				<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
					<div class="topbar-child2-mobile">
						<ul>
							<?php foreach ($links as $link) :
							if ($link->position == "top-menu") : ?>
							<li><a href="<?= $link->path ?>">
									<?= $link->name ?>
								</a></li>
							<?php endif; endforeach; ?>
						</ul>
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


				<?php foreach ($links as $link) :
						if ($link->position == "main-menu") : ?>
						  <li class="item-menu-mobile">
						  	<a href="<?= $link->path ?>">
								<?= $link->name ?>
							  </a>
							</li>
						<?php endif;
					endforeach;
				 ?>
			</ul>
		</nav>
	</div>
</header>
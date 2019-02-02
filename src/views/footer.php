	<?php 
		$cathegories = selectRows($conn, "SELECT * FROM cathegories");
		$filters = selectRows($conn, "SELECT * FROM filters");
	?>
	
	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="foo-container flex-w p-b-30">
			<div class="foo-left p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-20">
					DISCLAIMER
				</h4>

				<div class="foo-desc">
					<p class="s-text7 w-size27">This site is a project for ICT College, Web Programming PHP2 course, made for educational purposes. I don't intend to profit nor gain any rights. All rights go to their rightful owners.
					</p>

					<div class="foo-soc flex-m p-t-30">
						<a href="#" class="fs-18 color1 p-r-20 fab fa-facebook-f"></a>
						<a href="#" class="fs-18 color1 p-r-20 fab fa-instagram"></a>
						<a href="#" class="fs-18 color1 p-r-20 fab fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fab fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fab fa-youtube"></a>
					</div>
				</div>
			</div>

			<div class="foo-right">
				<div class="p-t-30 p-l-15 p-r-15 respon4">
					<h4 class="s-text12 p-b-30">
						Categories
					</h4>

					<ul>
						<?php foreach($cathegories as $cath) : ?>
						  <li class="p-b-9">
							  <a href="/shop/<?= strtolower($cath->cathegory) ?>" class="s-text7"><?= $cath->cathegory ?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>

				<div class="p-t-30 p-l-15 p-r-15 respon4">
					<h4 class="s-text12 p-b-30">
						Filters
					</h4>

					<ul class="foo-filters">
							<?php foreach ($filters as $f) : ?>
						  <li class="p-b-9">
							  <a href="/shop/<?= strtolower($f->filter) ?>" class="s-text7"><?= $f->filter ?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>

			<!-- <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Newsletter
				</h4>

				<form>
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							Subscribe
						</button>
					</div>

				</form>
			</div> -->
		</div>

		<div class="t-center p-l-15 p-r-15">

			<div class="t-center s-text8 p-t-20">
				Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
			</div>
		</div>
	</footer>

  <!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>
		<div class="nav">
			<div class="table">
					<ul
					<?php if($curr_page == "home.php") echo "class='current'"; else echo "class=select";	?>
					><li><a href="home.php"><b><?=_("Live Video")?></b><!--[if IE 7]><!--></a><!--<![endif]-->
						<!--[if lte IE 6]><table><tr><td><![endif]-->
						<div <?php if($curr_page == "home.php") echo "class='select_sub show'"; else echo "class='select_sub'"; ?>>
							<ul class="sub">
								<li <?php if($curr_page == "home.php") echo "class='sub_show'"; ?>><a href="#"><?=_("Available Channels")?></a></li>
								<li><a href="#"><?=_("Available Videos")?></a></li>
							</ul>
						</div>
						<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					</li>
				</ul>
		
				<div class="nav-divider">&nbsp;</div>
		
				<ul
				<?php if($curr_page == "vod.php") echo "class=current"; else echo "class=select";	?>
				>
					<li><a href="vod.php"><b><?=_("OnDemand Video")?></b><!--[if IE 7]><!--></a><!--<![endif]-->
						<!--[if lte IE 6]><table><tr><td><![endif]-->
							<div <?php if($curr_page == "vod.php") echo "class='select_sub show'"; else echo "class='select_sub'"; ?>>
								<ul class="sub">
									<li <?php if($curr_page == "vod.php") echo "class='sub_show'"; ?>><a href="vod.php"><?=_("Available Channels")?></a></li>
									<li><a href="#"><?=_("Available Videos")?></a></li>
								</ul>
							</div>
						<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					</li>
				</ul>
		
				<div class="nav-divider">&nbsp;</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
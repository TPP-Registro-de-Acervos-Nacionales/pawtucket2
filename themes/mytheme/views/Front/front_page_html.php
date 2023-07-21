<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
		print $this->render("Front/featured_set_slideshow_html.php");
?>
	<div class="row">
		<div class="col-sm-8">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean scelerisque semper sapien in tincidunt. Curabitur ac nunc est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc vel magna tincidunt, egestas enim a, ultricies ipsum. Vestibulum at metus lacus. Etiam viverra ligula at accumsan accumsan. Quisque vitae urna in sapien vehicula hendrerit.</p>
			<p>Aliquam ornare, leo non hendrerit consequat, lacus arcu volutpat justo, at pulvinar lacus metus nec turpis. Phasellus luctus malesuada ipsum at consectetur. Nullam nisl dui, hendrerit id sem a, congue imperdiet tortor. Suspendisse interdum augue vitae porta imperdiet. Donec interdum eu risus sed venenatis. Maecenas accumsan odio a sapien euismod fringilla. Praesent felis arcu, facilisis et fringilla ut, tristique at velit. Nunc at diam vitae diam vulputate blandit. Vivamus quis arcu egestas nibh vulputate auctor at ut eros.</p>
			<p>Suspendisse tortor ex, iaculis et lorem nec, consequat eleifend arcu. Quisque vel tortor volutpat, dapibus lorem ac, vestibulum odio. Praesent eget sapien vitae mi vestibulum vulputate. Pellentesque nec maximus magna. Proin ut dictum libero, ac finibus diam. Cras a dolor malesuada, ullamcorper risus at, scelerisque metus. Nam suscipit suscipit posuere. Donec convallis in velit nec facilisis. Vivamus blandit fermentum tincidunt. Morbi blandit, nibh in auctor hendrerit, magna sapien varius orci, sit amet malesuada turpis odio at arcu. Nam ac porta metus, vitae venenatis nunc. Nam tincidunt, felis ut scelerisque tincidunt, erat nisl congue nunc, non suscipit purus ex non felis. Donec cursus eget diam in malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas luctus augue sed sodales pretium.</p>
			<p>Donec ut gravida mi, sed elementum felis. Praesent sed feugiat nisi. Donec ac diam sapien. Aenean congue ut mi eget iaculis. Aenean interdum vitae tortor in viverra. Cras congue nunc dui, sed efficitur dui mollis et. Vivamus venenatis tortor sit amet quam congue, in lobortis massa iaculis. Donec augue lectus, mollis nec feugiat in, mattis eu risus.</p>
			<p>Maecenas sagittis volutpat arcu sed dapibus. Integer fringilla sollicitudin purus eget iaculis. Aenean commodo posuere enim porta gravida. In vel odio sem. Pellentesque eu pellentesque eros, in dapibus arcu. Quisque tellus ligula, convallis at consequat ac, interdum ac leo. Aenean ullamcorper ut mi et tempus. Curabitur fringilla fringilla euismod. Proin et dui ac dui suscipit mollis. Nunc ac faucibus est. Morbi ac risus erat.</p>
		</div><!--end col-sm-8-->
		<div class="col-sm-4">
<?php
		print $this->render("Front/gallery_set_links_html.php");
?>
		</div> <!--end col-sm-4-->
	</div><!-- end row -->

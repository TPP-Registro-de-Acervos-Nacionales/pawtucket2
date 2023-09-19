<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_objects_default_html.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2018 Whirl-i-Gig
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
 * ----------------------------------------------------------------------
 */

	$t_object = 			$this->getVar("item");
	$va_comments = 			$this->getVar("comments");
	$va_tags = 				$this->getVar("tags_array");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");
	$vn_pdf_enabled = 		$this->getVar("pdfEnabled");
	$vn_id =				$t_object->get('ca_objects.object_id');
	$vn_type_id = 			$t_object->get('ca_objects.type_id');
	$t_list = new ca_lists();
	$vn_oh_id = $t_list->getItemIDFromList("object_types", "oral_history");
	$vn_book_id = $t_list->getItemIDFromList("object_types", "book");
?>
<div class="row">
	<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div><!-- end detailTop -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgLeft">
			{{{previousLink}}}{{{resultsLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
		<div class="container"><div class="row">
			<div class='col-sm-12'>
				{{{representationViewer}}}


				<div id="detailAnnotations"></div>

				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-2", 'version' => 'iconlarge')); ?>

				<hr/>

			</div><!-- end col -->

			<div class='col-sm-12'>
				<table class="table">
					<tbody>
<?php
				if ($va_collection = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections" restrictToRelationshipTypes="guardian"><l>^ca_collections.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><td class='table-first-column'>Institución</td><td>".$va_collection."</td></tr>";
				}
				if ($vs_idno = $t_object->get('ca_objects.idno')) {
					print "<tr class='unit'><td class='table-first-column'>Código de referencia</td><td>".$vs_idno."</td></tr>";
				}
				if ($vs_idno = $t_object->get('ca_objects.nro_inventario')) {
					print "<tr class='unit'><td class='table-first-column'>Número de inventario local</td><td>".$vs_idno."</td></tr>";
				}
				if ($va_collection = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections" restrictToRelationshipTypes="part_of"><l>^ca_collections.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><td class='table-first-column'>Colección</td><td>".$va_collection."</td></tr>";
				}
				if ($vs_idno = $t_object->get('ca_objects.nombre_del_objeto')) {
					print "<tr class='unit'><td class='table-first-column'>Nombre del objeto</td><td>".$vs_idno."</td></tr>";
				}
				/* if ($vs_author = $t_object->get('ca_entities.preferred_labels', array('restrictToRelationshipTypes' => array('author'), 'delimiter' => ', ', 'returnAsLink' => true))) {
					print "<tr class='unit'><td class='table-first-column'>Autor</td><td>".$vs_author."</td></tr>";
				} */
				/* if ($vs_name = $t_object->get('ca_objects.preferred_labels')) {
					print "<tr class='unit'><td class='table-first-column'>Título</td><td><a href='/Detail/entities/2830'>".$vs_name."</a></td></tr>";
				} */
				/* if ($vs_call = $t_object->get('ca_objects.call_number')) {
					print "<tr class='unit'><td class='table-first-column'>Call Number</td><td>".$vs_call."</td></tr>";
				} */
				/* if ($vs_title = $t_object->get('ca_objects.title')) {
					print "<tr class='unit'><td class='table-first-column'>Title</td><td>".$vs_title."</td></tr>";
				} */
				/* if ($vs_language = $t_object->get('ca_objects.language', array('delimiter' => '<br/>'))) {
					print "<tr class='unit'><td class='table-first-column'>Language</td><td>".$vs_language."</td></tr>";
				} */
				# --- access points
				/* $va_access_points = array();
				$va_subjects = $t_object->get('ca_list_items.preferred_labels', array('returnAsArray' => true));
				$va_getty = $t_object->get('ca_objects.aat', array('returnAsArray' => true));
				$va_lcsh = $t_object->get('ca_objects.lcsh_terms', array('returnAsArray' => true));
				$va_access_points = array_merge($va_subjects, $va_getty, $va_lcsh);
				if (sizeof($va_access_points)) {
					$va_access_points_sorted = array();
					foreach($va_access_points as $vs_access_point){
						$vs_access_point = trim(preg_replace("/\[[^\]]*\]/", "", $vs_access_point));
						if($vs_access_point){
							$va_access_points_sorted[$vs_access_point] = caNavLink($this->request, $vs_access_point, "", "", "MultiSearch",  "Index", array('search' => $vs_access_point));
						}
					}
					ksort($va_access_points_sorted, SORT_NATURAL | SORT_FLAG_CASE);
					print "<tr class='unit'><td class='table-first-column'>Asuntos</td><td>".implode(", ", $va_access_points_sorted)."</td></tr>";

				} */
?>
					</tbody>
				</table>
<?php
?>


<?php
				# Comment/ Share / pdf / ask archivist tools

					print '<div id="detailTools">';
					print "<div class='detailTool'><span class='glyphicon glyphicon-envelope'></span>".caNavLink($this->request, "Inquire About This Item", "", "", "Contact",  "form", array('table' => 'ca_objects', 'id' => $vn_id))."</div>";

					if ($vn_comments_enabled) {
?>
						<div class="detailTool"><a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><span class="glyphicon glyphicon-comment"></span>Comments and Tags (<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a></div><!-- end detailTool -->
						<div id='detailComments'><?php print $this->getVar("itemComments");?></div><!-- end itemComments -->
<?php
					}
					if ($vn_share_enabled) {
						print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt"></span>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
					}

					if ($vn_pdf_enabled) {
						print "<div class='detailTool'><span class='glyphicon glyphicon-file'></span>".caDetailLink($this->request, "Download as PDF", "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary'))."</div>";
					}

					print '</div><!-- end detailTools -->';

?>
			</div><!-- end col -->
		</div><!-- end row --></div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 120
		});
	});
</script>

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
?>
<div class="row">
	<div class='col-xs-12 '><!--- only shown at small screen size -->
		<div class='pageNav'>
			{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
		</div>
	</div><!-- end detailTop -->
</div>
<div class="row">	
	<div class='col-xs-12'>
		<div class="container"><div class="row">
			<div class='col-sm-12'>
<?php
				print "<h2>".$t_object->get('ca_objects.preferred_labels')."</h2>";
?>
			</div>
			<div class='col-sm-7'>
				{{{representationViewer}}}
				
				
				<div id="detailAnnotations"></div>
				
				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4", "primaryOnly" => $this->getVar('representationViewerPrimaryOnly') ? 1 : 0)); ?>
				
<?php
				# Comment and Share Tools
				if ($vn_comments_enabled | $vn_share_enabled | $vn_pdf_enabled) {
						
					print '<div id="detailTools">';
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
				}				

?>

			</div><!-- end col -->
			
			<div class='col-sm-5 rightCol'>
<?php
			if ($vs_description = $t_object->get('ca_objects.description')) {
				print "<div class='unit'>".$vs_description."</div>";
			}			
			# --- identifier

			if($vs_collection_idno = $t_object->get('ca_collections.idno')){
				#print_r(@get_headers("http://iarchives.nysed.gov/xtf/view?docId=tei/".$vs_collection_idno."/".$t_object->get('idno').".xml"));
				# get transcript y/n
				$t_list = new ca_lists();
				$vn_yes_value = $t_list->getItemIDFromList("transcript", "transcript_yes");
					
				if($t_object->get('ca_objects.transcript') == $vn_yes_value) {
					print "<div class='unit'><a href='http://iarchives.nysed.gov/xtf/view?docId=tei/".$vs_collection_idno."/".$t_object->get('idno').".xml' target='_blank' class='btn btn-default'>"._t("Transcript / Translation")."</a></div>";
				}
						
			}
			if($vs_idno = $t_object->get('idno')){
				print "<div class='unit'><b>"._t("Identifier")."</b><br/>".$vs_idno."</div><!-- end unit -->";
			}
			if ($vs_altID_array = $t_object->get('ca_objects.alternateID', array('returnWithStructure' => true, 'convertCodesToDisplayText' => true))) {
				print "<div class='unit'><b>Alternate Identifier</b><br/>";
				$i = 1;
				foreach ($vs_altID_array as $va_key => $va_altID_t) {
					foreach ($va_altID_t as $va_key => $vs_altID) {
						print "<b class='gray'>".$vs_altID['alternateIDdescription'].":</b> ".$vs_altID['alternateID'];
						if($i < sizeof($va_altID_t)){
							print "<br/>";
						}
						$i++;
					}
				}

				print "</div>";
			}
			if ($va_date_array = $t_object->get('ca_objects.date', array('returnWithStructure' => true))) {
				$t_list = new ca_lists();
				$vn_original_date_id = $t_list->getItemIDFromList("date_types", "dateOriginal");
				foreach ($va_date_array as $va_key => $va_date_array_t) {
					foreach ($va_date_array_t as $va_key => $va_date_array) {
						if ($va_date_array['dc_dates_types'] == $vn_original_date_id) {
							print "<div class='unit'><b>Date</b><br/>".$va_date_array['dates_value']."</div>";
						}
					}
				}
				
			}
			if ($va_contributor = $t_object->get('ca_objects.contributor', array('convertCodesToDisplayText' => true, 'returnWithStructure' => 'true'))) {
				$va_contributor = array_pop($va_contributor);
				$va_tmp = array();
				foreach($va_contributor as $va_contributor_info){
					$vs_tmp = "";
					$vs_tmp = $va_contributor_info["contributor"];
					if($vs_ctype = $va_contributor_info["contributorType"]){
						$vs_tmp .= " (".$vs_ctype.")";
					}
					if(trim($vs_tmp)){
						$va_tmp[] = $vs_tmp;
					}
				}
				if(sizeof($va_tmp)){
					print "<div class='unit'><b>Contributor</b><br/>";
					print join(", ", $va_tmp);
					print "</div>";
				}
			}
			#if ($vs_language = $t_object->get('ca_objects.language', array('convertCodesToDisplayText' => true))) {
			#	print "<div class='unit'><b>Language</b><br/>".$vs_language."</div>";
			#}			
			if ($vs_repository = $t_object->get('ca_objects.repository', array('convertCodesToDisplayText' => true))) {
				print "<div class='unit'><b>Repository</b><br/>".$vs_repository."</div>";
			}
			
			if ($vs_source = $t_object->get('ca_objects.source')) {
				print "<div class='unit'><b>Source</b><br/>".$vs_source."</div>";
			}						
			if ($va_rights_array = $t_object->get('ca_objects.rightsList', array('returnWithStructure' => true))) {
				$t_rights_list = new ca_lists();
				$vn_nysa_id = $t_list->getItemIDFromList("rightsType", "NYSArights");
				$vn_nonnysa_id = $t_list->getItemIDFromList("rightsType", "nonNYSArights");
				foreach ($va_rights_array as $va_key => $va_rights_array_t) {
					foreach ($va_rights_array_t as $va_key => $va_rights_array) {
						if ($va_rights_array['rightsList'] == $vn_nysa_id) {
							print "<div class='unit'><b>Rights</b><br/>This image is provided for education and research purposes. Rights may be reserved. Responsibility for securing permissions to distribute, publish, reproduce or other use rest with the user. For additional information see our <a href='/index.php/About/Copyright'>Copyright and Use Statement</a></div>";
						} else if ($va_rights_array['rightsList'] == $vn_nonnysa_id) {
							print "<div class='unit'><b>Rights</b><br/>This record is not part of the New York State Archives' collection and is presented on our project partner's behalf for educational use only.  Please contact the home repository for information on copyright and reproductions.</div>";
						}
					}
				}
				
			}	
			if ($vs_special = $t_object->get('ca_objects.SpecialProject', array('convertCodesToDisplayText' => true))) {
				print "<div class='unit'><b>Special Project</b><br/>".$vs_special."</div>";
			}					
			# --- parent hierarchy info
			if($t_object->get('parent_id')){
				print "<div class='unit'><b>"._t("Part Of")."</b><br/>".caNavLink($this->request, $t_object->get("ca_objects.parent.preferred_labels.name"), '', 'Detail', 'Object', 'Show', array('object_id' => $t_object->get('parent_id')))."</div>";
			}

			# --- Relation
				
			# --- collections
			if ($vs_collections = $t_object->getWithTemplate("<ifcount code='ca_collections' min='1'><unit relativeTo='ca_collections'><l>^ca_collections.preferred_labels</l></unit></ifcount>")){	
				print "<div class='unit'><h3>"._t("Related collections")."</h3>";
				print $vs_collections;
				print "</div><!-- end unit -->";
			}			
			# --- entities
			if ($vs_entities = $t_object->getWithTemplate("<ifcount code='ca_entities' min='1'><unit relativeTo='ca_entities'><l>^ca_entities.preferred_labels.displayname</l> (^relationship_typename)</unit></ifcount>")){	
				print "<div class='unit'><h3>"._t("Related entities")."</h3>";
				print $vs_entities;
				print "</div><!-- end unit -->";
			}
			
			# --- occurrences
			$va_occ_array = array();
			if ($va_occurrences = $t_object->get("ca_occurrences.occurrence_id", array("returnAsArray" => true, 'checkAccess' => $va_access_values))){
				foreach ($va_occurrences as $va_key => $va_occurrence_id) {
					$t_occ = new ca_occurrences($va_occurrence_id);
					$vn_type_id = $t_occ->get('ca_occurrences.type_id');
					$va_occ_array[$vn_type_id][$va_occurrence_id] = caDetailLink($this->request, $t_occ->get('ca_occurrences.preferred_labels'), '', 'ca_occurrences', $va_occurrence_id);
				}
				foreach ($va_occ_array as $va_type => $va_occ) {
					print "<div class='unit'><h3>Related ".caGetListItemByIDForDisplay($va_type, true)."</h3>";
					foreach ($va_occ as $va_key => $va_occ_link) {
						print "<div>".$va_occ_link."</div>";
					}
					print "</div>";
				}
			}
			
			# --- places
			$vs_places = $t_object->getWithTemplate("<unit relativeTo='ca_places' delimiter='<br/>'><l>^ca_places.preferred_labels.name</l> (^relationship_typename)</unit>");
			
			if($vs_places){
				print "<div class='unit'><h3>"._t("Related places")."</h3>";
				print $vs_places;
				print "</div><!-- end unit -->";
			}
			
			# --- lots
			$vs_object_lots = $t_object->getWithTemplate("<ifcount code='ca_lots' min='1'><unit relativeTo='ca_lots'>^ca_lots.preferred_labels.name (^ca_lots.idno_stub)</unit></ifcount>");
			if($vs_object_lots){
				print "<div class='unit'><h3>"._t("Related lot")."</h3>";
				print $vs_object_lots;
				print "</div><!-- end unit -->";
			}
			
			# --- vocabulary terms
			$vs_terms = $t_object->getWithTemplate("<ifcount code='ca_list_items' min='1'><unit relativeTo='ca_list_items'>^ca_list_items.preferred_labels.name_plural (^relationship_typename)</unit></ifcount>");
			if($vs_terms){
				print "<div class='unit'><h3>"._t("Subjects")."</h3>";
				print $vs_terms;
				print "</div><!-- end unit -->";
			}
			
					
			# --- output related object images as links
			if ($va_related_objects = $t_object->get("ca_objects.related.preferred_labels", array("returnAsLink" => true, 'checkAccess' => $va_access_values, 'delimiter' => '<br/>'))){
				print "<div class='unit'><h3>Related Objects</h3>".$va_related_objects."</div>";
			}
?>
				
			</div><!-- end col -->
		</div><!-- end row --></div><!-- end container -->
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
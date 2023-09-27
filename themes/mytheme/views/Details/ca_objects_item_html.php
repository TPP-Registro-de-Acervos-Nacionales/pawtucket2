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
				/* if ($vs_dimensiones = $t_object->get('ca_objects.dimensiones', array('convertCodesToDisplayText' => true))) {
					if (sizeof($vs_dimensiones) > 0) {
						$fila = "<tr class='unit'>
							<td class='table-first-column'>Dimensiones</td><td>";

						foreach($vs_dimensiones as $vs_dimension) {
							$tipo_de_medida = $t_object->get('ca_objects.dimensiones.tipo_de_medida',array('convertCodesToDisplayText' => true));
							$valor = $t_object->get('ca_objects.dimensiones.valor');
							$unidad = $t_object->get('ca_objects.dimensiones.unidad');
							$funcion = $t_object->get('ca_objects.dimensiones.funcion');



							$texto_dimension = $tipo_de_medida.": ".$valor."<br>";

							$fila = $fila.$vs_dimensiones; //.": ".$valor." ".$unidad." (".$funcion.")""." | ";
						}
						print $vs_dimensiones."</td></tr>";

					}
				} */
				if ($va_collection = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections" restrictToRelationshipTypes="guardian"><l>^ca_collections.preferred_labels</l></unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Institución</th><td>".$va_collection."</td></tr>";
				}
				if ($vs_codigo_de_referencia = $t_object->get('ca_objects.idno')) {
					print "<tr class='unit'><th class='table-first-column'>Código de referencia</th><td>".$vs_codigo_de_referencia."</td></tr>";
				}
				if ($vs_idno = $t_object->get('ca_objects.nro_inventario')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.nro_inventario")."</th><td>".$vs_idno."</td></tr>";
				}
				if ($va_agrupacion = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections" restrictToRelationshipTypes="part_of"><l>^ca_collections.preferred_labels</l></unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Agrupación a la que pertenece</th><td>".$va_agrupacion."</td></tr>";
				}
				if ($vs_clase = $t_object->get('ca_objects.class', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.class")."</th><td>".$vs_clase."</td></tr>";
				}
				if ($vs_tipo_documental = $t_object->get('ca_objects.tipo_documental')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.tipo_documental")."</th><td>".$vs_tipo_documental."</td></tr>";
				}
				if ($vs_tipo_documental = $t_object->get('ca_objects.tipo_documental')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.tipo_documental")."</th><td>".$vs_tipo_documental."</td></tr>";
				}
				if ($vs_tradicion_documental = $t_object->get('ca_objects.diplomatic_traditions', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.diplomatic_traditions")."</th><td>".$vs_tradicion_documental."</td></tr>";
				}
				if ($vs_volumen_y_soporte = $t_object->get('ca_objects.extent')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.extent")."</th><td>".$vs_volumen_y_soporte."</td></tr>";
				}
				if ($vs_titulo = $t_object->get('ca_objects.preferred_labels')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.preferred_labels")."</th><td>".$vs_titulo."</td></tr>";
				}
				if ($vs_tipo_titulo = $t_object->get('ca_objects.title_type', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.title_type")."</th><td>".$vs_tipo_titulo."</td></tr>";
				}
				// TODO: fechas
				if ($va_lugar_de_creacion = $t_object->getWithTemplate('<ifcount code="ca_places" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_places" restrictToRelationshipTypes="created"><l>^ca_places.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Lugares referidos</th><td>".$va_lugar_de_creacion."</td></tr>";
				}
				if ($vs_productor = $t_object->get('ca_entities.preferred_labels', array('restrictToRelationshipTypes' => array('productor'), 'delimiter' => ', ', 'returnAsLink' => true))) {
					print "<tr class='unit'><th class='table-first-column'>Productor</th><td>".$vs_productor."</td></tr>";
				}
				if ($vs_creador = $t_object->get('ca_entities.preferred_labels', array('restrictToRelationshipTypes' => array('productor'), 'delimiter' => ', ', 'returnAsLink' => true))) {
					print "<tr class='unit'><th class='table-first-column'>Creador</th><td>".$vs_creador."</td></tr>";
				}
				if ($vs_adminbiohist = $t_object->get('ca_objects.adminbiohist')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.adminbiohist")."</th><td>".$vs_adminbiohist."</td></tr>";
				}
				if ($vs_custohist = $t_object->get('ca_objects.custohist')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.custohist")."</th><td>".$vs_custohist."</td></tr>";
				}
				if ($vs_forma_de_ingreso = $t_object->get('ca_objects.acquisition_way')) {
					print "<tr class='unit'><td class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.acquisition_way")."</td><td>".$vs_forma_de_ingreso."</td></tr>";
				}
				if ($vs_alcance_y_contenido = $t_object->get('ca_objects.scope_content')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.scope_content")."</th><td>".$vs_alcance_y_contenido."</td></tr>";
				}
				if ($vs_valoracion = $t_object->get('ca_objects.appraisal')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.appraisal")."</th><td>".$vs_valoracion."</td></tr>";
				}
				if ($vs_nuevos_ingresos = $t_object->get('ca_objects.accruals')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.accruals")."</th><td>".$vs_nuevos_ingresos."</td></tr>";
				}
				// Organización (container)
				if ($vs_integridad = $t_object->get('ca_objects.integrityInformation.integrity', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.integrityInformation.integrity")."</th><td>".$vs_integridad."</td></tr>";
				}
				// TODO: Dimensiones
				if ($vs_material = $t_object->get('ca_objects.materials', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.materials")."</th><td>".$vs_material."</td></tr>";
				}
				if ($vs_tecnicas = $t_object->get('ca_objects.techniques', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.techniques")."</th><td>".$vs_tecnicas."</td></tr>";
				}
				if ($vs_cromia = $t_object->get('ca_objects.chromy', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.chromy")."</th><td>".$vs_cromia."</td></tr>";
				}
				if ($vs_estado_conservacion = $t_object->get('ca_objects.conservation_status', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.conservation_status")."</th><td>".$vs_estado_conservacion."</td></tr>";
				}
				if ($va_entidades_relacionadas = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities"><l>^ca_entities.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Entidades relacionadas</th><td>".$va_entidades_relacionadas."</td></tr>";
				}
				if ($va_acontecimientos_relacionados = $t_object->getWithTemplate('<ifcount code="ca_occurrences" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_occurrences"><l>^ca_occurrences.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Acontecimientos relacionados</th><td>".$va_acontecimientos_relacionados."</td></tr>";
				}
				// TODO: asuntos
				if ($va_lugares_referidos = $t_object->getWithTemplate('<ifcount code="ca_places" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_places" restrictToRelationshipTypes="describes"><l>^ca_places.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Lugares referidos</th><td>".$va_lugares_referidos."</td></tr>";
				}
				if ($va_condiciones_de_acceso = $t_object->get('ca_objects.accessrestrict', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.accessrestrict")."</th><td>".$va_condiciones_de_acceso."</td></tr>";
				}
				if ($va_condiciones_de_reproduccion = $t_object->get('ca_objects.reproduction', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.reproduction")."</th><td>".$va_condiciones_de_reproduccion."</td></tr>";
				}
				if ($va_propietario_de_derechos = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="rightsHolder"><l>^ca_entities.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Propietario de derechos</th><td>".$va_propietario_de_derechos."</td></tr>";
				}
				// TODO: lengua (mejorar)
				/* if ($va_escritura = $t_object->get('ca_objects.langmaterial')) {
					$va_lengua = $t_object->get('ca_objects.langmaterial.language', array('convertCodesToDisplayText' => true));
					$va_lengua_sistema_escritura = $t_object->get('ca_objects.langmaterial.languagesystem', array('convertCodesToDisplayText' => true));
					$va_lengua_material = $t_object->get('ca_objects.langmaterial.material', array('convertCodesToDisplayText' => true));
					$va_lengua_tipo = $t_object->get('ca_objects.langmaterial.script_type', array('convertCodesToDisplayText' => true));

					$texto = $va_lengua."-".$va_lengua_sistema_escritura."-".$va_lengua_material."-".$va_lengua_tipo;

					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.langmaterial")."</th><td>".$texto."</td></tr>";
				} */
				if ($caracteristicas_fisicas = $t_object->get('ca_objects.phystech', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.phystech")."</th><td>".$caracteristicas_fisicas."</td></tr>";
				}
				if ($instrumentos_de_descripcion = $t_object->get('ca_objects.other_find_aid', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.other_find_aid")."</th><td>".$instrumentos_de_descripcion."</td></tr>";
				}
				if ($existencia_originales = $t_object->get('ca_objects.originalsloc')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.originalsloc")."</th><td>".$existencia_originales."</td></tr>";
				}
				if ($existencia_copias = $t_object->get('ca_objects.altformavail')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.altformavail")."</th><td>".$existencia_copias."</td></tr>";
				}
				if ($premios = $t_object->get('ca_objects.prices')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.prices")."</th><td>".$premios."</td></tr>";
				}

				/* if($vs_category = $t_object->get("ca_objects.category", array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><td class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.category")."</td><td>"."{$vs_category}</td></tr>";
				}
				if ($va_collection = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections" restrictToRelationshipTypes="part_of"><l>^ca_collections.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><td class='table-first-column'>Colección</td><td>".$va_collection."</td></tr>";
				}
				if ($vs_nombre_objeto = $t_object->get('ca_objects.nombre_del_objeto', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><td class='table-first-column'>Nombre del objeto</td><td>".$vs_nombre_objeto."</td></tr>";
				}
				if ($vs_tipo_objeto = $t_object->get('ca_objects.tipo_de_objeto')) {
					print "<tr class='unit'><td class='table-first-column'>Tipo de objeto</td><td>".$vs_tipo_objeto."</td></tr>";
				}
				if ($vs_descripcion = $t_object->get('ca_objects.descripcion_objeto')) {
					print "<tr class='unit'><td class='table-first-column'>Descripción del objeto</td><td>".$vs_descripcion."</td></tr>";
				}
				if ($vs_todo_o_parte = $t_object->get('ca_objects.todo_o_parte')) {
					print "<tr class='unit'><td class='table-first-column'>Todo/parte (todo o parte)</td><td>".$vs_todo_o_parte."</td></tr>";
				}
				if ($vs_componente = $t_object->get('ca_objects.component')) {
					print "<tr class='unit'><td class='table-first-column'>Componente</td><td>".$vs_componente."</td></tr>";
				}
				if ($vs_elements = $t_object->get('ca_objects.elements')) {
					print "<tr class='unit'><td class='table-first-column'>Partes</td><td>".$vs_elements."</td></tr>";
				}
				if ($vs_title = $t_object->get('ca_objects.preferred_labels')) {
					print "<tr class='unit'><td class='table-first-column'>Título</td><td>".$vs_title."</td></tr>";
				}
				if ($vs_title_type = $t_object->get('ca_objects.title_type')) {
					print "<tr class='unit'><td class='table-first-column'>Tipo de título</td><td>".$vs_title_type."</td></tr>";
				}
				if ($vs_asociacion_historica = $t_object->get('ca_objects.asociacion_historica')) {
					print "<tr class='unit'><td class='table-first-column'>Nota de autoría / fabricación</td><td>".$vs_autorship_note."</td></tr>";
				}
				if ($vs_asociacion_historica = $t_object->get('ca_objects.autorship_note')) {
					print "<tr class='unit'><td class='table-first-column'>Asociación histórica / Descripción de contenido</td><td>".$vs_asociacion_historica."</td></tr>";
				}

				if ($vs_fecha = $t_object->get('ca_objects.unitdate', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'>
							<td class='table-first-column'>Fecha</td>
							<td>".$vs_fecha."</td>
						</tr>";
				}
				if ($vs_author = $t_object->get('ca_entities.preferred_labels', array('restrictToRelationshipTypes' => array('author'), 'delimiter' => ', ', 'returnAsLink' => true))) {
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

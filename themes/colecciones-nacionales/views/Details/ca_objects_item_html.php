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
		<div class="container">
			<div class="row">
				<div class='col-sm-12'>
					{{{representationViewer}}}

					<div id="detailAnnotations"></div>

					<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-2", 'version' => 'iconlarge')); ?>

					<hr/>

				</div><!-- end col -->
				<div class="container">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse-identificacion">Identificación</a>
								</h4>
							</div>
							<div id="collapse-identificacion" class="panel-collapse collapse in">
								<table class="table">
									<tbody>
									<?php
									if ($va_collection = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections" restrictToRelationshipTypes="guardian"><l>^ca_collections.preferred_labels</l></unit></unit></ifcount>')) {
										print "<tr class='unit'><th class='table-first-column'>Institución</th><td>" . $va_collection . "</td></tr>";
									}
									if ($vs_codigo_de_referencia = $t_object->get('ca_objects.idno')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.idno") . "</th><td>" . $vs_codigo_de_referencia . "</td></tr>";
									}
									if ($vs_idno = $t_object->get('ca_objects.nro_inventario')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.nro_inventario") . "</th><td>" . $vs_idno . "</td></tr>";
									}
									if ($va_agrupacion = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections" restrictToRelationshipTypes="part_of"><l>^ca_collections.preferred_labels</l></unit></unit></ifcount>')) {
										print "<tr class='unit'><th class='table-first-column'>Agrupación a la que pertenece</th><td>" . $va_agrupacion . "</td></tr>";
									}
									if ($vs_clase = $t_object->get('ca_objects.class', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.class") . "</th><td>" . $vs_clase . "</td></tr>";
									}
									if ($vs_tipo_documental = $t_object->get('ca_objects.tipo_documental')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.tipo_documental") . "</th><td>" . $vs_tipo_documental . "</td></tr>";
									}
									if ($vs_tradicion_documental = $t_object->get('ca_objects.diplomatic_traditions', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.diplomatic_traditions") . "</th><td>" . $vs_tradicion_documental . "</td></tr>";
									}
									if ($vs_volumen_y_soporte = $t_object->get('ca_objects.extent')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.extent") . "</th><td>" . $vs_volumen_y_soporte . "</td></tr>";
									}
									if ($vs_titulo = $t_object->get('ca_objects.preferred_labels')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.preferred_labels") . "</th><td>" . $vs_titulo . "</td></tr>";
									}
									if ($vs_tipo_titulo = $t_object->get('ca_objects.title_type', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.title_type") . "</th><td>" . $vs_tipo_titulo . "</td></tr>";
									}
									if ($vs_fechas = $t_object->get('ca_objects.unitdate')) {
										$fechas         = explode(';', $t_object->get('ca_objects.unitdate.date_value'));
										$tipos_de_fecha = explode(';', $t_object->get('ca_objects.unitdate.dates_types', array('convertCodesToDisplayText' => true)));
										$proximidades   = explode(';', $t_object->get('ca_objects.unitdate.date_near', array('convertCodesToDisplayText' => true)));

										$textos_fechas = array();
										foreach ( $fechas as $idx => $fecha ) {
											array_push($textos_fechas, $tipos_de_fecha[$idx].": ".$fechas[$idx]." (".$proximidades[$idx].")");
										}

										$vs_texto_fecha = implode('<br>', $textos_fechas);

										print "<tr class='unit'>
												<th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.unitdate")."</th>
												<td>".$vs_texto_fecha."</td>
											</tr>";
									}
									if ($vs_periodo = $t_object->get('ca_objects.date_period', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.date_period") . "</th><td>" . $vs_periodo . "</td></tr>";
									}
									if ($va_lugar_de_creacion = $t_object->getWithTemplate('<ifcount code="ca_places" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_places" restrictToRelationshipTypes="created"><l>^ca_places.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
										print "<tr class='unit'><th class='table-first-column'>Lugares referidos</th><td>" . $va_lugar_de_creacion . "</td></tr>";
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse-contexto">Contexto</a>
								</h4>
							</div>
							<div id="collapse-contexto" class="panel-collapse collapse">
								<table class="table">
									<tbody>
									<?php
									if ($vs_productor = $t_object->get('ca_entities.preferred_labels', array('restrictToRelationshipTypes' => array('productor'), 'delimiter' => ', ', 'returnAsLink' => true))) {
										print "<tr class='unit'><th class='table-first-column'>Productor</th><td>" . $vs_productor . "</td></tr>";
									}
									if ($vs_creador = $t_object->get('ca_entities.preferred_labels', array('restrictToRelationshipTypes' => array('productor'), 'delimiter' => ', ', 'returnAsLink' => true))) {
										print "<tr class='unit'><th class='table-first-column'>Creador</th><td>" . $vs_creador . "</td></tr>";
									}
									if ($vs_adminbiohist = $t_object->get('ca_objects.adminbiohist')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.adminbiohist") . "</th><td>" . $vs_adminbiohist . "</td></tr>";
									}
									if ($vs_custohist = $t_object->get('ca_objects.custohist')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.custohist") . "</th><td>" . $vs_custohist . "</td></tr>";
									}
									if ($vs_forma_de_ingreso = $t_object->get('ca_objects.acquisition_way')) {
										print "<tr class='unit'><td class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.acquisition_way") . "</td><td>" . $vs_forma_de_ingreso . "</td></tr>";
									}
									if ($prop_anteriores = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="propietario_anterior"><l>^ca_entities.preferred_labels</l></unit></unit></ifcount>')) {
										print "<tr class='unit'><th class='table-first-column'>Propietario Anteriores</th><td>".$prop_anteriores."</td></tr>";
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse-contenido-y-estructura">Contenido y
										Estructura</a>
								</h4>
							</div>
							<div id="collapse-contenido-y-estructura" class="panel-collapse collapse">
								<table class="table">
									<tbody>
									<?php
									if ($vs_alcance_y_contenido = $t_object->get('ca_objects.scope_content')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.scope_content") . "</th><td>" . $vs_alcance_y_contenido . "</td></tr>";
									}
									if ($vs_valoracion = $t_object->get('ca_objects.appraisal')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.appraisal") . "</th><td>" . $vs_valoracion . "</td></tr>";
									}
									if ($vs_nuevos_ingresos = $t_object->get('ca_objects.accruals')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.accruals") . "</th><td>" . $vs_nuevos_ingresos . "</td></tr>";
									}
									if ($vs_org = $t_object->get('ca_objects.arrangement')) {
										$sist_arreglo         = explode(';', $t_object->get('ca_objects.arrangement.arrengement_system'));
										$sist_ordenacion = explode(';', $t_object->get('ca_objects.arrangement.arrengement_organization', array('convertCodesToDisplayText' => true)));

										$textos_org = array();
										foreach ( $sist_arreglo as $idx => $fecha ) {
											array_push($textos_org, $sist_ordenacion[$idx]." ".$sist_arreglo[$idx]);
										}

										$vs_texto_org = implode('<br>', $textos_org);

										print "<tr class='unit'>
												<th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.unitdate")."</th>
												<td>".$vs_texto_org."</td>
											</tr>";
									}
									if ($vs_integridad = $t_object->get('ca_objects.integrityInformation.integrity', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.integrityInformation.integrity") . "</th><td>" . $vs_integridad . "</td></tr>";
									}
									if ($vs_dimensiones = $t_object->get('ca_objects.dimensiones')) {
										$tipo_de_medida = explode(';', $t_object->get('ca_objects.dimensiones.tipo_de_medida', array('convertCodesToDisplayText' => true)));
										$valor = explode(';', $t_object->get('ca_objects.dimensiones.valor'));
										$unidad = explode(';', $t_object->get('ca_objects.dimensiones.unidad'));
										$funcion = explode(';', $t_object->get('ca_objects.dimensiones.funcion'));

										$textos_dimensiones = array();
										foreach ( $tipo_de_medida as $idx => $dimension ) {
											array_push($textos_dimensiones, $tipo_de_medida[$idx].": ".$valor[$idx]." ".$unidad[$idx]." (".$funcion[$idx].")");
										}

										$vs_texto_dimensiones = implode('<br>', $textos_dimensiones);

										print "<tr class='unit'>
												<th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.dimensiones")."</th>
												<td>".$vs_texto_dimensiones."</td>
											</tr>";
									}
									if ($vs_material = $t_object->get('ca_objects.materials', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.materials") . "</th><td>" . $vs_material . "</td></tr>";
									}
									if ($vs_tecnicas = $t_object->get('ca_objects.techniques', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.techniques") . "</th><td>" . $vs_tecnicas . "</td></tr>";
									}
									if ($vs_cromia = $t_object->get('ca_objects.chromy', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.chromy") . "</th><td>" . $vs_cromia . "</td></tr>";
									}
									if ($inscripciones = $t_object->get('ca_objects.inscription')) {
										$tipo = explode(';', $t_object->get('ca_objects.inscription.mark', array('convertCodesToDisplayText' => true)));
										$ubicacion = explode(';', $t_object->get('ca_objects.inscription.position'));
										$contenido = explode(';', $t_object->get('ca_objects.inscription.inscriptions'));

										$textos_inscripciones = array();
										foreach ( $tipo as $idx => $inscripcion ) {
											array_push($textos_inscripciones, $tipo[$idx].": ".$ubicacion[$idx]." (".$contenido[$idx].")");
										}

										$vs_texto_inscripciones = implode('<br>', $textos_inscripciones);

										print "<tr class='unit'>
												<th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.inscriptions")."</th>
												<td>".$vs_texto_inscripciones."</td>
											</tr>";
									}
									if ($vs_estado_conservacion = $t_object->get('ca_objects.conservation_status', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.conservation_status") . "</th><td>" . $vs_estado_conservacion . "</td></tr>";
									}
									if ($va_entidades_relacionadas = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities"><l>^ca_entities.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
										print "<tr class='unit'><th class='table-first-column'>Entidades relacionadas</th><td>" . $va_entidades_relacionadas . "</td></tr>";
									}
									if ($va_acontecimientos_relacionados = $t_object->getWithTemplate('<ifcount code="ca_occurrences" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_occurrences"><l>^ca_occurrences.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
										print "<tr class='unit'><th class='table-first-column'>Acontecimientos relacionados</th><td>" . $va_acontecimientos_relacionados . "</td></tr>";
									}
									// Asuntos
									if ($va_lugares_referidos = $t_object->getWithTemplate('<ifcount code="ca_places" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_places" restrictToRelationshipTypes="describes"><l>^ca_places.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
										print "<tr class='unit'><th class='table-first-column'>Lugares referidos</th><td>" . $va_lugares_referidos . "</td></tr>";
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse-accesos-y-usos">Accesos y Usos</a>
								</h4>
							</div>
							<div id="collapse-accesos-y-usos" class="panel-collapse collapse">
								<table class="table">
									<tbody>
									<?php
									if ($va_condiciones_de_acceso = $t_object->get('ca_objects.accessrestrict', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.accessrestrict") . "</th><td>" . $va_condiciones_de_acceso . "</td></tr>";
									}
									if ($va_condiciones_de_reproduccion = $t_object->get('ca_objects.reproduction', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.reproduction") . "</th><td>" . $va_condiciones_de_reproduccion . "</td></tr>";
									}
									if ($va_propietario_de_derechos = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="rightsHolder"><l>^ca_entities.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
										print "<tr class='unit'><th class='table-first-column'>Propietario de derechos</th><td>" . $va_propietario_de_derechos . "</td></tr>";
									}
									// TODO: lengua (mejorar)
									if ($lengua = $t_object->get('ca_objects.langmaterial')) {
										$va_lengua                   = explode(';', $t_object->get('ca_objects.langmaterial.language', array('convertCodesToDisplayText' => true)));
										$va_lengua_sistema_escritura = explode(';', $t_object->get('ca_objects.langmaterial.languagesystem'));
										$va_lengua_material          = explode(';', $t_object->get('ca_objects.langmaterial.material'));
										$va_lengua_tipo              = explode(';', $t_object->get('ca_objects.langmaterial.script_type', array('convertCodesToDisplayText' => true)));

										$textos_lengua = array();
										foreach ( $va_lengua as $idx => $lng ) {
											array_push($textos_lengua, $va_lengua[$idx].": ".$va_lengua_sistema_escritura[$idx]." (".$va_lengua_material[$idx].")".$va_lengua_tipo[$idx]);
										}

										$vs_texto_lengua = implode('<br>', $textos_lengua);

										print "<tr class='unit'>
												<th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.langmaterial")."</th>
												<td>".$vs_texto_lengua."</td>
											</tr>";
									}
									if ($caracteristicas_fisicas = $t_object->get('ca_objects.phystech', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.phystech") . "</th><td>" . $caracteristicas_fisicas . "</td></tr>";
									}
									if ($instrumentos_de_descripcion = $t_object->get('ca_objects.other_find_aid', array('convertCodesToDisplayText' => true))) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.other_find_aid") . "</th><td>" . $instrumentos_de_descripcion . "</td></tr>";
									}
									if ($expuesta = $t_object->get('ca_objects.restrictions')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.restrictions.inexhibitions_yn") . "</th><td>" . $expuesta . "</td></tr>";
									}
									if ($epigrafes = $t_object->get('ca_objects.quote')) {
										$texto   = explode(';', $t_object->get('ca_objects.quote.quote_value'));
										$funcion = explode(';', $t_object->get('ca_objects.quote.quote_function', array('convertCodesToDisplayText' => true)));
										$fecha   = explode(';', $t_object->get('ca_objects.quote.quote_date', array('convertCodesToDisplayText' => true)));

										$textos_epigrafe = array();
										foreach ( $epigrafes as $idx => $epigrafe ) {
											array_push($textos_epigrafe, $funcion[$idx].": ".$texto[$idx]." (".$fecha[$idx].")");
										}

										$texto_epigrafe = implode('<br>', $textos_epigrafe);

										print "<tr class='unit'>
												<th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.quote")."</th>
												<td>".$texto_epigrafe."</td>
											</tr>";
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse-materiales-relacionados">Materiales
										Relacionados</a>
								</h4>
							</div>
							<div id="collapse-materiales-relacionados" class="panel-collapse collapse">
								<table class="table">
									<tbody>
									<?php
									if ($existencia_originales = $t_object->get('ca_objects.originalsloc')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.originalsloc") . "</th><td>" . $existencia_originales . "</td></tr>";
									}
									if ($existencia_copias = $t_object->get('ca_objects.altformavail')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.altformavail") . "</th><td>" . $existencia_copias . "</td></tr>";
									}
									if ($unid_desc_rel = $t_object->get('ca_objects.relatedmaterial')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.relatedmaterial") . "</th><td>" . $unid_desc_rel . "</td></tr>";
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse-procesos">Procesos</a>
								</h4>
							</div>
							<div id="collapse-procesos" class="panel-collapse collapse">
								<table class="table">
									<tbody>
									<?php
									if ($premios = $t_object->get('ca_objects.prices')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.prices") . "</th><td>" . $premios . "</td></tr>";
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse-notas">Notas</a>
								</h4>
							</div>
							<div id="collapse-notas" class="panel-collapse collapse">
								<table class="table">
									<tbody>
									<?php
									if ($nota_publica = $t_object->get('ca_objects.note')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.note") . "</th><td>" . $nota_publica . "</td></tr>";
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse-multimedia">Multimedia</a>
								</h4>
							</div>
							<div id="collapse-multimedia" class="panel-collapse collapse">
								<table class="table">
									<tbody>
									<?php
									if ($descripcion = $t_object->get('ca_objects.object_representation_note')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.object_representation_note") . "</th><td>" . $descripcion . "</td></tr>";
									}
									if ($acceso_objeto_digital = $t_object->get('ca_objects.representation_access_status')) {
										print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.representation_access_status") . "</th><td>" . $acceso_objeto_digital . "</td></tr>";
									}
									?>
									</tbody>
								</table>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class='col-sm-12'>
					<table class="table">
						<tbody>
						<?php
						if ($descripcion = $t_object->get('ca_objects.object_representation_note')) {
							print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.object_representation_note") . "</th><td>" . $descripcion . "</td></tr>";
						}
						if ($acceso_objeto_digital = $t_object->get('ca_objects.representation_access_status')) {
							print "<tr class='unit'><th class='table-first-column'>" . $t_object->getDisplayLabel("ca_objects.representation_access_status") . "</th><td>" . $acceso_objeto_digital . "</td></tr>";
						}
						?>
						</tbody>
					</table>

					<?php
					# Comment/ Share / pdf / ask archivist tools

					print '<div id="detailTools">';
					print "<div class='detailTool'><span class='glyphicon glyphicon-envelope'></span>" . caNavLink($this->request, "Inquire About This Item", "", "", "Contact", "form", array('table' => 'ca_objects', 'id' => $vn_id)) . "</div>";

					if ($vn_comments_enabled) {
						?>
						<div class="detailTool"><a href='#'
												   onclick='jQuery("#detailComments").slideToggle(); return false;'><span
									class="glyphicon glyphicon-comment"></span>Comments and Tags
								(<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a>
						</div><!-- end detailTool -->
						<div
							id='detailComments'><?php print $this->getVar("itemComments"); ?></div><!-- end itemComments -->
						<?php
					}
					if ($vn_share_enabled) {
						print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt"></span>' . $this->getVar("shareLink") . '</div><!-- end detailTool -->';
					}

					if ($vn_pdf_enabled) {
						print "<div class='detailTool'><span class='glyphicon glyphicon-file'></span>" . caDetailLink($this->request, "Download as PDF", "faDownload", "ca_objects", $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary')) . "</div>";
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
	jQuery(document).ready(function () {
		$('.trimText').readmore({
			speed: 75,
			maxHeight: 120
		});
	});
</script>

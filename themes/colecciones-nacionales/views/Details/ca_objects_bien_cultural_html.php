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
			<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse-id">Identificación</a>
      </h4>
    </div>
    <div id="collapse-id" class="panel-collapse collapse in">
      <table class="table">
        <tbody>
          <?php
				if ($va_collection = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections"><l>^ca_collections.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Institución</th><td>".$va_collection."</td></tr>";
				}
				if ($vs_idno = $t_object->get('ca_objects.idno')) {
					print "<tr class='unit'><th class='table-first-column'>Código de referencia</th><td>".$vs_idno."</td></tr>";
				}
				if ($vs_idno = $t_object->get('ca_objects.nro_inventario')) {
					print "<tr class='unit'><th class='table-first-column'>Número de inventario local</th><td>".$vs_idno."</td></tr>";
				}
				if($vs_clasificacion = $t_object->get("ca_objects.category")) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.category")."</th><td>{{{^ca_objects.category.hierarchy.preferred_labels.name_plural%delimiter=_➔_}}}</td></tr>";
				}
				if ($va_collection = $t_object->getWithTemplate('<ifcount code="ca_collections" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_collections" restrictToRelationshipTypes="part_of"><l>^ca_collections.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Colección</th><td>".$va_collection."</td></tr>";
				}
				if ($vs_nombre_objeto = $t_object->get('ca_objects.nombre_del_objeto', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.nombre_del_objeto")."</th><td>".$vs_nombre_objeto."</td></tr>";
				}
				if ($vs_tipo_objeto = $t_object->get('ca_objects.tipo_de_objeto', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>Tipo de objeto</th><td>".$vs_tipo_objeto."</td></tr>";
				}
				if ($vs_condicion = $t_object->get('ca_objects.condicion_bc', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.condicion_bc")."</th><td>".$vs_condicion."</td></tr>";
				}
				if ($vs_descripcion = $t_object->get('ca_objects.descripcion_objeto')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.descripcion_objeto")."</th><td>".$vs_descripcion."</td></tr>";
				}
				if ($vs_todo_o_parte = $t_object->get('ca_objects.todo_o_parte', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.todo_o_parte")."</th><td>".$vs_todo_o_parte."</td></tr>";
				}
				if ($vs_nro_piezas = $t_object->get('ca_objects.nro_piezas')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.nro_piezas")."</th><td>".$vs_nro_piezas."</td></tr>";
				}
				if ($vs_componente = $t_object->get('ca_objects.component')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.component")."</th><td>".$vs_componente."</td></tr>";
				}
				if ($vs_partes = $t_object->get('ca_objects.elements')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.elements")."</th><td>".$vs_partes."</td></tr>";
				}
				if ($vs_titulo = $t_object->get('ca_objects.preferred_labels')) {
					print "<tr class='unit'><th class='table-first-column'>Título</th><td>".$vs_titulo."</td></tr>";
				}
				if ($vs_tipo_de_titulo = $t_object->get('ca_objects.title_type', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.title_type")."</th><td>".$vs_tipo_de_titulo."</td></tr>";
				}
				if ($autor = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="autor"><l>^ca_entities.preferred_labels</l></unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Propietario de derechos</th><td>".$autor."</td></tr>";
				}
				if ($fabricante = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="fabricante"><l>^ca_entities.preferred_labels</l></unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Propietario de derechos</th><td>".$fabricante."</td></tr>";
				}
				if ($cultura = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="cultura"><l>^ca_entities.preferred_labels</l></unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Propietario de derechos</th><td>".$cultura."</td></tr>";
				}
				if ($vs_autorship_note = $t_object->get('ca_objects.autorship_note')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.autorship_note")."</th><td>".$vs_autorship_note."</td></tr>";
				}
				if ($vs_asociacion_historica = $t_object->get('ca_objects.asociacion_historica')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.asociacion_historica")."</th><td>".$vs_asociacion_historica."</td></tr>";
				}
				if ($vs_fechas = $t_object->get('ca_objects.unitdate')) {
					$fechas         = explode(';', $t_object->get('ca_objects.unitdate.date_value'));
					$tipos_de_fecha = explode(';', $t_object->get('ca_objects.unitdate.dates_types', array('convertCodesToDisplayText' => true)));
					$proximidades   = explode(';', $t_object->get('ca_objects.unitdate.date_near', array('convertCodesToDisplayText' => true)));

					$textos_fechas = array();
					foreach ( $vs_fechas as $idx => $fecha ) {
						array_push($textos_fechas, $tipos_de_fecha[$idx].": ".$fechas[$idx]." (".$proximidades[$idx].")");
					}

					$vs_texto_fecha = implode('<br>', $textos_fechas);

					print "<tr class='unit'>
							<th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.unitdate")."</th>
							<td>".$vs_texto_fecha."</td>
						</tr>";
				}
				if ($lugar_creacion = $t_object->getWithTemplate('<ifcount code="ca_places" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_places" restrictToRelationshipTypes="other"><l>^ca_places.preferred_labels</l></unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'> Lugar de creación / ejecución</th><td>".$lugar_creacion."</td></tr>";
				}
			?>
      </table>
    </div>
  </div>
</div>
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
				if ($vs_forma_de_ingreso = $t_object->get('ca_objects.acquisition_way')) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.acquisition_way")."</th><td>".$vs_forma_de_ingreso."</td></tr>";
				}
				if ($prop_anteriores = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="propietario_anterior"><l>^ca_entities.preferred_labels</l></unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Propietario Anteriores</th><td>".$prop_anteriores."</td></tr>";
				}
			?>
      </table>
    </div>
  </div>
</div>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse-desc-fisica-y-contenido">Descripción Física y de Contenido</a>
      </h4>
    </div>
    <div id="collapse-desc-fisica-y-contenido" class="panel-collapse collapse in">
      <table class="table">
        <tbody>
          <?php
				if ($vs_integridad = $t_object->get('ca_objects.integrityInformation.integrity')) {
					print "<tr class='unit'><th class='table-first-column'>Integridad</th><td>".$vs_integridad."</td></tr>";
				}
				if ($vs_dimensiones = $t_object->get('ca_objects.dimensiones')) {
					$tipo_de_medida = explode(';', $t_object->get('ca_objects.dimensiones.tipo_de_medida', array('convertCodesToDisplayText' => true)));
					$valor = explode(';', $t_object->get('ca_objects.dimensiones.valor'));
					$unidad = explode(';', $t_object->get('ca_objects.dimensiones.unidad'));
					$funcion = explode(';', $t_object->get('ca_objects.dimensiones.funcion'));

					$textos_dimensiones = array();
					foreach ( $vs_dimensiones as $idx => $dimension ) {
						array_push($textos_dimensiones, $tipo_de_medida[$idx].": ".$valor[$idx]." ".$unidad[$idx]." (".$funcion[$idx].")");
					}

					$vs_texto_dimensiones = implode('<br>', $textos_dimensiones);

					print "<tr class='unit'>
							<th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.dimensiones")."</th>
							<td>".$vs_texto_dimensiones."</td>
						</tr>";
				}
				if ($vs_material = $t_object->get('ca_objects.materials', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.materials")."</th><td>".$vs_material."</td></tr>";
				}
				if ($vs_tecnica = $t_object->get('ca_objects.techniques', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.techniques")."</th><td>".$vs_tecnica."</td></tr>";
				}
				if ($vs_cromia = $t_object->get('ca_objects.chromy', array('convertCodesToDisplayText' => true, 'delimiter' => ', '))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.chromy")."</th><td>".$vs_cromia."</td></tr>";
				}
				if ($vs_soporte = $t_object->get('ca_objects.soporte', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.soporte")."</th><td>".$vs_soporte."</td></tr>";
				}
				if ($vs_medio = $t_object->get('ca_objects.medium', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.medium")."</th><td>".$vs_medio."</td></tr>";
				}
				if ($vs_tirada = $t_object->get('ca_objects.state_edition_num', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.state_edition_num")."</th><td>".$vs_tirada."</td></tr>";
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
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.conservation_status")."</th><td>".$vs_estado_conservacion."</td></tr>";
				}
				if ($va_entidades_relacionadas = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities"><l>^ca_entities.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Entidades relacionadas</th><td>".$va_entidades_relacionadas."</td></tr>";
				}
				if ($va_acontecimientos_relacionados = $t_object->getWithTemplate('<ifcount code="ca_occurrences" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_occurrences"><l>^ca_occurrences.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Acontecimientos relacionados</th><td>".$va_acontecimientos_relacionados."</td></tr>";
				}
				/* if ($va_asuntos = $t_object->getWithTemplate('<ifcount code="ca_occurrences" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_occurrences"><l>^ca_occurrences.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Acontecimientos relacionados</th><td>".$va_asuntos."</td></tr>";
				} */
				if ($va_lugares_referidos = $t_object->getWithTemplate('<ifcount code="ca_places" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_places" restrictToRelationshipTypes="describes"><l>^ca_places.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Lugares referidos</th><td>".$va_lugares_referidos."</td></tr>";
				}
			?>
      </table>
    </div>
  </div>
</div>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse-acceso-y-uso">Acceso y Uso</a>
      </h4>
    </div>
    <div id="collapse-acceso-y-uso" class="panel-collapse collapse">
      <table class="table">
        <tbody>
          <?php
				if ($vs_condiciones_administrativas = $t_object->get('ca_objects.accessrestrict', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.accessrestrict")."</th><td>".$vs_condiciones_administrativas."</td></tr>";
				}
				if ($vs_condiciones_de_reproduccion = $t_object->get('ca_objects.reproduction', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.reproduction")."</th><td>".$vs_condiciones_de_reproduccion."</td></tr>";
				}
				if ($propietario_de_derechos = $t_object->getWithTemplate('<ifcount code="ca_entities" min="1"><unit delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="rightsHolder"><l>^ca_entities.preferred_labels</l> (^relationship_typename)</unit></unit></ifcount>')) {
					print "<tr class='unit'><th class='table-first-column'>Propietario de derechos</th><td>".$propietario_de_derechos."</td></tr>";
				}
				if ($condiciones_tecnicas_de_uso = $t_object->get('ca_objects.phystech', array('convertCodesToDisplayText' => true))) {
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.phystech")."</th><td>".$condiciones_tecnicas_de_uso."</td></tr>";
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
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.prices")."</th><td>".$premios."</td></tr>";
				}
			?>
      </table>
    </div>
  </div>
</div>
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
					print "<tr class='unit'><th class='table-first-column'>".$t_object->getDisplayLabel("ca_objects.note")."</th><td>".$nota_publica."</td></tr>";
				}
			?>
      </table>
    </div>
  </div>
</div>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse-media">Multimedia</a>
      </h4>
    </div>
    <div id="collapse-media" class="panel-collapse collapse">
      <table class="table">
        <tbody>
          <?php
									?>
      </table>
    </div>
  </div>
</div>

			<div class='col-sm-12'>

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

<?php
	MetaTagManager::setWindowTitle($this->request->config->get("app_display_name").": About");
?>

	<div class="row">
		<div class="col-sm-12">
			<H1><?php print _t("Acerca de"); ?></H1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<h2>Museo en línea</h2>
			<p></p>
		</div>
		<div class="col-sm-3 col-sm-offset-1">
			<address>Dirección<br>			Av. Alvear 1690 (C1014AAQ)<br>			Ciudad Autónoma de Buenos Aires.</address>

			<address><span class="info">Teléfono</span> — (+54-11) 4129-2452<br>			<span class="info">Email</span> — <a href="#">dnm@cultura.gob.ar</a></address>
		</div>
	</div>

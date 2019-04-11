<div class="row">
	<div class="span3"></div>
	<div class="span6">
		<form class="form-signin" method="post" action="calcularIndemnizacion">
			<h2 class="form-signin-heading">Datos del trabajador</h2>
			<hr>
			<h3>Fecha de ingreso</h3>
			<div class="row">
				<div class="span1"></div>
				<div class="span1">
					<select name="up_day">
					  <option>Dia</option>
					  <?php for ($i=1; $i <= 31; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					  <?php } ?>
					</select>
				</div>
				<div class="span2">
				    <select name="up_month">
				    	<option>Mes</option>
						<option value="1">Enero</option>
						<option value="2">Febrero</option>
						<option value="3">Marzo</option>
						<option value="4">Abril</option>
						<option value="5">Mayo</option>
						<option value="6">Junio</option>
						<option value="7">Julio</option>
						<option value="8">Agosto</option>
						<option value="9">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<div class="span1">
					<select name="up_year">
					  <option>Año</option>
					  <?php for ($i=2000; $i <= 2019; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					  <?php } ?>
					</select>
				</div>
				<div class="span1"></div>
			</div>

			<h3>Fecha de egreso</h3>
			<div class="row">
				<div class="span1"></div>
				<div class="span1">
					<select name="down_day">
					  <option>Dia</option>
					  <?php for ($i=1; $i <= 31; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					  <?php } ?>
					</select>
				</div>
				<div class="span2">
				    <select name="down_month">
				    	<option>Mes</option>
						<option value="1">Enero</option>
						<option value="2">Febrero</option>
						<option value="3">Marzo</option>
						<option value="4">Abril</option>
						<option value="5">Mayo</option>
						<option value="6">Junio</option>
						<option value="7">Julio</option>
						<option value="8">Agosto</option>
						<option value="9">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<div class="span1">
					<select name="down_year">
					  <option>Año</option>
					  <?php for ($i=2000; $i <= 2019; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					  <?php } ?>
					</select>
				</div>
				<div class="span1"></div>
			</div>

			<h3>Sueldo</h3>
			<div class="row">
				<div class="span1"></div>
				<div class="span4">
					<div class="input-prepend input-append">
					  <span class="add-on">$</span>
					  <input class="span2" id="appendedPrependedInput" type="text" name="sueldo">
					  <span class="add-on">.-</span>
					</div>
				</div>
				<div class="span1"></div>
			</div>

			<h3>Prom. de remun. por Conv. Colec.</h3>
			<div class="row">
				<div class="span1"></div>
				<div class="span4">
					<div class="input-prepend input-append">
					  <span class="add-on">$</span>
					  <input class="span2" id="appendedPrependedInput" type="text" name="promedio">
					  <span class="add-on">.-</span>
					</div>
				</div>
				<div class="span1"></div>
			</div>


			<h3>Detalle</h3>
			<div class="row">
				<div class="span3 preaviso">Recibio preaviso?</div>
				<div class="span2">
					<div>
						<label class="radio"><span>Si</span><input type="radio" name="preaviso" id="optionsRadios1" value="1"></label>
						<label class="radio"><span>No</span><input type="radio" name="preaviso" id="optionsRadios1" value="0"></label>
					</div>
				</div>
				<div class="span1"></div>
			</div>

			<!--input type="text" class="input-block-level" placeholder="Email address">
			<input type="password" class="input-block-level" placeholder="Password">
			<label class="checkbox">
			<input type="checkbox" value="remember-me"> Remember me
			</label-->
			<hr>
			<button class="btn btn-large btn-primary" type="submit">Calcular!</button>
		</form>
	</div>
	<div class="span3"></div>
</div>

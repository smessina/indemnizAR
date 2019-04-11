<?php
	include("tiempo_transcurrido.php");

	$up_day = $_POST['up_day'];
	$up_month = $_POST['up_month'];
	$up_year = $_POST['up_year'];

	$down_day = $_POST['down_day'];
	$down_month = $_POST['down_month'];
	$down_year = $_POST['down_year'];

	$fecha_ingreso = $up_day."/".$up_month."/".$up_year;
	$fecha_egreso = $down_day."/".$down_month."/".$down_year;

	$tiempo = tiempo_transcurrido($fecha_ingreso, $fecha_egreso);
	$texto = "$tiempo[0] años con $tiempo[1] meses y $tiempo[2] días";

	$anos = $tiempo[0];
	$meses = $tiempo[1];
	$dias = $tiempo[2];

	$sueldos = 0;
	$remuneracion = $_POST['sueldo'];
	$promedio = $_POST['promedio'];
	$preaviso = $_POST['preaviso'];
	$indemnizacion = 0;

	$descripcion = "<div class='span2'></div><div class='result span8'>"; 
	$descripcion .= "<p><strong>Trabajo:</strong> ".$anos." años, ".$meses." meses y ".$dias." dias</p>";
	$descripcion .= "<p><strong>Remuneración:</strong> $".$remuneracion.".-</p>";
	//Calculo sueldos de indemnizacion por anitguedad
	$descripcion.= "<p><strong>Sueldos por antiguedad:</strong> ";
	if($anos >= 1) {
		if($meses > 3):
			$sueldos = $anos + 1;
		endif;
		if($meses == 3):
			if ($dias >= 1) {
				$sueldos = $anos + 1;
			} else {
				$sueldos = $anos;
			}
		endif;
		if($meses < 3):
			$sueldos = $anos;
		endif;
	} else {
		if($meses > 3):
			$sueldos = 1;
		endif;
		if($meses == 3):
			if ($dias >= 1) {
				$sueldos = 1;
			}
		endif;
	}

	if($sueldos > 0){
		
		$descripcion.= $sueldos."</p>";
		
		$tope = $promedio * 3;
		
		$descripcion.= "<p><strong>Tope salarial:</strong> $".$tope.".-</p>";

		if($tope > $remuneracion):
			$indemnizacion = $remuneracion * $sueldos;
			$descripcion.= "<p><strong>Indemnización por antiguedad:</strong> $".$indemnizacion.".-</p>";
		else:
			$indemnizacion = $tope * $sueldos;
			$descripcion.= "<p><strong>Indemnización por antiguedad:</strong> $".$indemnizacion.".-";
			if ($indemnizacion < $remuneracion) {
				$indemnizacion = $remuneracion;
				$descripcion.= " (s/ art. 245 últ. párrafo de LCT, corresponde $ ".$remuneracion.".-)";
			}
			$descripcion .= "</p>";
		endif;
	} else {
		$descripcion.= "<p><strong>No corresponde indemnizacion por despido</p>";
	} 

	if($indemnizacion > 0) {
		//echo $descripcion;
	}

	//SAC proporcional
	if($down_month >= 1 && $down_month <= 6) {
		$semestre = "01/01/".$down_year;
	} else {
		$semestre = "01/07/".$down_year;
	}

	$semestre_trabajado = tiempo_transcurrido($semestre, $fecha_egreso);

	//aca corregir para calcular meses con 28/31
	$dias_trabajados = ($semestre_trabajado[1] * 30) + $semestre_trabajado[2]+1;

	$sac = ceil((($remuneracion/2) * $dias_trabajados) / 182);

	$descripcion .= "<p><strong>SAC:</strong> $".$sac.".- (".$dias_trabajados." dias desde ".$semestre.")</p>";

	//Vacaciones proporcionales
	$ano_actual = "01/01/".$down_year;
	$ano_trabajado = tiempo_transcurrido($ano_actual, $fecha_egreso);
	$dias_ano_trabajados = ($ano_trabajado[1] * 30) + $semestre_trabajado[2]+1;

	$dias_vac_antiguedad;
	if($anos == 0 && $meses <= 6)
	{
		/*$dias_ano_trabajados = ($meses * 30) + $dias;
		$dias_vac_antiguedad = ceil(($dias_ano_trabajados / 20));

		$indem_dias_vac_prop = ceil(($remuneracion * $dias_vac_antiguedad) / 25);

		$descripcion .= "Vacaciones no gozadas:</strong> $".$indem_dias_vac_prop.".-";*/

	} else {
		$ano_actual = "01/01/".$down_year;
		$ano_trabajado = tiempo_transcurrido($ano_actual, $fecha_egreso);
		$dias_ano_trabajados = ($ano_trabajado[1] * 30) + $semestre_trabajado[2]+1;

		if($anos > 0 && $anos <= 5)
		{
			$dias_vac_antiguedad = 14;
		}
		if($anos > 5 && $anos <= 10)
		{
			$dias_vac_antiguedad = 21;
		}
		if($anos > 10 && $anos <= 20)
		{
			$dias_vac_antiguedad = 28;
		}
		if($anos > 20)
		{
			$dias_vac_antiguedad = 35;
		}

		$dias_vac_prop = ceil(($dias_ano_trabajados * $dias_vac_antiguedad) / 365);

		$indem_dias_vac_prop = ceil(($remuneracion * $dias_vac_prop) / 25);

		$descripcion .= "<p><strong>Vacaciones no gozadas:</strong> $".$indem_dias_vac_prop.".-</p>";
	}

	//Mes despido
	if($preaviso == 0) {
		if($anos == 0 && $meses <= 3 && $dias == 0){
			$descripcion .= "<p><strong>Integracion Mes de despido:</strong> No corresponde en período a prueba</p>";
		} else {
			$mes_despedido = "01/".$down_month."/".$down_year;
			$mes_trabajado = tiempo_transcurrido($mes_despedido, $fecha_egreso);
			$mes_despido = ceil(($remuneracion / 30) * ($mes_trabajado[2]+1));
			$descripcion .= "<p><strong>Integracion Mes de despido:</strong> $".$mes_despido.".-</p>";
		}
		
	}

	//Indem. sust. de preaviso
	if($preaviso == 0) {
		$dias_preaviso;
		if($anos == 0 && $meses <= 3)
		{
			$dias_preaviso = 15;
		}
		if($anos < 5)
		{
			$dias_preaviso = 30;	
		}
		if($anos >= 5)
		{
			$dias_preaviso = 60;
		}
		$indem_preaviso = ceil(($remuneracion / 30) * $dias_preaviso);

		$descripcion .= "<p><strong>Indem. sust. de preaviso:</strong> $".$indem_preaviso.".-</p>";
	}
	$descripcion .= "</div><div class='span2'></div>";
	echo $descripcion;

?>
<?php  
require_once(RAIZ.'model/facturas.php');
$objfactura = new Factura();
$value = json_encode(array('id' => $_REQUEST['id']));
$data = json_decode($objfactura->getFactura($value));
$factura = $data[0];
$listProduct = json_decode($objfactura->listProductsFact($value));
$rutaImagen = RAIZ."img/logo.png";
$contenidoBinario = file_get_contents($rutaImagen);
$img = base64_encode($contenidoBinario);
$date = date_create($factura->FECHA);
$date2 = date_format($date, "Y-m-d");
$date = date_format($date, "Y/m/d");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Factura</title>
</head>
<body>
	<style type="text/css">
		*{
			padding: 0;
			box-sizing: border-box;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
		}

		table{
			width: 100%;
			margin: -40px 20px;
		}

		td, th{
			margin: 20px;
			padding: 5px;
		}

		table > tbody > tr > td{
			text-align: center;
		}

		table > thead > tr > th{
			text-align: right;
		}

		.flex{
			height: 100px;			
		}

		img{
			width: 100px;
			float: left;
			margin-left: 150px;
			margin-right: 30px;
		}
	</style>
	<table style="border-collapse: collapse; width: 100%">
		<thead>
			<tr>
				<th colspan="5" style="text-align: center;">MI MEJOR ALTERNATIVA</th>
			</tr>
			<tr>
				<td colspan="5" class="flex">
					<img src="data:image/jpeg;base64,<?=$img?>" alt="img">
					<h1 style="font-size: 30px;font-style: italic;">PC, Barranquilla</h1>			
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: center;">peña cantillo</td>
				<td colspan="3"><b>NIT:</b> <span style="font-style: italic;">1140871108-2</span></td>
			</tr>
			<tr>
				<td colspan="5" style="font-style: italic;"><b>TEL:</b> 3505421568&nbsp;&nbsp;&nbsp;&nbsp;Calle 68 # 26 - 16 Barranquilla - Colombia</td>
			</tr>
			<tr style="font-style: italic;">
				<th>CLIENTE:</th>
				<td><?=$factura->NOMBRE?></td>
				<th>VENDEDOR:</th>
				<td colspan="2"><?=$factura->VENDEDOR?></td>
			</tr>
			<tr style="font-style: italic;">
				<th>NEGOCIO:</th>
				<td><?=$factura->NEGOCIO?></td>
				<th>FECHA:</th>
				<td colspan="2"><?=$date?></td>
			</tr>
			<tr style="font-style: italic;">
				<th>DIRECCION:</th>
				<td><?=$factura->DIRECCION?></td>
				<th>BARRIO:</th>
				<td colspan="2"><?=$factura->BARRIO?></td>
			</tr>
			<tr style="font-style: italic;">
				<th>TELEFONO:</th>
				<td colspan="4"><?=$factura->TELEFONO?></td>
			</tr>
		</thead>
		<tbody style="font-style: italic;">
			<tr>
				<th style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000;">COD</th>
				<th style="border-top: 1px solid #000;border-bottom: 1px solid #000;">PRODUCTO</td>
				<th style="border-top: 1px solid #000;border-bottom: 1px solid #000;">CANTIDAD</th>
				<th style="border-top: 1px solid #000;border-bottom: 1px solid #000;">VALOR/UND</td>
				<th style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;">VALOR/TOTAL</td>			
			</tr>
			<?php
			$total = 0;
			foreach ($listProduct as $list) {
				$total = $total+$list->TOTAL;
				echo "<tr>";
				echo "<td>".$list->CODIGO."</td>";
				echo "<td style='width: 280px;text-align: left;'>".$list->NOMBRE."</td>";
				echo "<td>".$list->CANTIDAD."</td>";
				echo "<td>$".number_format($list->PRECIO)."</td>";
				echo "<td>$".number_format($list->TOTAL)."</td>";
				echo "</tr>";
			}
			?>
			<tr>
				<td colspan="4" style="text-align: left;text-decoration: underline;">Esta factura se asimila  Una letra de cambio según el art. 773.774 del codigo de comercio</td>
				<td style="border: 1px solid #000;font-weight: bold;">$<?=number_format($total)?></td>
			</tr>
		</tbody>
	</table>	
</body>
</html>

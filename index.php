<?php
	session_name("gestion_op"); 
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/orden_servicio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.TITULOS {
background-color:#339966;
display:block;
color:#FFFFFF;
height:30px;
font-weight:600;
font-size: 20px; 
}

.TITULOFRM {
background-color:#CCCCCC;
display:block;
color:#FFFFFF;
height:30px;
font-weight:600;
font-size: 25px; 
}

-->
</style>
<?php include('../../../titulo.php');?>
<title><?php echo $descrip_app . " - " . $version_app;?> | Orden de Servicio </title>
<title><?php echo "8.1.CSoft-Ord.Previas |".$descrip_app . " - " . $version_app;?></title>

<script language="JavaScript" type="text/javascript">
function buscaros() //OK
{
	if(document.frmOS.txtnumdoc.value=="")
		{
		document.getElementById('iframe1').src="mostrar_consec_os.php";
		}
	else
		{
		document.getElementById('iframe1').src="buscar_os.php?num="+document.frmOS.txtnumdoc.value;
		}
}

function ifEnterMoveFocus(evt,objsf) //OK
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ( charCode == 13) 
	{
	document.getElementById(objsf).focus();
	return true
	}
}

function ifEnter(evt,obj) //OK
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ( charCode == 13) 
	{
	if(obj=="txtval")
		{
		llevadetalle();
		}
	if(obj=="txtnumdoc")
		{
		buscaros();
		}
	return true
	}
}

function quitar_formato_num(num)
{
	newnum = "";
	for(u=0;u<num.length;u++)
		{
		if(num.substr(u,1) != "." && num.substr(u,1) != ",")
			{
			newnum = newnum + num.substr(u,1);
			}
		}
	return newnum;
}

function llevadetalle() //OK
{
	//PENDIENTE VALIDAR LOS CAMPOS

	concept = document.getElementById('txtconcept').value;
	descconcept = document.getElementById('txtdesc').value;
	facts = document.getElementById('txtfact').value;

	document.getElementById('iframe1').src="adicionar_detalle.php?concept="+concept+"&descconcept="+descconcept+"&txtfact="+php_urlencode(facts);
}

function verifdatamodif()
{
	if(document.frmOS.txtnumdoc.value == "")
		{
		alert("El campo O.S. NUM. no puesde estar vacio");
		return false;		
		}
	if(document.frmOS.txtfecha.value == "")
		{
		alert("El campo FECHA no puesde estar vacio");
		return false;		
		}
	if(document.frmOS.txtrespon.value == "")
		{
		alert("El campo RESPONSABLE no puesde estar vacio");
		return false;		
		}
	if(document.frmOS.txthi.value == "")
		{
		alert("El campo HORA I. no puesde estar vacio");
		return false;		
		}
	if(document.frmOS.txthf.value == "")
		{
		alert("El campo HORA F. no puesde estar vacio");
		return false;		
		}

	document.forms["frmOS"].action='modificar_os.php';
	document.forms["frmOS"].submit();
}

function limpiarform() //OK
{
	document.frmOS.txtnumdoc.value = '';
	document.frmOS.txtrespon.value = "";
	document.frmOS.txtfecha.value = "<?php echo date("d/m/Y")?>";
	document.frmOS.txthi.value = "";
	document.frmOS.txthf.value = "";
	document.frmOS.txtplaca.value = "";
	document.frmOS.txtsello.value = "0";
	document.frmOS.txtequipo.value = "0";

	document.frmOS.txtconcept.value = "";
	if(document.frmOS.txtdesc){document.frmOS.txtdesc.value = ""};
	document.frmOS.txtfact.value = "";

	document.getElementById('txtnumdoc').readOnly=false
	document.getElementById('cmdmodif').disabled='disabled';
	document.getElementById('cmdinsertar').disabled=false;

	document.getElementById('iframedetalle').src='about:blank';
	document.getElementById('iframe1').src="limpiar_det_os.php";
}

function verifdata()
{
	if(document.frmOS.txtfecha.value == "")
		{
		alert("El campo FECHA no puesde estar vacio");
		return false;		
		}
	if(document.frmOS.txtrespon.value == "")
		{
		alert("El campo RESPONSABLE no puesde estar vacio");
		return false;		
		}
	if(document.frmOS.txtplaca.value == "")
		{
		alert("El campo PLACA no puesde estar vacio");
		return false;		
		}
	if(document.frmOS.txthi.value == "")
		{
		alert("El campo HORA I. no puesde estar vacio");
		return false;		
		}
	if(document.frmOS.txthf.value == "")
		{
		alert("El campo HORA F. no puesde estar vacio");
		return false;		
		}

document.forms["frmOS"].action='grabar_os.php';
document.forms["frmOS"].submit();
}

function valida_solo_num(cadena, obj, e) // ie, ff
{
	opc = false;
	tecla = (document.all) ? e.keyCode : e.which;
	if (cadena == "%d")
		if (tecla > 47 && tecla < 58)
			opc = true;
		if (tecla == 8) //permite BackSpace
			opc = true;
		if (tecla == 0) //permite tab, teclas de funcion
			opc = true;
	if (cadena == "%f")
		{
		if (tecla > 47 && tecla < 58)
			opc = true;
		if (tecla == 8) //permite BackSpace
			opc = true;
		if (tecla == 0) //permite tab, teclas de funcion
			opc = true;
		if (obj.value.search("[.*]") == -1 && obj.value.length != 0)
			if (tecla == 46) //permite punto
				opc = true;
		}
	if (cadena == "%h")
		{
		if (tecla > 47 && tecla < 58)
			opc = true;
		if (tecla == 8) //permite BackSpace
			opc = true;
		if (tecla == 0) //permite tab, teclas de funcion
			opc = true;
		if (obj.value.search("[.*]") == -1 && obj.value.length != 0)
			if (tecla == 58) //Permite : "dos puntos"
				opc = true;
		}
	return opc;
}

function carga_desc(indice)
{
	var str = document.frmOS.txtconcept.options[indice].text;
	var str1 = new Array();
	str1 = str.split("-");

	document.frmOS.txtdesc.value = str1[1].replace(/^\s*|\s*$/g,""); //Trim
}

function Abrir_ventana (pagina,w,h) 
{
	var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width="+w+", height="+h+", top=85, left=140";
	window.open(pagina,"",opciones);
}

function MostrarFact()
{
	if(document.frmOS.txtconcept.value!="'1'")
		{
		Abrir_ventana('listar_facturas.php?txtfecha1='+document.frmOS.txtfecha.value+'&amp;txtfecha2='+document.frmOS.txtfecha2.value,'600','400');
		}
	else
		{
		Abrir_ventana('listar_consolidados_tat.php?txtfecha1='+document.frmOS.txtfecha.value+'&amp;txtfecha2='+document.frmOS.txtfecha2.value,'600','400');
		}
}

//*****************************************************************************************************************************
function php_urlencode (str)
{
	str = escape(str);
	return str.replace(/[*+\/@]|%20/g,
	function (s) 
	{
		switch (s) 
		{
			case "*": s = "%2A"; break;
			case "+": s = "%2B"; break;
			case "/": s = "%2F"; break;
			case "@": s = "%40"; break;
			case "%20": s = "+"; break;
		}
		return s;
	}
	);
}
//***************************************************************************************************************
</script>

<link rel="stylesheet" media="screen" type="text/css" href="../../../js/dtp_es/css/dtp_es.css" />
<script type="text/javascript" src="../../../js/dtp_es/js/dtp_es.js"></script>
</head>

<body>
<form method="post" name="frmOS" id="frmOS" target="iframe1">

<span class="TITULOFRM" >SOL&SOFT - Orden de Servicio Previa </span>
<br />
<table width="100%" border="0" style="border:#999999 1px solid" cellspacing="0">
  <tr>
    <td colspan="6" style="background-color:#339966;"><span class="TITULOS">DATOS ENCABEZADO </span></td>
	<td align="right" style="background-color:#339966;"><span><a href="../../../_modulos/main_frm/" style="font-size:10px;text-decoration:none;color:#FFFFFF;">Menu Ppal</a></span></td>
  </tr>
  <tr>
    <td width="9%" align="right">O.S. NUM.</td>
    <td colspan="2"><input type="text" name="txtnumdoc" id="txtnumdoc" alt="O.S. NUM." style="width:100px" maxlength="45" onkeydown=" javascript:return ifEnter(event,'txtnumdoc')" />
      <a href="#" onclick="buscaros()"><img border="0" src="../../../imagenes/buscar.png" width="16" height="16" /></a></td>
    <td width="5%" align="right">FECHA</td>
    <td width="13%"><input name="txtfecha" id="txtfecha" type="text" size="10" readonly="" value="<?php echo date("d/m/Y")?>"><a href="#" onclick="displayDatePicker('txtfecha');"><img src="../../../js/dtp_es/cal.gif" width="16" height="16" border="0" alt="Seleccione la Fecha"></a>	</td>
    <td width="10%" align="right">FECHA2</td>
    <td width="28%"><!--<input name="txtrespon1" id="txtrespon1" alt="RESPONSABLE" type="text" maxlength="60" style="width:190px" />-->	<input name="txtfecha2" id="txtfecha2" type="text" size="10" readonly="" value="<?php echo date("d/m/Y")?>" />
      <a href="#" onclick="displayDatePicker('txtfecha2');"><img src="../../../js/dtp_es/cal.gif" width="16" height="16" border="0" alt="Seleccione la Fecha" /></a></td>
  </tr>
  <tr>
    <td align="right">PLACA </td>
	<td colspan="2"><?php
		include('../../../conexion_qclick3.php');
		$result=mysql_query("Select * From vehiculos order by Placa",$enlace) ;
		$rows=mysql_num_rows($result);
		$contador=0;?>
		<select name="txtplaca" id="txtplaca" style="width:250px" >
			<option value="">--------------</option><?php
				while($contador < $rows)
					{?>
					<option value="<?php echo mysql_result($result,$contador,"Placa");?>"><?php echo mysql_result($result,$contador,"Placa") . " - " . mysql_result($result,$contador,"Vehiculo"); ?></option><?php
					$contador++;
					}?>
	    </select></td>
	<td align="right">Hora I. </td>
    <td><input type="text" name="txthi" alt="HORA INICIAL" id="txthi" style="width:100px" maxlength="5" onKeyPress="return valida_solo_num('%f', this, event);"/></td>
    <td align="right">Hora F. </td>
    <td><input type="text" name="txthf" id="txthf" alt="HORA FINAL" style="width:100px" maxlength="5" onKeyPress="return valida_solo_num('%f', this, event);"/></td>
  </tr>
  <tr>
    <td align="right">LLEVA</td>
    <td width="12%" align="right">SELLO: 
      <input name="txtsello" id="txtsello" style="width:25px" type="text" value="0" /></td>
    <td align="center" width="23%">EQUIPO: 
      <input name="txtequipo" id="txtequipo" style="width:25px" type="text" value="0" /></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>RESPONSABLE</td>
    <td><?php
		include('../../../conexion_qclick.php');
		$result=mysql_query("select * from vendedores WHERE Tipo='T' ORDER by NomVendedor",$enlace) ;
		$rows=mysql_num_rows($result);
		$contador=0;?>
      <select name="txtrespon" id="txtrespon" style="width:230px;" >
        <option value="">--------------</option>
        <?php
				while($contador < $rows)
					{?>
        <option value="<?php echo mysql_result($result,$contador,"NomVendedor");?>"><?php echo mysql_result($result,$contador,"CodVendedor") . " - " . mysql_result($result,$contador,"NomVendedor"); ?></option>
        <?php
					$contador++;
					}?>
      </select></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<table width="100%" border="0" style="border:#999999 1px solid">
  <tr>
    <td colspan="8"><span class="TITULOS">DETALLE</span></td>
  </tr>
  <tr>
    <td width="2%" align="right"></td>
    <td width="30%">
		CONCEPTO&nbsp;&nbsp;&nbsp;
		<!--<input type="text" name="txt_tipo_concept" id="txt_tipo_concept" style="width:10px" disabled="disabled" />
		<input type="text" name="txt_grupo_concept" id="txt_grupo_concept" style="width:18px" disabled="disabled" />-->
	</td>
    <td width="2%" align="right"></td>
    <td width="35%">DESCRIPCION</td>
    <td width="23%" align="right">Facturas</td>
    <td width="3%"><!--VALOR--></td>
    <td width="2%" align="right"></td>
    <td width="3%">&nbsp;</td>
  </tr>
  <tr>
    <td width="2%" align="right"></td>
    <td width="30%"><?php
		include('../../../conexion_gestion_op.php');
		$result=mysql_query("select * from p_conceptos order by convert(cod_concept, SIGNED)",$enlace) ;
		$rows=mysql_num_rows($result);
		$contador=0;?>
		<select name="txtconcept" id="txtconcept" style="width:250px" onchange="carga_desc(document.frmOS.txtconcept.selectedIndex )" >
				<option value="">--------------</option><?php
					while($contador < $rows)
						{?>
						<option value="<?php echo mysql_result($result,$contador,"cod_concept");?>"><?php echo mysql_result($result,$contador,"cod_concept") . " - " . mysql_result($result,$contador,"desc_concept"); ?></option><?php
						$contador++;
						}?>
	    </select><!--<img src="../../../imagenes/buscar.png" />-->
	</td>
    <td width="2%" align="right"></td>
    <td width="35%">
		<span id="span_obj_desc"><input type="text" name="txtdesc" id="txtdesc" style="width:320px" maxlength="255" /></span>
	</td>
    <td width="23%" align="right"><input type="text" name="txtfact" id="txtfact" style="width:200px" readonly="" /></td>
    <td width="3%"><!--<input type="text" name="txtval" id="txtval" style="width:100px;text-align:right" maxlength="20" onkeyup=" javascript:return ifEnter(event,'txtval')" onKeyPress="return valida_solo_num('%f', this, event);" />-->
      <input type="button" name="cargafact" id="cargafact" value="..." onclick="MostrarFact()" /></td>
    <td width="2%" align="right"><a onclick="llevadetalle()" style="cursor:pointer"><img src="../../../imagenes/next.png" /></a></td>
    <td width="3%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" >
		<iframe name="iframedetalle" id="iframedetalle" width="99%" height="160" scrolling="auto"></iframe>
	</td>
  </tr>
  <tr>
    <td colspan="9" align="right"><!--<input type="text" name="txttotal_p" id="txttotal_p" style="width:200px;text-align:right;font-size:16px" readonly="" />-->&nbsp;&nbsp;<!--<input type="text" name="txttotal_n" id="txttotal_n" style="width:200px;text-align:right;font-size:16px" readonly="" />-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<br /><br />
	<!--NETO <input type="text" name="txttotal_neto" id="txttotal_neto" style="width:200px;text-align:right;font-size:16px" readonly="" />-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
  	<td>&nbsp;</td>
  	<td align="center">
		<input type="button" onclick="limpiarform()" name="cmdlimpiar" id="cmdlimpiar" value="Limpiar" />	
		<input type="button" onclick="verifdata()" name="cmdinsertar" id="cmdinsertar" value="Ingresar" />
		<input type="button" onclick="verifdatamodif()" name="cmdmodif" id="cmdmodif" value="Modificar" disabled="disabled"/>
		<input type="button" name="cmdimprimirdir" id="cmdimprimirdir" value="Imprimir Ultima O.S." onclick="javascript:document.getElementById('iframe1').src='imprimir_frm_directo.php'" />
		<input type="button" name="cmdimprimir" id="cmdimprimir" value="Imprimir ..." onclick="Abrir_ventana('imprimir_frm.php','320','100')" />
	</td>
  	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<iframe name="iframe1" id="iframe1" width="100%" height="200px" scrolling="auto"></iframe>
<?php echo "<script>window.parent.document.getElementById('iframedetalle').src='mostrar_detalle.php';</script>";?>
</form>
</body>
</html>

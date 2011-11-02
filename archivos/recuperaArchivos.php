<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>:: CUESTIONARIO ::</title>
<script language="javascript" src="../ajax/core.js"></script>
<script language="javascript">
	function llamado(p)
	{
		//drp es d=demon,rp realplayer
		invocaGenericoPost("demon","../demon.php","drp="+p,"Cargando al sistema nuevos archivos cargados...");
	}
</script>
<link href="../INDEX.CSS" rel="stylesheet" type="text/css">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body leftmargin="0" topmargin="0" background="../imagenes/fondo2.jpg" > 
<table width="100%" height="100%" cellpadding="0" cellspacing="0">

 <tr>
  <td width="104"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
  <td width="16" background="../imagenes/fondo3.jpg"></td>
  <td width="751" bgcolor="white" valign="top">
   <table width="100%" height="100%" cellpadding="0" cellspacing="0">
    <!-- banner superior -->
    <tr>
	 <td class="body-text1" height="120"><img src="../imagenes/titulo.jpg" width="751" height="120"></td> 
	</tr>

    <!-- menu superior -->
    <tr>
	 <td class="body-text1"  height="20" align="right"> 
	  <table width="100%" cellpadding="0" cellspacing="0">
	   <tr>
		<td width="10"><img src="../imagenes/spacer.gif" width="1" height="1"></td>	   
	    <td align="left">
		</td>
	    <td class="body-text1" width="220">
		</td>
	    <td width="10"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
	   </tr>
	  </table>
	 </td>
	</tr>
	

    <!-- zona central -->
    <tr>
	 <td class="body-text1" valign="top" background="../imagenes/fondoPAGINA.jpg">
	  <table cellpadding="5" cellspacing="1" width="100%" height="100%">
	   <tr>
	    <td  height="1"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
	   </tr>
	   <tr>
		<td class="body-text1"  valign="top" align="left">
	      <table width="198">
		   <tr>
		    <td width="16" class="body-text1" >
			 <img src="../imagenes/iconos/regresar.png" width="16" height="16">
			</td>
		    <td width="170" class="body-text1" >
			 <a href="listarArchivos.php" style="color:red">Listar archivos</a>
			</td>
		   </tr>
		  </table>
		  <br>
		  <b>::Recupera Archivos </b> 
		  <br>
          <div id="demon">Encontrar nuevos archivos  haciendo clic en el siguiente bot&oacute;n&nbsp;&nbsp;&nbsp;
              <input name="cargar" type="submit" class="botonfiltro" id="cargar" value="cargar" onClick="javascript:llamado(0);">
              <br>
              <br>
              &oacute;
              <br>
              <br>
              Encuentre nuevos archivos y protejalos contra el plug In de real player <input name="cargar2" type="submit" class="botonfiltro" id="cargar2" value="Cargar" onClick="javascript:llamado(1);">

          </div>
		  </td>
	   </tr>
	   <tr>
	    <td  height="10"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
	   </tr>
	  </table>
	 </td>
	</tr>
	<!-- footer -->
    <tr>
	 <td  background="../imagenes/seccion.jpg" class="body-text1" height="20" align="center">
	 </td>
	</tr>
   </table>
  </td>
  <td width="13" background="../imagenes/fondo4.jpg">
  </td>
  <td><img src="../imagenes/spacer.gif" width="1" height="1"></td>
 </tr>
 <tr>
  <td colspan="5" height="50"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
 </tr>
</table>
</body>
</html>


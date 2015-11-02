<?php

/**
 * Modulo de integración entre WHMcs y CuentaDigital
 * Cortesia de Duplika: https://www.duplika.com
 * copiar este archivo en whmcs/modules/gateways/ (reemplazar por la carpeta en donde está el sistema whmcs)
 */

$GATEWAYMODULE["cuentadigitalname"]="cuentadigital";
$GATEWAYMODULE["cuentadigitalvisiblename"]="CuentaDigital";
$GATEWAYMODULE["cuentadigitaltype"]="Invoices";

function cuentadigital_activate() {
	defineGatewayField("cuentadigital","text","idcuentadigital","","Id","4","Ej.: 1234 ");
	defineGatewayField("cuentadigital","text","sitio", "","Sitio","","Ej.: MiEmpresa.com");
	defineGatewayField("cuentadigital","text","email", "","Mail","","Ej.: ventas@miempresa.com");
	defineGatewayField("cuentadigital","text","diasvence","","Vencimiento de las Boletas","","Ej.: 30 (expresar en d&iacute;as)");
	defineGatewayField("cuentadigital","yesno","testmode","","Test Mode","","");
	defineGatewayField("cuentadigital","text","gateway_control","","Gateway control ID","","");
	defineGatewayField("cuentadigital","text","whmcs_api_user","","WHMCS API Username","","");
	defineGatewayField("cuentadigital","text","whmcs_api_pass","","WHMCS API Password","","");
	defineGatewayField("cuentadigital","text","whmcs_api_accesskey","","WHMCS API Access Key","","");
}

function cuentadigital_link($params) {
# Gateway Specific Variables
$gatewayidcuentadigital = $params['idcuentadigital'];
$gatewaysitio = $params['sitio'];
$gatewayemail = $params['email'];
$gatewaydiasvence = $params['diasvence'];
$gatewaytestmode = $params['testmode'];
# Invoice Variables
$invoiceid = $params['invoiceid'];
$description = $params["description"];
$amount = $params['amount'];
$duedate = $params['duedate'];
# Client Variables
$firstname = $params['clientdetails']['firstname'];
$lastname = $params['clientdetails']['lastname'];
$email = $params['clientdetails']['email'];
$address1 = $params['clientdetails']['address1'];
$address2 = $params['clientdetails']['address2'];
$city = $params['clientdetails']['city'];
$state = $params['clientdetails']['state'];
$postcode = $params['clientdetails']['postcode'];
$country = $params['clientdetails']['country'];
$phone = $params['clientdetails']['phone'];
# System Variables
$companyname = $params['companyname'];
$systemurl = $params['systemurl'];
$currency = $params['currency'];
# End of Variables


$code = '<p>Abone su factura con Pago Facil, Rapipago, Bapropagos o con CuentaDigital</p>

<FORM target=_blank action="https://www.cuentadigital.com/string.php" METHOD="get">
<p><input type="submit" value="Imprimir cupon de pago"></p>
<input type="hidden" value="'.$gatewayidcuentadigital.'" name="id">
<input type="hidden" value="'.$invoiceid.'" name="codigo">
<input type="hidden" value="'.$amount.'" name="precio">
<input type="hidden" value="'.$gatewaydiasvence.'" name="venc">
<input type="hidden" value="'.$gatewaysitio.'" name="site">
<input type="hidden" value="'.$gatewayemail.'" name="desde">
<input type="hidden" value="'.$email.'" name="hacia">
<input type="hidden" value="'.$gatewaytestmode.'" name="testmode">
<input type="hidden" value="Pago por Factura #'.$invoiceid.'" name="concepto"></form>';

return $code;

}

?>

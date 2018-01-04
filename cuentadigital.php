<?php
/*
 * Payment Gateway Module: CuentaDigital
 * Developer: Sufi
 */
//no direct access for this file
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

//gateway configuration
function cuentadigital_config() {
    $configarray = array(
        "FriendlyName" => array(
            "Type" => "System",
            "Value" => "CuentaDigital"
        ),
        "idcuentadigital" => array(
            "FriendlyName" => "ID",
            "Type" => "text",
            "Size" => "4",
            "Description" => "Ej.: 1234",
        ),
        "sitio" => array(
            "FriendlyName" => "Sitio",
            "Type" => "text",
            "size" => "100",
            "Description" => "Ej.: MiEmpresa.com",
        ),
        "email" => array(
            "FriendlyName" => "Mail",
            "Type" => "text",
            "size" => "100",
            "Description" => "Ej.: ventas@miempresa.com",
        ),
        "diasvence" => array(
            "FriendlyName" => "Vencimiento de las Boletas",
            "Type" => "text",
            "size" => "100",
            "Description" => "Ej.: 30 (expresar en d&iacute;as)",
        ),
        "gateway_control" => array(
            "FriendlyName" => "Gateway control ID",
            "Type" => "text",
            "size" => "100",
        ),
        "whmcs_api_user" => array(
            "FriendlyName" => "WHMCS API Username",
            "Type" => "text",
            "size" => "50",
        ),
        "testmode" => array(
            "FriendlyName" => "Test Mode",
            "Type" => "yesno",
            "Description" => "Tick this to enable test mode",
        ),
    );
    return $configarray;
}

function cuentadigital_link($params) {
    //Gateway Specific Variables
    $gatewayidcuentadigital = $params['idcuentadigital'];
    $gatewaysitio = $params['sitio'];
    $gatewayemail = $params['email'];
    $gatewaydiasvence = $params['diasvence'];
    $gatewaytestmode = $params['testmode'];

    //Invoice Variables
    $invoiceid = $params['invoiceid'];
    $description = $params["description"];
    $amount = $params['amount'];
    $duedate = $params['duedate'];

    //Client Variables
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

    //System Variables
    $companyname = $params['companyname'];
    $systemurl = $params['systemurl'];
    $currency = $params['currency'];

    //code submit to the gateway
    $code = '<p>Abone su factura con Pago Facil, Rapipago, Bapropagos o con CuentaDigital</p>
            <FORM target=_blank action="https://www.cuentadigital.com/string.php" METHOD="get">
            <p><input type="submit" value="Imprimir cupon de pago"></p>
            <input type="hidden" value="' . $gatewayidcuentadigital . '" name="id">
            <input type="hidden" value="' . $invoiceid . '" name="codigo">
            <input type="hidden" value="' . $amount . '" name="precio">
            <input type="hidden" value="' . $gatewaydiasvence . '" name="venc">
            <input type="hidden" value="' . $gatewaysitio . '" name="site">
            <input type="hidden" value="' . $gatewayemail . '" name="desde">
            <input type="hidden" value="' . $email . '" name="hacia">
            <input type="hidden" value="' . $gatewaytestmode . '" name="testmode">
            <input type="hidden" value="Pago por Factura #' . $invoiceid . '" name="concepto"></form>';

    return $code;
}

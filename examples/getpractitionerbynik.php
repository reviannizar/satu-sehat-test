<?php
/*
*/

// tes service localhost
define('_FHIR_BASE_URL_','http://dhiya/emr/rest.php/api/fhir/v1');
define('_FHIR_AUTH_URL_','http://dhiya/emr/rest.php/api/oauth2/v1');

require_once dirname(__DIR__) . '/fhir.php';
$out=fhir::request('practitioner?identifier=https://fhir.kemkes.go.id/id/nik|3313096403900009', 'GET');

echo json_encode($out);
header('Content-Type: application/json');


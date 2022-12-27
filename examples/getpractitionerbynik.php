<?php

require_once dirname(__DIR__) . '/fhir.php';
$out=fhir::request('Practitioner?identifier=https://fhir.kemkes.go.id/id/nik|3313096403900009', 'GET');

echo json_encode($out);
header('Content-Type: application/json');


<?php

require_once dirname(__DIR__) . '/fhir.php';
$out=fhir::request('Patient?identifier=https://fhir.kemkes.go.id/id/nik|9204014804000002', 'GET');

echo json_encode($out);
header('Content-Type: application/json');


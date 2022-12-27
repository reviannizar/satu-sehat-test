<?php

require_once dirname(__DIR__) . '/fhir.php';
$body=<<<BODY
{
    "resourceType": "Organization",
    "active": true,
    "identifier": [
        {
            "use": "official",
            "system": "http://sys-ids.kemkes.go.id/organization/10000004",
            "value": "R220001"
        }
    ],
    "type": [
        {
            "coding": [
                {
                    "system": "http://terminology.hl7.org/CodeSystem/organization-type",
                    "code": "dept",
                    "display": "Hospital Department"
                }
            ]
        }
    ],
    "name": "Rawat Jalan Terpadu",
    "telecom": [
        {
            "system": "phone",
            "value": "+6221-783042654",
            "use": "work"
        },
        {
            "system": "email",
            "value": "rs-satusehat@gmail.com",
            "use": "work"
        },
        {
            "system": "url",
            "value": "www.rs-satusehat@gmail.com",
            "use": "work"
        }
    ],
    "address": [
        {
            "use": "work",
            "type": "both",
            "line": [
                "Jalan Jati Asih"
            ],
            "city": "Jakarta",
            "postalCode": "55292",
            "country": "ID",
            "extension": [
                {
                    "url": "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                    "extension": [
                        {
                            "url": "province",
                            "valueCode": "31"
                        },
                        {
                            "url": "city",
                            "valueCode": "3171"
                        },
                        {
                            "url": "district",
                            "valueCode": "317101"
                        },
                        {
                            "url": "village",
                            "valueCode": "31710101"
                        }
                    ]
                }
            ]
        }
    ],
    "partOf": {
        "reference": "Organization/10000004"
    }
}
BODY;

$out=fhir::request('Organization', 'GET',$body);

echo json_encode($out);
header('Content-Type: application/json');


<?php

require_once dirname(__DIR__) . '/fhir.php';
$body=<<<BODY
{
    "resourceType": "Location",
    "identifier": [
        {
            "system": "http://sys-ids.kemkes.go.id/location/1000001",
            "value": "G-2-R-1A"
        }
    ],
    "status": "active",
    "name": "Ruang 1A IRJT",
    "description": "Ruang 1A, Poliklinik Bedah Rawat Jalan Terpadu, Lantai 2, Gedung G",
    "mode": "instance",
    "telecom": [
        {
            "system": "phone",
            "value": "2328",
            "use": "work"
        },
        {
            "system": "fax",
            "value": "2329",
            "use": "work"
        },
        {
            "system": "email",
            "value": "second wing admissions"
        },
        {
            "system": "url",
            "value": "http://sampleorg.com/southwing",
            "use": "work"
        }
    ],
    "address": {
        "use": "work",
        "line": [
            "Gd. Prof. Dr. Sujudi Lt.5, Jl. H.R. Rasuna Said Blok X5 Kav. 4-9 Kuningan"
        ],
        "city": "Jakarta",
        "postalCode": "12950",
        "country": "ID",
        "extension": [
            {
                "url": "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                "extension": [
                    {
                        "url": "province",
                        "valueCode": "10"
                    },
                    {
                        "url": "city",
                        "valueCode": "1010"
                    },
                    {
                        "url": "district",
                        "valueCode": "1010101"
                    },
                    {
                        "url": "village",
                        "valueCode": "1010101101"
                    },
                    {
                        "url": "rt",
                        "valueCode": "1"
                    },
                    {
                        "url": "rw",
                        "valueCode": "2"
                    }
                ]
            }
        ]
    },
    "physicalType": {
        "coding": [
            {
                "system": "http://terminology.hl7.org/CodeSystem/location-physical-type",
                "code": "ro",
                "display": "Room"
            }
        ]
    },
    "position": {
        "longitude": -6.23115426275766,
        "latitude": 106.83239885393944,
        "altitude": 0
    },
    "managingOrganization": {
        "reference": "Organization/10000004"
    }
}
BODY;

$out=fhir::request('Location', 'GET',$body);

echo json_encode($out);
header('Content-Type: application/json');


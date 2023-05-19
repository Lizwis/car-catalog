<?php

namespace App\Http\Controllers;

use SoapClient;

class SoapController extends Controller
{

    public function index(): object
    {

        $xmlData = $this->makeSoapRequest();

        $xml = simplexml_load_string($xmlData);

        $data = $this->resourceDataStructure($xml);

        $soapResourceCollection = collect($data);

        return response()->json($soapResourceCollection, 200);
    }

    private function makeSoapRequest(): String
    {
        $wsdlUrl = 'http://www.autobid.co.za/halfway/vehicledetails.php?wsdl';
        $client = new SoapClient($wsdlUrl);

        $username = 'spwf87';
        $password = 'hk8*9jd';

        $response = $client->getVehicleDetails($username, $password);
        $xmlData = str_replace(['<![CDATA[', ']]>'], '', $response);

        $encodedXml = preg_replace('/&(?!amp;)/', 'and', $xmlData);

        return $encodedXml;
    }

    private function resourceDataStructure(object $xml): array
    {

        $vehicles = [];

        foreach ($xml->VEHICLE as $vehicleElement) {
            $vehicle = [
                'id' => (string)$vehicleElement->ID,
                'vin' => (string)$vehicleElement->VIN,
                'plate' => (string)$vehicleElement->REGISTRATION,
                'engine' => (string)$vehicleElement->ENGINE,
                'mileage' => (float)$vehicleElement->MILEAGE,
                'color' => (string)$vehicleElement->COLOUR,
                'year' => (int)$vehicleElement->YEAR,
                'photos' => [(string)$vehicleElement->PHOTO1, (string)$vehicleElement->PHOTO2, (string)$vehicleElement->PHOTO3, (string)$vehicleElement->PHOTO4, (string)$vehicleElement->PHOTO5],
                'make' => (string)$vehicleElement->MAKE,
                'model' => (string)$vehicleElement->MODEL,
                'mmcode' => (string)$vehicleElement->MMCODE,
                'price' => (float)$vehicleElement->RATIFIEDPRICE,
                'incolor' => (string)$vehicleElement->INTERIORCOLOUR,
                'extras' => (string)$vehicleElement->EXTRAS,
                'service_history' => (string)$vehicleElement->SERVICEHISTORY,
            ];


            $vehicles[] = $vehicle;
        }

        return $vehicles;
    }
}

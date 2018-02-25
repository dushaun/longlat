<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl\Curl;

class GoogleMapsController extends Controller
{
    /**
     * Get coordinates for address
     *
     * @param array $data
     * @return void
     */
    public function getCoordinates(array $data)
    {
        $params = "";
        $collection = collect($data);

        foreach($data as $key => $value) {
            if ($value == $collection->first()) {
                $params .= urlencode($value) . ",";
            } else if ($value == $collection->last()) {
                $params .= "+" . urlencode($value);
            } else {
                $params .= "+" . urlencode($value) . ",";
            }
        }

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $params . "&key=" . env('GOOGLE_MAPS_API_KEY');
        
        $curl = new Curl();
        $curl->get($url);

        if ($curl->error) {
            return null;
        } else {
            $result = collect(json_decode($curl->response, true));
            $coordinates = $result['results'][0]['geometry']['location'];
        }

        return [
            'latitude' => $coordinates['lat'],
            'longitude' => $coordinates['lng']
        ];
    }
}

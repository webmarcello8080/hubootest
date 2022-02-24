<?php

// call the api and return result
// translate json to object and return it
// XX44SDF
// WV65KPY
// LS52LHE
// LB07ZYR
// WP21XOE
// YF21NBJ
class DVLAApi
{
   private $api_key = 'HybH0yr4Hj3eEgybT9pkn6B7PA769YDa8kt4wKdp';

   public function checkRegistration($registration_number)
   {
      $url = "https://beta.check-mot.service.gov.uk/trade/vehicles/mot-tests?registration=" . $registration_number;

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $headers = array(
         'x-api-key: ' . $this->api_key,
         'Content-Type: application/json',
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      //for debug only!
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      $response = curl_exec($curl);
      $obj = json_decode($response);
      curl_close($curl);

      return $obj;
   }
}

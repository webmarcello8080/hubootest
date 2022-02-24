<?php

class Core
{
   private $validation;
   private $api;

   public function __construct()
   {
      $this->validation = new Validation;
      $this->api = new DVLAApi;
   }

   // check if post is set and display view based on $_POST
   public function init($data)
   {
      if (isset($data['submit'])) {
         // validate $data
         $validated = $this->validation->validate($data);

         // check validation
         if ($validated) {
            // call api
            $api_result = $this->api->checkRegistration($data['registration']);
            $result = $this->manageResponse($api_result);
            // API didn't have a positive result
            if ($result['status'] != 200) {
               $error_message = $result['message'];
               include('views/error-message.php');
            } else {
               // success - display result
               include('views/display-result.php');
            }
         } else {
            // display error message if validation failed
            $error_message = 'Error! The registration number is not a valid UK registration number';
            include('views/error-message.php');
         }
      } else {
         include('views/check-registation-form.php');
      }
   }

   // manage API response and render an array suitable for HTML
   private function manageResponse($response)
   {
      if (isset($response->httpStatus)) {
         // registration is not valid or car doesn't have MOT records
         $result['status'] = $response->httpStatus;
         $result['message'] = $response->errorMessage;
      } else {
         // positive result, manage response
         $result['status'] = '200';
         $result['registration'] = $response[0]->registration;
         $result['make'] = $response[0]->make;
         $result['model'] = $response[0]->model;
         $result['colour'] = $response[0]->primaryColour;
         // check if the CAR doesn't have any MOT yet
         if (isset($response[0]->motTests)) {
            $result['expiryDate'] = $response[0]->motTests[0]->expiryDate;
            $result['countFaild'] = $this->countFailed($response[0]->motTests);
         } else {
            $result['expiryDate'] = $response[0]->motTestExpiryDate;
            $result['countFaild'] = '0';
         }
      }

      return $result;
   }

   // count the number of failed mot from mot array
   private function countFailed($mot_array)
   {
      $count = 0;
      foreach ($mot_array as $mot) {
         if ($mot->testResult == 'FAILED') {
            $count++;
         }
      }

      return $count;
   }
}

<?php

class Validation
{
   // check if the input is valid
   // through regular expression check if the registration number is valid
   // return true if valid, false otherwise
   public function validate($data)
   {
      // I am not sure if this reg exp works... 
      if (isset($data['submit']) && isset($data['registration'])) {
         $result = preg_match_all('/\b(^[A-Z]{2}[0-9]{2}\s?[A-Z]{3}$)|(^[A-Z][0-9]{1,3}[A-Z]{3}$)|(^[A-Z]{3}[0-9]{1,3}[A-Z]$)|(^[0-9]{1,4}[A-Z]{1,2}$)|(^[0-9]{1,3}[A-Z]{1,3}$)|(^[A-Z]{1,2}[0-9]{1,4}$)|(^[A-Z]{1,3}[0-9]{1,3}$)|(^[A-Z]{1,3}[0-9]{1,4}$)|(^[0-9]{3}[DX]{1}[0-9]{3}$)\b/', $data['registration']);
         if ($result) {
            return true;
         }
      }

      return false;
   }
}

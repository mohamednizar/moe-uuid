<?php

namespace Mohamednizar\MoeUuid;

class MoeUuid
{
    static $charSet;

    public function __construct()
    {
        self::$charSet = '2346789BCDFGHJKMPQRTVWXY';
    }

    /**
     * This will randomize the alphanumeric
     * to 2.821109907×10¹² times
     * @input $min , $max
     * @return number
    **/
     public static function crypto_rand_secure($min, $max)
     {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
            $log = ceil(log($range, 2));
            $bytes = (int) ($log / 8) + 1; // length in bytes
            $bits = (int) $log + 1; // length in bits
            $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
            return $min + $rnd;
     }

    /**
      * This fucntion will pass values to rendom generator.
      * Our function has 1 digit to 42 options
      * @input number - lenght of expected MoeUuid
      * @return string
    **/
     public static function getUniqueAlphanumeric($version)
     {
        $token = "";
        $codeAlphabet = "BCDFGHJKMPQRTVWXY";
        $codeAlphabet.= "2346789";
        $max = strlen($codeAlphabet); // edited

        $length = self::setDigits($version);
        $split = self::getStingLength($version);


        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
        }

        $checkDigit = self::ValidateCheckCharacter($token);
        $token .= $checkDigit;
        $token  = self::format($token,$split);
        return $token;

     }

     public static function setDigits($type){
        switch($type){
            case 1:
                return 4;
                break;
            case 2:
                return 6;
                break;
            case 3:
                return 8;
                break;
            case 4:
                return 9;
                break;
            case 5:
                return 12;
                break;
            case 6:
                return 16;
                break;
            default:
                return 8;
                break;
         }
     }

     public static function getStingLength($type){
        switch($type){
            case 2:
                return 3;
                break;
            case 3:
                return 3;
                break;
            case 4:
                return 3;
                break;
            default:
                return 4;
                break;
         }
     }

     /**
      * Undocumented function
      *
      * @param [type] $token
      * @param [type] $split
      * @return void
      */
     public  static function format($token,$split){
        $partitions =  str_split($token,$split);
        $newToken = '';
        for($i=0; $i < count($partitions); $i++){
            $newToken .='-'.$partitions[$i];
        }
        return substr($newToken,1,strlen($newToken));
     }

     /**
      * Check the valid ID
      *
      * @param [type] $moeuuid
      * @param integer $type
      * @return boolean
      */
     public static function isValidMoeUuid($moeuuid,$type = 3){
        $token = str_replace("-","",$moeuuid);
        $valid = preg_match("/^[".self::$charSet."]/",$token);
        $index = strlen($token) -1;
        
        //get the current check digit
        $checkDigit = substr($token,$index);

        // get the valid check digit
        $token = substr($token,self::setDigits($type)-1);
        $checkValid = self::ValidateCheckCharacter($token);

        return $valid && $checkDigit == $checkValid;
     }

     public static function CodePointFromCharacter($character){
        $characters = array_flip(str_split($character));
        return $characters[$character];
     }

     public static function CharacterFromCodePoint($codePoint){
        $characters = str_split(self::$charSet);
        return $characters[$codePoint];
     }

     public static function NumberOfValidCharacters(){
        return strlen(self::$charSet);
     }

    /**
     * Luhn mod N algorithm
     * @input string
     * @return string
    **/
     public static function ValidateCheckCharacter($checkNumber){
      	$length = strlen($checkNumber) - 1;
      	$factor = 2;
      	$total_sum = 0;
      	$cur_num = 0;
      	$n = self::NumberOfValidCharacters();

        // Starting from the right and working leftwards is easier since
        // the initial "factor" will always be "2".
      	for ($num=($length);$num >= 0;--$num) {
      		    $codePoint = self::codePointFromCharacter($checkNumber[$num]);
      		    $added = $factor * $codePoint;

      		    // Alternate the "factor" that each "codePoint" is multiplied by
      		    $factor = ($factor == 2) ? 1 : 2;

      		    // Sum the digits of the "addend" as expressed in base "n"
      		    $added = ($added/$n) + ($added % $n);
      		    $total_sum += $added;
      	}

        // Calculate the number that must be added to the "sum"
        // to make it divisible by "n".
      	$reminder = $total_sum % $n;
      	$checkCodePoint  = ($n - $reminder) % $n;
        return  self::CharacterFromCodePoint($checkCodePoint);
    }
}

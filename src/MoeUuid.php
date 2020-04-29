<?php

namespace Mohamednizar\MoeUuid;

class MoeUuid
{
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

        $length = 10;
        $split = 4;

        switch($version){
            case 1:
                $length = 4;
                break;
            case 2:
                $length = 6;
                $split = 3;
                break;
            case 3:
                $length = 8;
                break;
            case 4:
                $length = 10;
                break;
            case 5:
                $length = 12;
                break;
            case 6:
                $length = 14;
                break;
            case 7:
                $length = 16;
                break;
            default:
                $length = 10;
                break;
        }

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
        }
        $token  = self::format($token,$split);
        return $token;

     }

     public function format($token,$split){
        $partitions =  str_split($token,$split);
        $newToken = '';
        for($i=0; $i < count($partitions); $i++){
            $newToken .='-'.$partitions[$i];
        }
        return substr($newToken,1,strlen($newToken));
     }

     public static function isValidMoeUuid($moeuuid,$lenght = 8){
        return preg_match('/^[A-Z2-9]{'.$lenght.'}$/', $moeuuid);
     }
}

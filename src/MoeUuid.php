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
     public static function getUniqueAlphanumeric($length = 8)
     {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[MoeUuid::crypto_rand_secure(0, $max-1)];
        }

            return $token;
     }
}

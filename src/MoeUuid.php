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

        $length = self::setDigits($version);
        $split = self::getStingLength($version);


        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
        }

        $checkDigit = self::luhnCheck($token);
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

     public  static function format($token,$split){
        $partitions =  str_split($token,$split);
        $newToken = '';
        for($i=0; $i < count($partitions); $i++){
            $newToken .='-'.$partitions[$i];
        }
        return substr($newToken,1,strlen($newToken));
     }

     public static function isValidMoeUuid($moeuuid,$type = 4){
        $split = self::getStingLength($type);

        return preg_match("/^[2346789BCDFGHJKMPQRTVWXY]{".$split."}-[2346789BCDFGHJKMPQRTVWXY]{".$split."}-[B2346789BCDFGHJKMPQRTVWXY]{".$split."}/", $moeuuid);
     }

     public static function luhnCheck($checkNumber){
        $characters = [
            'B'=> 11,
            'C'=> 12,
            'D'=> 13,
            'F'=> 15,
            'G'=> 16,
            'H'=> 17,
            'J'=> 18,
            'K'=> 20,
            'M'=> 21,
            'P'=> 22,
            'Q'=> 24,
            'R'=> 25,
            'T'=> 27,
            'V'=> 29,
            'W'=> 30,
            'X'=> 31,
            'Y'=> 33
        ];
      	$length = strlen($checkNumber) - 1;
      	$total_sum = 0;
      	$cur_num = 0;

      	for ($num=($length-1);$num >= 0;--$num) {
      		if (!ctype_digit((string) $checkNumber[$num])) {
      			$sum = $characters[$checkNumber[$num]];
      			}
      		else {
      			$sum = $checkNumber[$num];
      			}

      		if ($cur_num++ % 2 == 0) {
      			$sum *= 2;
      			}

      		if ($sum > 9) {
      			$sum = substr($sum, 0, 1) + substr($sum, 1, 1);
      			}

      		$total_sum += $sum;
      		}

      	return (9 - ($total_sum % 9));//Use this to return the missing validation number, note has to be passed with x in the end
      	//return (($total_sum + $checkNumber[$length]) % 10 == 0); //Use this to validate the 12 digit number
    }
}

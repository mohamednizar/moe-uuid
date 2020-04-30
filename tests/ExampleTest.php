<?php

namespace Mohamednizar\MoeUuid\Tests;


// require __DIR__ .'/../src/MoeUuid.php';
use PHPUnit\Framework\TestCase;
use Mohamednizar\MoeUuid\MoeUuid;

class ExampleTest extends TestCase
{
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }

    public function testOne(){
        $users = 'users.txt';
        $moeId = new MoeUuid();
        $id = MoeUuid::getUniqueAlphanumeric(4);
        $file = file_get_contents($users);
        $text =  $id . "\n";
        $users = fopen($users, 'a+');
        $this->assertEquals(true,(strpos($file,$id) == false));
        if(strpos($file,$id)){
                echo 'duplicated';
        }else{
            fwrite($users, $text);
//                 echo $id . ' '. "\n";
        }
    }

    public function testTest(){
        $number = 10;
        while ($number >= 0){
            $number--;
                $this->testOne();
        }
    }

    public function testValid(){
        $valid = MoeUuid::isValidMoeUuid('MR5R-HR2B-2RPV',5);
        $this->assertEquals(true,$valid);
    }
}

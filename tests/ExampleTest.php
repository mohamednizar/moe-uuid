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
        $id = MoeUuid::getUniqueAlphanumeric();
        $text = $id . "," . $id . "\n";
        $users = fopen($users, 'a+');
        if(fwrite($users, $text))  {
                echo $id . 'Created';
        }
    }

    public function testThousand(){
        $number = 1000;
        while ($number >= 0){
            $number--;
            $this->testOne();
        }
    }

    public function testValidMoeuuid(){
        $id1 = '4545';
        $id2 = '08P3PUUT';
        $id3 = '08P3PUUAT';
        $id4 = '1543144646466';
        $valid1 = MoeUuid::isValidMoeUuid($id1);
        $valid2 = MoeUuid::isValidMoeUuid($id2);
        $valid3 = MoeUuid::isValidMoeUuid($id3);
        $valid4 = MoeUuid::isValidMoeUuid($id4);
        $this->assertEquals(false,$valid1);
        $this->assertEquals(true,$valid2);
        $this->assertEquals(false,$valid3);
        $this->assertEquals(false,$valid4);

    }
}

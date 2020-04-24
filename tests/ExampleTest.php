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
                echo 'saved';
        }
    }

    public function testThousand(){
        $number = 1000;
        while ($number >= 0){
            $number--;
            $this->testOne();
        }
    }
}

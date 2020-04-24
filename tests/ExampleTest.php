<?php

namespace Mohamednizar\MoeUuid\Tests;

use PHPUnit\Framework\TestCase;
require '../src/MoeUuid';

class ExampleTest extends TestCase
{
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }

    public function testOneMillion(){
        $users = 'users.txt';
        $moeId = new MoeUuid();
        $id = $moeId->getUniqAlphanumeric();
        $text = $id . "," . $id . "\n";
        $users = fopen($users, 'a+');
        if(fwrite($fp, $text))  {
                echo 'saved';

        }
    }
}

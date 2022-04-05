<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Person;
use DatabaseMigrations;
use Tests\TestCase;

class HelloTest extends TestCase
{


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testHello()
    {
        //引数の値がtrueかどうか
        $this->assertTrue(true);

        $arr = [];
        $this->assertEmpty($arr);

        $msg = "Hello";
        $this->assertEquals('Hello', $msg);

        $n = random_int(0, 100);
        //第２引数が第１引数と同じまたは小さいか
        $this->assertLessThan(100, $n);
    }

}

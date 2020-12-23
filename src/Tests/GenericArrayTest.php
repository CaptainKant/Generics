<?php


namespace captainkant\generics\src\Tests;


use CaptainKant\Generics\Patterns\GenericArray;
use PHPUnit\Framework\TestCase;

class GenericArrayTest extends TestCase
{
    public function testTransfoRecursive()
    {
        $ob = new class {
            public $a = 'gollum' ;
        };


        $a = [
            1 => "gandalf" ,
            'two' => 'frodo' ,
            3 => $ob
        ] ;

         GenericArray::transfoRecursive($a,function ($str){
            return strtoupper($str);
        });

        $this->assertEquals('FRODO', $a['two']);

        $this->assertEquals('GOLLUM',$a[3]->a);

    }
}
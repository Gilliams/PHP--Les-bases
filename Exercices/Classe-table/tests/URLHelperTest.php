<?php

use App\URLHelper;
use PHPUnit\Framework\TestCase;

class UrlHelperTest extends TestCase{

    public function assertUrlEquals(string $expected, string $url){
        $this->assertEquals($expected, urldecode($url));
    }

    public function testWithParam(){
        $url = URLHelper::withParam([], 'k', 3);
        $this->assertUrlEquals("k=3",$url);
    }
    public function testWithParamWithArray(){
        $url = URLHelper::withParam([], 'k', [3,2,1]);
        $this->assertUrlEquals("k=3,2,1",$url);
    }

    public function testWithParams(){
        $url = URLHelper::withParams(["a" =>3], ["a" => 5, "b" => 6]);
        $this->assertUrlEquals("a=5&b=6", $url);
    }
    public function testWithParamsWithArray(){
        $url = URLHelper::withParams(["a" =>3], ["a" => [5,6], "b" => 6]);
        $this->assertUrlEquals("a=5,6&b=6", $url);
    }

}
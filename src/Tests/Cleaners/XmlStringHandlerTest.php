<?php

namespace CaptainKant\Generics\Tests\Cleaners;

use CaptainKant\Generics\Cleaners\GenericXmlStringHandler;
use CaptainKant\Generics\Exceptions\GenericXmlStringHandlerException;
use PHPUnit\Framework\TestCase;

class XmlStringHandlerTest extends TestCase
{


    static public function testDirtyAppligos()
    {
        $cleaner = GenericXmlStringHandler::getInstance();
        $clean = '<?xml version = "1.0" encoding="UTF-8" standalone="yes" ?>
<!DOCTYPE trsf_applisamu SYSTEM "E_QAexc.dtd">
<trsf_applisamu type="1009" id="0" aefrom="aa" aedest="bb"><plugin pName="cc"><pCode></pCode></plugin></trsf_applisamu>';
        self::assertEquals($cleaner->__invoke(self::dirtyXmlAppligos($clean)), $clean);
    }

    public function testErrorHandling()
    {
        $cleaner = GenericXmlStringHandler::getInstance();
        $wasException = false;
        try {
            $cleaner->__invoke("ceci n'est pas <dutout> du xml ");
        } catch (GenericXmlStringHandlerException $e) {
            $wasException = true;
            self::assertNotEquals('', $e->getMessage());
        }
        self::assertTrue($wasException);
    }


    static private function dirtyXmlAppligos($xmlOk)
    {
        return ' --------------------------27b4436c19689782
Content-Disposition: attachment; name="trsf_applisamu"

' . $xmlOk . '


--------------------------27b4436c19689782--';
    }

    public function testDirtyAmp()
    {
        $cleaner = GenericXmlStringHandler::getInstance();
        self::assertEquals(self::cleanAmp(),$cleaner(self::dirtyAmp()));
    }

    static private function dirtyAmp() {
        return '<root>aa & bb &amp; cc</root>';
    }

    static private function cleanAmp() {
        return '<root>aa &amp; bb &amp; cc</root>';
    }





}

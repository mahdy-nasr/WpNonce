<?php
use PHPUnit\Framework\TestCase;

final class NonceTest extends TestCase
{
    protected static $Nonce = null;
    public static function setUpBeforeClass()
    {
        self::$Nonce = new \WpNonce\Nonce('XAction');
    }

    public function testGenerateNonce()
    {
  
        $nonce = self::$Nonce->generateNonce();
        $this->assertNotNull($nonce);
        $this->assertNotEmpty($nonce);
    }

    public function testToString()
    {
        $nonce_string = self::$Nonce->generateNonce();

        $this->assertEquals($nonce_string, self::$Nonce);
    }

    public function testGenerateNonceUrl()
    {
        $url = "http://www.someurl.com/";
        $nonce = self::$Nonce->generateNonce();
        $res = self::$Nonce->generateNonceUrl($url);

        $this->assertNotEmpty($res);
        $this->assertStringEndsWith("_wpnonce=".$nonce, $res);
    }

    public function testConfigureName()
    {
        $url = "http://www.someurl.com/";

        $nonce = new \WpNonce\Nonce('XAction');
        $name = "_wordPressNonce";
        $nonce->setName($name);
        $res = $nonce->generateNonceUrl($url);

        $this->assertEquals($nonce->getName(), $name);
        $this->assertStringEndsWith("$name=".$nonce, $res);
    }

    public function testconfigureAction()
    {

        $nonce1 = new \WpNonce\Nonce('actionTest');
        $nonce2 = new \WpNonce\Nonce();
        $nonce2->setAction("actionTest");

        $this->assertEquals($nonce1->generateNonce(), $nonce2->generateNonce());
    }

    public function testGenerateNonceField()
    {
        $nonce_field = self::$Nonce->generateNonceField(false,false);
        $nonce_string = self::$Nonce->generateNonce();
        $name = self::$Nonce->getName();
        $answer = "<input type=\"hidden\" id=\"{$name}\" name=\"{$name}\" value=\"{$nonce_string}\" />";

        $this->assertEquals($nonce_field, $answer);
    }

    public static function tearDownAfterClass()
    {
      self::$Nonce = null;
    }
}
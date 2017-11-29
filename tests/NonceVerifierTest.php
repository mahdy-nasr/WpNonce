<?php

final class NonceVerifierTest extends \PHPUnit\Framework\TestCase
{
    protected static $Nonce;
    protected static $action;
    public static function setUpBeforeClass()
    {
        self::$action = "XAction";
        self::$Nonce = new \WpNonce\Nonce(self::$action);
    }

    public function testVerify()
    {
        $nonce = self::$Nonce->generateNonce();
        $this->assertEquals(\WpNonce\NonceVerifier::verify($nonce, self::$action), 1);
    }

    public function testCheckAdminReferer()
    {
        $_REQUEST[self::$Nonce->getName()] = self::$Nonce->generateNonce();
        $this->assertEquals(\WpNonce\NonceVerifier::checkAdminReferer(self::$action), 1);
    }

    public function testCheckAjaxReferer()
    {
        $_REQUEST[self::$Nonce->getName()] = self::$Nonce->generateNonce();
        $this->assertEquals(\WpNonce\NonceVerifier::checkAjaxReferer(self::$action), 1);    
    }

    public static function tearDownAfterClass()
    {
      self::$Nonce = null;
    }
}
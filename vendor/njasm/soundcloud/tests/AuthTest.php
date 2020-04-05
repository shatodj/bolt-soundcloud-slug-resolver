<?php

namespace Njasm\Soundcloud\Tests;

use Njasm\Soundcloud\Auth\Auth;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testException()
    {
        $this->expectException('\InvalidArgumentException');
        $this->expectExceptionMessage("No ClientID Provided.");

        $auth = new Auth();
    }
    
    public function testSetAndGetClientID()
    {
        $auth = new Auth("ClientIDHash");
        $this->assertEquals("ClientIDHash", $auth->getClientID());
    }

    public function testSetAndGetClientSecret()
    {
        $auth = new Auth("ClientIDHash", "ClientSecretHash");
        $this->assertEquals("ClientSecretHash", $auth->getClientSecret());
    }

    public function testSetAndGetAuthUrlCallback()
    {
        $auth = new Auth("ClientIDHash", null, "http://api.soundcloud.com");
        $this->assertEquals("http://api.soundcloud.com", $auth->getAuthUrlCallback());
    }
        
    public function testSetAndGetToken()
    {
        $auth = new Auth("ClientIDHash");
        $auth->setToken("Big_Secret_Token");
        $this->assertEquals("Big_Secret_Token", $auth->getToken());
    }
    
    public function testSetAndExpires()
    {
        $auth = new Auth("ClientIDHash");
        $auth->setExpires("1234567");
        $this->assertEquals("1234567", $auth->getExpires());
    }
    
    public function testSetAndScope()
    {
        $auth = new Auth("ClientIDHash");
        $auth->setScope("*");
        $this->assertEquals("*", $auth->getScope());
    }
    
    public function testSetAndGetRefreshToken()
    {
        $auth = new Auth("ClientIDHash");
        $auth->setRefreshToken("1-3456-asfaSy5hhjsWE");
        $this->assertEquals("1-3456-asfaSy5hhjsWE", $auth->getRefreshToken());
    }
    
    public function testHasTokenFalse()
    {
        $auth = new Auth("ClientIDHash");
        $this->assertFalse($auth->hasToken());
    }
    
    public function testHasTokenTrue()
    {
        $auth = new Auth("ClientIDHash");
        $auth->setToken("1314-426fdv4ths");
        $this->assertTrue($auth->hasToken());
    }
    
    public function testMergeParams()
    {
        $auth = new Auth("ClientIDHash", "ClientSecretHash");
        $params = $auth->mergeParams(array(), false);
        $this->assertArrayHasKey("client_id", $params);
        $this->assertArrayNotHasKey("oauth_token", $params);
        $this->assertArrayNotHasKey("client_secret", $params);
        
        $params = $auth->mergeParams(array(), true);
        $this->assertArrayHasKey("client_secret", $params);
        $this->assertEquals("ClientSecretHash", $params['client_secret']);

        $property = $this->reflectProperty("Njasm\\Soundcloud\\Auth\\Auth", "accessToken");
        $property->setValue($auth, "1-23-456789");        
        $params = $auth->mergeParams();
        $this->assertArrayHasKey('oauth_token', $params);
        $this->assertEquals("1-23-456789", $params['oauth_token']);
    }
    
    /**
     * Helper method for properties reflection testing.
     */
    private function reflectProperty($class, $property)
    {
        $property = new \ReflectionProperty($class, $property);
        $property->setAccessible(true);
        
        return $property;
    }    
}

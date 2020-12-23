<?php

namespace Tests\Unit\Services;

use App\Models\UrlMapping;
use App\Services\UrlService;
use Tests\TestCase;

class UrlServiceTest extends TestCase
{
    private $url;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createMysqlTable();
        $this->url = new UrlService;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    public function testGenerateKey()
    {
        $this->assertEquals(6, strlen($this->url->generateKey()));
        $this->assertEquals(7, strlen($this->url->generateKey(7)));
        $this->assertEquals(8, strlen($this->url->generateKey(8)));
    }

    public function testGetUrlByKey()
    {
        $key = '8oEFlG';
        $url = $this->url->getUrlByKey($key);
        $this->assertEquals('www.google.com', $url);

        $key = 'rIgAU6';
        $url = $this->url->getUrlByKey($key);
        $this->assertEquals('', $url);
    }

    public function testCreateUrlMapping()
    {
        $key = 'test01';
        $this->url->createUrlMapping($key);
        $mapping = UrlMapping::where('key', '=', $key)->first();

        $this->assertEquals($key, $mapping->key);
        $this->assertEquals('' , $mapping->url);
        $this->assertEquals(0 , $mapping->is_used);
    }

    public function testGetUnusedKey()
    {
        $this->assertEquals('rIgAU6', $this->url->getUnusedKey());
    }

    public function testSaveUrl()
    {
        $url = 'www.example.com';
        $mappingKey = $this->url->saveUrl($url);

        $this->assertEquals('rIgAU6', $mappingKey);
    }

    public function testIsValidatedKey()
    {
        $key = '8oEFlG';
        $this->assertTrue($this->url->isValidatedKey($key));

        $key = '8oEFl0';
        $this->assertFalse($this->url->isValidatedKey($key));
    }

    public function testUpdateUrlMapping()
    {
        $key = 'rIgAU6';
        $url = 'www.example.com';
        $this->url->updateUrlMapping($key, $url);
        $mapping = UrlMapping::where('key', '=', $key)->first();

        $this->assertEquals($key, $mapping->key);
        $this->assertEquals($url , $mapping->url);
        $this->assertEquals(1 , $mapping->is_used);
    }
}

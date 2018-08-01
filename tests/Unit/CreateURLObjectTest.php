<?php

namespace Tests\Unit;

use App\Exceptions\URLIsNotValidException;
use App\Factories\EloquentURLFactory;
use App\Models\URL;
use Tests\TestCase;

class CreateURLObjectTest extends TestCase
{
    private $URLFactory;

    protected function setUp()
    {
        parent::setUp();
        $this->URLFactory = new EloquentURLFactory();
    }

    public function testEmptyURL()
    {
        $this->expectException(URLIsNotValidException::class);
        $this->URLFactory->createURL('');
    }

    public function testInvalidURLFormat1()
    {
        $this->expectException(URLIsNotValidException::class);
        $this->URLFactory->createURL('invalid');
    }

    public function testInvalidURLFormat2()
    {
        $this->expectException(URLIsNotValidException::class);
        $this->URLFactory->createURL('http://www.abc.com.');
    }

    public function testInvalidURLFormat3()
    {
        $this->expectException(URLIsNotValidException::class);
        $this->URLFactory->createURL('abc.com');
    }

    public function testInvalidURLFormat4()
    {
        $this->expectException(URLIsNotValidException::class);
        $this->URLFactory->createURL('http//www.siam4friend.com');
    }

    public function testCreateObjectSuccess()
    {
        $originalURL = 'http://www.thailandhoro.com';
        $expire = '11/11/2019';
        $url = $this->URLFactory->createURL($originalURL, $expire);

        $this->assertInstanceOf(URL::class, $url);
        $this->assertEquals(null, $url->code);
        $this->assertEquals($originalURL, $url->url);
        $this->assertEquals(0, $url->hits);
        $this->assertEquals(URL::STATUS_ACTIVE, $url->status);
        $this->assertEquals((new \DateTime($expire))->getTimestamp(), $url->expires_in->getTimestamp());
    }
}

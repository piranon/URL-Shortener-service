<?php

namespace Tests\Unit;

use App\Models\URL;
use App\Repositories\URLRepository;
use App\Services\URLService;
use Hashids\Hashids;
use Tests\TestCase;

class GenerateCodeTest extends TestCase
{
    private $serviceHashMock;

    private $repositoryMock;

    private $URLService;

    protected function setUp()
    {
        parent::setUp();
        $this->serviceHashMock = $this->createMock(Hashids::class);
        $this->repositoryMock = $this->createMock(URLRepository::class);
        $this->URLService = new URLService($this->serviceHashMock, $this->repositoryMock);
    }

    public function testGenerateCode()
    {
        $url = new URL();
        $url->id = 10;
        $url->url = 'https://www.siam4friend.com';
        $url->code = null;

        $encodedMock = 'string_encoded';

        $this->serviceHashMock->expects($this->once())
            ->method('encode')
            ->with($url->id)
            ->willReturn($encodedMock);

        $this->repositoryMock->expects($this->any())
        ->method('save')
        ->with($url);

        $url = $this->URLService->generateCode($url);

        $this->assertNotNull($url->code);
        $this->assertEquals($encodedMock, $url->code);
    }
}

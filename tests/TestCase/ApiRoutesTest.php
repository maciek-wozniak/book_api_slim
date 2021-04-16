<?php

namespace App\Test\TestCase;

use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use Selective\TestTrait\Traits\HttpJsonTestTrait;
use Selective\TestTrait\Traits\HttpTestTrait;
use Selective\TestTrait\Traits\RouteTestTrait;

class ApiRoutesTest extends TestCase
{
    use HttpTestTrait;
    use HttpJsonTestTrait;
    use RouteTestTrait;

    private $app;

    protected function setUp(): void {
        $this->app = require __DIR__ . '/../../src/config/bootstrap.php';
    }

    public function testHome(): void {
        $request = $this->createRequest('GET', '/');
        $response = $this->app->handle($request);

        $this->assertSame(StatusCodeInterface::STATUS_FOUND, $response->getStatusCode());
    }

    public function testOneBook(): void {
        $request = $this->createRequest('GET', '/book/1');
        $response = $this->app->handle($request);

        $this->assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
    }

    public function testNonExistingBook(): void {
        $request = $this->createRequest('GET', '/book/abc');
        $response = $this->app->handle($request);

        $this->assertSame(404, $response->getStatusCode());
    }

    public function testBookList(): void {
        $request = $this->createRequest('GET', '/books');
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testFailAddingBook():void {
        $request = $this->createRequest('POST', '/books');
        $response = $this->app->handle($request);

        $this->assertSame(500, $response->getStatusCode());
    }

    public function testAddingBook():void {
        $request = $this->createJsonRequest('POST', '/books', [
            "author" => "H.Sienkiewicz",
            "title" => "Krzyżacy",
            "price" => 49.99,
            "isbn" => "testowy-isbn",
            "published" => 1900,
            "status" => 0,
            "image_url" => "/uploads/img/krzyzacy.jpg",
            "description" => "Powieść historyczna Henryka Sienkiewicza publikowana w latach 1897–1900 w Tygodniku Ilustrowanym"
        ]);
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());
    }

}
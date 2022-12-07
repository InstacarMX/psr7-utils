<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Test\Integration\Utils;

use Instacar\Psr7Utils\Test\Utils\IterableUtils;
use Instacar\Psr7Utils\Utils\ResponseUtils;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ResponseUtilsTest extends TestCase
{
    public function testStreamLines(): void
    {
        $response = new Response(body: "this\nis\na\nmultiline");
        $lines = ResponseUtils::streamLines($response, 8);

        $this->assertIsIterable($lines);

        $lines = IterableUtils::iterableToArray($lines);
        $this->assertCount(4, $lines);
        $this->assertEquals('this', $lines[0]);
        $this->assertEquals('is', $lines[1]);
        $this->assertEquals('a', $lines[2]);
        $this->assertEquals('multiline', $lines[3]);
    }
}

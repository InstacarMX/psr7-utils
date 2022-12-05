<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Utils;

use Psr\Http\Message\ResponseInterface;

final class ResponseUtils
{
    public static function streamLines(ResponseInterface $response, int $bufferSize = 8192): iterable
    {
        $stream = $response->getBody();
        if ($stream->isSeekable()) {
            $stream->seek(0);
        }

        try {
            $content = '';
            do {
                $content .= $stream->read($bufferSize);
                $lines = explode("\n", $content);

                if (!$stream->eof()) {
                    $content = array_pop($lines);
                }

                foreach ($lines as $line) {
                    yield $line;
                }
            } while (!$stream->eof());
        } finally {
            $stream->close();
        }
    }
}

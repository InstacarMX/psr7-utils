<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Utils;

use Psr\Http\Message\UriInterface;

final class UriUtils
{
    /**
     * @phpstan-return array<string, string>
     */
    public static function getParams(UriInterface $request): array
    {
        $query = $request->getQuery();
        $params = [];

        foreach (explode('&', $query) as $param) {
            [$key, $value] = explode('=', $param);

            $params[$key] = rawurldecode($value);
        }

        return $params;
    }

    public static function withParams(UriInterface $request, array $params): UriInterface
    {
        $query = '';

        foreach ($params as $key => $value) {
            if ($query !== '') {
                $query .= '&';
            }

            $query .= $key . '=' . rawurlencode($value);
        }

        return $request->withQuery($query);
    }
}

<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Utils;

use Psr\Http\Message\RequestInterface;

final class RequestUtils
{
    public static function withAuthorization(RequestInterface $request, string $authorization): RequestInterface
    {
        return $request->withHeader('Authorization', $authorization);
    }

    public static function withBasicAuthorization(RequestInterface $request, string $username, string $password): RequestInterface
    {
        return static::withAuthorization($request, 'Basic ' . base64_encode($username . ':' . $password));
    }

    public static function withBearerAuthorization(RequestInterface $request, string $token): RequestInterface
    {
        return static::withAuthorization($request, 'Bearer ' . $token);
    }

    /**
     * @phpstan-param array<string, string|array<string>> $headers
     */
    public static function withHeaders(RequestInterface $request, array $headers): RequestInterface
    {
        foreach ($headers as $header => $value) {
            $request = $request->withHeader($header, $value);
        }

        return $request;
    }
}

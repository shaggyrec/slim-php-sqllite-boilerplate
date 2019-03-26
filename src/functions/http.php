<?php
namespace InsteadSite\HttpHelper;

use Psr\Http\Message\ResponseInterface;
use Slim\Http;
use InsteadSite\Controllers;

/**
 * @param int $code HTTP error code, one of Slim\Http\StatusCode::HTTP_*
 * @param string $message error message
 * @return ResponseInterface
 */
function errorResponse(int $code, string $message): ResponseInterface
{
    $body = new Http\RequestBody();
    $body->write(json_encode(['error' => $message]));

    return (new Http\Response())
        ->withStatus($code)
        ->withBody($body)
        ->withHeader('Content-Type', 'application/json;charset=utf-8');
}

/**
 * @param string $span
 * @throws Controllers\Exception\BadRequest
 */
function assertGoodSpanParameter(string $span)
{
    if (!in_array($span, ['day', 'month', 'year'])) {
        throw new Controllers\Exception\BadRequest("Parameter 'span' should be one of 'day', 'month', 'year'");
    }
}

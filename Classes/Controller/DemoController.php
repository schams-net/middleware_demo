<?php
declare(strict_types=1);
namespace SchamsNet\MiddlewareDemo\Controller;

/*
 * TYPO3 Middleware Demo
 *
 * (c)2020 by Michael Schams <schams.net>
 * https://schams.net
 */

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Demo controller
 */
class DemoController
{
    /**
     * Dispatcher method
     *
     * @access public
     * @param ServerRequestInterface $request PSR-7 server request interface
     * @return Response
     */
    public function dispatch(ServerRequestInterface $request): Response
    {
        $array = [
            "foo" => "bar"
        ];

        $response = new Response();
        $response->getBody()->write(json_encode($array, JSON_UNESCAPED_UNICODE) . PHP_EOL);
        return $response
            ->withHeader('Expires', 'Thu, 01 Jan ' . date('Y') . ' 00:00:00 GMT')
            ->withHeader('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT')
            ->withHeader('Cache-Control', 'no-cache, must-revalidate')
            ->withHeader('Pragma', 'no-cache')
            ->withHeader('Content-Type', 'application/json; charset=utf8')
            ->withHeader('X-Robots-Tag', 'noindex, nofollow');
    }
}

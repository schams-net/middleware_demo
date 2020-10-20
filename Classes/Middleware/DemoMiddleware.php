<?php
declare(strict_types=1);
namespace SchamsNet\MiddlewareDemo\Middleware;

/*
 * TYPO3 Middleware Demo
 *
 * (c)2020 by Michael Schams <schams.net>
 * https://schams.net
 */

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use SchamsNet\MiddlewareDemo\Controller\DemoController;

/**
 * PSR-15 middleware
 */
class DemoMiddleware implements MiddlewareInterface
{
    /**
     * Dispatches the request to the corresponding typoscript_rendering configuration
     *
     * @param ServerRequestInterface $request Server request interface
     * @param RequestHandlerInterface $handler Request handler interface
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // If request does match expected URI, pass on to next middleware
        if (!$this->isValidRoute($request)) {
            return $handler->handle($request);
        }

        // Process request
        $demoController = GeneralUtility::makeInstance(DemoController::class);
        return $demoController->dispatch($request);
    }

    /**
     * Checks if the request matches the expected URI
     *
     * @access private
     * @param ServerRequestInterface $request PSR-7 server request interface
     * @return bool
     */
    private function isValidRoute(ServerRequestInterface $request): bool
    {
        /** @var NormalizedParams $normalizedParams */
        $normalizedParams = $request->getAttribute('normalizedParams');
        $requestUri = self::sanitizeString($normalizedParams->getRequestUri());

        // Demo only! The expected URI should not be hard-coded, but configurable.
        $expectedUri = '/foo/bar';

        return ($requestUri === $expectedUri ? true : false);
    }

    /**
     * Sanitize string
     *
     * @access private
     * @param string $uri Uniform resource identifier (URI) to sanitize
     * @return string
     */
    private static function sanitizeString(string $uri): string
    {
        // Remove trailing slashes
        $uri = preg_replace('/\/{1,}$/', '', $uri);
        // Add a slash at the start, but replace multiple slashes with one slash
        $uri = preg_replace('/\/{1,}/', '/', '/' . $uri);
        // Return a left/right trimmed string (remove white spaces)
        return trim($uri);
    }
}

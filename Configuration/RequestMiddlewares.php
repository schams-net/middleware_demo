<?php
declare(strict_types=1);

/*
 * TYPO3 Middleware Demo
 *
 * (c)2020 by Michael Schams <schams.net>
 * https://schams.net
 */

return [
    'frontend' => [
        'schams.net/middleware-demo' => [
            'target' => \SchamsNet\MiddlewareDemo\Middleware\DemoMiddleware::class,
            'description' => 'TYPO3 Middleware Demo',
            'before' => [
                'typo3/cms-frontend/eid'
            ],
        ]
    ]
];

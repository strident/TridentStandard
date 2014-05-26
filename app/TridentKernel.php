<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Trident\Component\HttpKernel\HttpKernel;

/**
 * Application Kernel
 *
 * Loads all of the application's modules, allows things like module service
 * configuration to happen.
 */
class TridentKernel extends HttpKernel
{
    /**
     * Register modules
     *
     * @param  string $environment
     * @return array
     */
    public function registerModules($environment)
    {
        $modules = [
            new Trident\Module\FrameworkModule\TridentFrameworkModule(),
            new SeerUK\Module\TestModule\SeerUKTestModule()
        ];

        if (in_array($environment, array('dev'))) {
            // Register development modules here:
        }

        return $modules;
    }
}

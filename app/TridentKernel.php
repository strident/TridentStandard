<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Trident\Component\HttpKernel\AbstractKernel;

/**
 * Application Kernel
 *
 * Loads all of the application's modules, allows things like module service
 * configuration to happen.
 */
class TridentKernel extends AbstractKernel
{
    /**
     * {@inheritDoc}
     */
    public function registerModules($environment)
    {
        $modules = [
            new Trident\Module\FrameworkModule\TridentFrameworkModule(),
            new Trident\Module\TemplatingModule\TridentTemplatingModule(),
            new SeerUK\Module\TestModule\SeerUKTestModule()
        ];

        if ($this->debug) {
            // Register development modules here:
        }

        return $modules;
    }

    /**
     * {@inheritDoc}
     */
    public function registerConfiguration($environment)
    {
        return require_once __DIR__.'/config/config.php';
    }
}

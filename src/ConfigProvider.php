<?php

/**
 * The MIT License
 *
 * Copyright (c) 2016, Coding Matters, Inc. (Gab Amba <gamba@gabbydgab.com>)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Zend\Component;

use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\ZendView;
use Zend\Expressive\Container;

final class ConfigProvider
{
    public function __invoke()
    {
        return [
            "dependencies"          => $this->getServiceConfig()
        ];
    }

    /**
     * Return dependencies mapping for this module.
     * We recommend using fully-qualified class names whenever possible as service names.
     *
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            // Use 'invokables' for constructor-less services,
            // or services that do not require arguments to the constructor.
            //
            // Map a service name to the class name.
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            'invokables'    => [
                Router\RouterInterface::class => Router\ZendRouter::class,
            ],

            // Use 'factories' for services provided by callbacks/factory classes.
            'factories'     => [
                // Templating
                Template\TemplateRendererInterface::class => ZendView\ZendViewRendererFactory::class,
                Zend\View\HelperPluginManager::class => ZendView\HelperPluginManagerFactory::class,

                // Error Handler
                'Zend\Expressive\FinalHandler' => Container\TemplatedErrorHandlerFactory::class
            ]
        ];
    }
}
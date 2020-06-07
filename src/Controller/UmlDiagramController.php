<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\DocumenterBundle\Controller;

use Endroid\Documenter\UmlDiagram\UmlDiagramBuilderInterface;
use Symfony\Component\HttpFoundation\Response;

class UmlDiagramController
{
    private $umlDiagramBuilder;

    public function __construct(UmlDiagramBuilderInterface $umlDiagramBuilder)
    {
        $this->umlDiagramBuilder = $umlDiagramBuilder;
    }

    public function __invoke(): Response
    {
        $umlDiagram = $this->umlDiagramBuilder
            ->build()
        ;

        return new Response(file_get_contents($umlDiagram->getUrl()));
    }
}

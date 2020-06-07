<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\DocumenterBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UmlDiagramControllerTest extends WebTestCase
{
    public function testGenerateController()
    {
        $client = static::createClient();
        $client->request('GET', '/documenter/uml-diagram');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('image/png', $client->getResponse()->headers->get('Content-Type'));
    }
}

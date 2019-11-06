<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Messenger\Transport\InMemoryTransport;

class ImagePostControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = $this::createClient();

        $uploadedFile = new UploadedFile(
            __DIR__ . '/../fixtures/transformer.png',
            'transformer.png'
        );

        $client->request('POST', '/api/images', [], [
            'file' => $uploadedFile,
        ]);

        /** @var InMemoryTransport $transport */
        $transport = self::$container->get('messenger.transport.async_priority_high');

        $this->assertCount(1, $transport->get());
    }
}
<?php

namespace App\MessageHandler\Event;

use App\Message\Event\ImagePostDeletedEvent;
use App\Photo\PhotoFileManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RemoveFileWhenImagePostDeleted implements MessageHandlerInterface
{
    /**
     * @var PhotoFileManager
     */
    private $photoFileManager;

    /**
     * RemoveFileWhenImagePostDeleted constructor.
     */
    public function __construct(PhotoFileManager $photoFileManager)
    {
        $this->photoFileManager = $photoFileManager;
    }

    public function __invoke(ImagePostDeletedEvent $event)
    {
        $this->photoFileManager->deleteImage($event->getFilename());
    }
}
<?php

namespace CMText\RichContent\Templates\Whatsapp;


use CMText\RichContent\Messages\MediaContent;


class ComponentParameterImage extends ComponentParameterBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'image';

    /**
     * The MediaContent object describing the image
     * @var MediaContent
     */
    public $media;

    /**
     * ComponentParameterImage constructor.
     * @param MediaContent $mediaContent
     */
    public function __construct(MediaContent $mediaContent)
    {
        parent::__construct(self::TYPE);

        $this->media = $mediaContent;
    }
}
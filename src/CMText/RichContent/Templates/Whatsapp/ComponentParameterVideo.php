<?php

namespace CMText\RichContent\Templates\Whatsapp;


use CMText\RichContent\Messages\MediaContent;


class ComponentParameterVideo extends ComponentParameterBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'video';

    /**
     * The MediaContent object describing the video
     * @var MediaContent
     */
    public $media;

    /**
     * ComponentParameterVideo constructor.
     * @param MediaContent $mediaContent
     */
    public function __construct(MediaContent $mediaContent)
    {
        parent::__construct(self::TYPE);

        $this->media = $mediaContent;
    }

}
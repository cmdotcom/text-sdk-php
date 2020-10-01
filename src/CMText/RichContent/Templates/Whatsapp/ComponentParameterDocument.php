<?php

namespace CMText\RichContent\Templates\Whatsapp;


use CMText\RichContent\Messages\MediaContent;


class ComponentParameterDocument extends ComponentParameterBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'document';

    /**
     * The MediaContent object describing the document
     * @var MediaContent
     */
    public $media;

    /**
     * ComponentParameterDocument constructor.
     * @param MediaContent $mediaContent
     */
    public function __construct(MediaContent $mediaContent)
    {
        parent::__construct(self::TYPE);

        $this->media = $mediaContent;
    }
}
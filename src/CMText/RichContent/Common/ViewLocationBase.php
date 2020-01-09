<?php

namespace CMText\RichContent\Common;

/**
 * Class ViewLocationBase
 * @package CMText\RichContent\Common
 */
abstract class ViewLocationBase implements \JsonSerializable
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var int Available in some RCS channels to display a radius instead of a pointer on the map.
     */
    protected $radius;

    /**
     * @const int Value to force omitting the radius attribute.
     */
    const RADIUS_OMIT_VALUE = -1;

    /**
     * ViewLocationBase constructor.
     * @param string $Label
     * @param int $Radius
     */
    public function __construct(
        $Label,
        $Radius = self::RADIUS_OMIT_VALUE
    )
    {
        $this->label = $Label;

        $this->radius = $Radius;
    }
}
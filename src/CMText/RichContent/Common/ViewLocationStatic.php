<?php

namespace CMText\RichContent\Common;

/**
 * Class ViewLocationStatic
 * @package CMText\RichContent\Common
 */
class ViewLocationStatic extends ViewLocationBase
{
    /**
     * @var string Latitude of location
     */
    private $latitude;

    /**
     * @var string Longitude of location
     */
    private $longitude;


    /**
     * ViewLocationOptions constructor.
     * @param string $Label
     * @param string $Latitude
     * @param string $Longitude
     * @param int $Radius
     */
    public function __construct(
        string $Label,
        string $Latitude,
        string $Longitude,
        int $Radius = ViewLocationBase::RADIUS_OMIT_VALUE
    )
    {
        parent::__construct($Label, $Radius);

        $this->latitude  = $Latitude;
        $this->longitude = $Longitude;
    }


    public function jsonSerialize()
    {
        $return = [
            'label' => $this->label,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];

        if($this->radius > ViewLocationBase::RADIUS_OMIT_VALUE){
            $return['radius'] =$this->radius;
        }

        return (object)$return;
    }
}
<?php

namespace CMText\RichContent\Common;

/**
 * Class ViewLocationDynamic
 * @package CMText\RichContent\Common
 */
class ViewLocationDynamic extends ViewLocationBase
{
    /**
     * @var string Search-query to find the location via a search engine
     */
    private $searchQuery;


    /**
     * ViewLocationDynamic constructor.
     * @param string $Label
     * @param string $SearchQuery
     * @param int $Radius
     */
    public function __construct(
        $Label,
        $SearchQuery,
        $Radius = ViewLocationBase::RADIUS_OMIT_VALUE
    )
    {
        parent::__construct($Label, $Radius);

        $this->searchQuery = $SearchQuery;
    }

    public function jsonSerialize()
    {
        $return = [
            'label' => $this->label,
            'searchQuery' => $this->searchQuery,
        ];

        if($this->radius > ViewLocationBase::RADIUS_OMIT_VALUE){
            $return['radius'] = $this->radius;
        }

        return (object)$return;
    }
}
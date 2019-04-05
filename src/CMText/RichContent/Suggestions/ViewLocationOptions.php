<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class ViewLocationOptions
 * @package CMText\RichContent\Suggestions
 */
class ViewLocationOptions implements \JsonSerializable
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
     * @var string Label to show with location
     */
    private $label;

    /**
     * @var string Search query to find the location via a search engine
     */
    private $searchQuery;


    /**
     * ViewLocationOptions constructor.
     * @param string $Latitude
     * @param string $Longitude
     * @param string $Label
     * @param string $SearchQuery
     */
    public function __construct(
        string $Latitude,
        string $Longitude,
        string $Label,
        string $SearchQuery = ''
    )
    {
        $this->latitude  = $Latitude;
        $this->longitude = $Longitude;

        $this->label = $Label;
        $this->searchQuery = $SearchQuery;
    }


    public function jsonSerialize()
    {
        return (object)array_filter([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'label' => $this->label,
            'searchQuery' => $this->searchQuery,
        ]);
    }
}
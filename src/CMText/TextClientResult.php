<?php

namespace CMText;


/**
 * Class TextClientResult
 *
 * @package CMText
 */
class TextClientResult
{

    /**
     * @var int
     */
    private $httpStatusCode;

    /**
     * @var string
     */
    private $response;


    /**
     * TextClientResult constructor.
     *
     * @param int    $httpStatusCode
     * @param string $responseBody
     */
    public function __construct(int $httpStatusCode, $responseBody = '')
    {
        $this->httpStatusCode = $httpStatusCode;
        $this->response = $responseBody;

        $this->processResponse();
    }


    /**
     * Processes the Response from the gateway into a TextClientResult model.
     */
    private function processResponse()
    {
        // decode the response
        $json = json_decode($this->response, false, 5);

        if(null === $json){
            $this->statusMessage = strlen($this->response) ? substr($this->response, 0, 100) : 'An error occurred';
            $this->statusCode    = TextClientStatusCodes::UNKNOWN;

        }else{
            $this->statusMessage = $json->details   ?? 'An error occurred';
            $this->statusCode    = $json->errorCode ?? TextClientStatusCodes::UNKNOWN;
            $this->details       = $json->messages  ?? [];
        }
    }


    /**
     * @var string
     */
    public $statusMessage = '';

    /**
     * @var int
     */
    public $statusCode = 0;

    /**
     * @var array
     */
    public $details = [];
}
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
        // check if the response is a json string
        if( 0 !== strlen($this->response) ){
            $this->processJsonResponse();

        }else{
            $this->statusMessage = substr($this->response, 0, 100);
            $this->statusCode = TextClientStatusCodes::UNKNOWN;
        }
    }


    /**
     * Processes data we received from the gateway, expecting it to be JSON.
     */
    private function processJsonResponse()
    {
        try {
            // try to decode the response
            $json = json_decode($this->response, false, 5);

            //
            $this->statusMessage = $json->details   ?? 'An error occurred';
            $this->statusCode    = $json->errorCode ?? TextClientStatusCodes::UNKNOWN;
            $this->details       = $json->messages  ?? [];

        }catch (\Exception $exception){
            $this->statusMessage = 'An error occurred';
            $this->statusCode = TextClientStatusCodes::UNKNOWN;
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
<?php

namespace CMText;


/**
 * Class TextClientStatusCodes
 *
 * Translations for the errorCode property from the gateway response body.
 *
 * @package CMText
 */
class TextClientStatusCodes
{
    /**
     * All is well.
     */
    const OK = 0;

    /**
     * Authentication of the request failed.
     */
    const AUTHENTICATION_FAILED = 101;

    /**
     * The account using this authentication has insufficient balance.
     */
    const BALANCE_INSUFFICIENT = 102;

    /**
     * The product token is incorrect.
     */
    const APIKEY_INCORRECT = 103;

    /**
     * This request has one or more errors in its messages. Some or all messages have not been sent. See MSGs for details.
     */
    const REQUEST_NOT_ALL_SENT = 201;

    /**
     * This request is malformed, please confirm the JSON and that the correct data types are used.
     */
    const REQUEST_MALFORMED = 202;

    /**
     * The request's MSG array is incorrect.
     */
    const MSG_ARRAY_INCORRECT = 203;

    /**
     * This MSG has an invalid From field (per msg).
     */
    const MSG_INVALID_FROM = 301;

    /**
     * This MSG has an invalid To field (per msg).
     */
    const MSG_INVALID_TO = 302;

    /**
     * This MSG has an invalid MSISDN in the To field (per msg).
     */
    const MSG_INVALID_MSISDN = 303;

    /**
     * This MSG has an invalid Body field (per msg).
     */
    const MSG_INVALID_BODY = 304;

    /**
     * This MSG has an invalid field. Please confirm with the documentation (per msg).
     */
    const MSG_INVALID_FIELD = 305;

    /**
     * Message has been spam filtered.
     */
    const SPAM = 401;

    /**
     * Message has been blacklisted.
     */
    const BLACKLISTED = 402;

    /**
     * Message has been rejected.
     */
    const REJECTED = 403;

    /**
     * An internal error has occurred.
     */
    const INTERNAL_ERROR = 500;

    /**
     * Unknown error, please contact CM support.
     */
    const UNKNOWN = 999;
}
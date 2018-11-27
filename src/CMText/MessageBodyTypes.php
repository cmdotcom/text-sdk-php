<?php

namespace CMText;


/**
 * Class MessageBodyTypes
 *
 * @package CMText
 */
class MessageBodyTypes
{

    /**
     * The CM.com gateway will determine the best suited encoding for the message content.
     * This way you do not have to take care of character count and the GSM character set.
     */
    const AUTO = 'AUTO';

    /**
     * When sending binary messages (to machines) use this to make sure no encoding takes place.
     */
    const BINARY = 'BINARY';

    /**
     * When using only characters from the GMS 7bit character set you can use this Type.
     */
    const TEXT = 'TEXT';

}
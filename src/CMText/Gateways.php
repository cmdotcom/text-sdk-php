<?php

namespace CMText;


/**
 * Class Gateways
 *
 * Contains endpoints to CM gateways
 *
 * @package CMText
 */
class Gateways
{

    /**
     * Gateway that fits most use cases
     */
    const GLOBAL = 'https://gw.cmtelecom.com/v1.0/message';

    /**
     * China local gateway
     */
    const CN = 'https://gw-cn.cmtelecom.com/v1.0/message';

    /**
     * Hong Kong local gateway
     */
    const HK = 'https://gw-hk.cmtelecom.cn/v1.0/message';

    /**
     * United Kingdom local gateway
     */
    const UK = 'https://gw-uk.cmtelecom.com/v1.0/message';

    /**
     * South Africa local gateway
     */
    const ZA = 'https://gw.cmtelecom.co.za/v1.0/message';

}

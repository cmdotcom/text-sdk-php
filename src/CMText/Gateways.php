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
     * Recommended Global endpoint via Cloudflare.
     *
     * If you use the Global endpoint via Cloudflare, you agree that Cloudflare, Inc. located in the USA is engaged as a Sub-processor under the Agreement, for an overview of our Sub-processors please see: https://www.cm.com/cdn/web/en/file/subprocessors.pdf .
     */
    const GLOBAL = 'https://gw.messaging.cm.com/v1.0/message';

    /**
     * Alternative Global endpoint
     */
    const GLOBAL_ALTERNATIVE = 'https://gw.cmtelecom.com/v1.0/message';

    /**
     * China local gateway
     *
     * @deprecated Instead use {@see \CMText\Gateways::GLOBAL}
     * @see \CMText\Gateways::GLOBAL
     */
    const CN = 'https://gw-cn.cmtelecom.com/v1.0/message';

    /**
     * Hong Kong local gateway
     *
     * @deprecated Instead use {@see \CMText\Gateways::GLOBAL}
     * @see \CMText\Gateways::GLOBAL
     */
    const HK = 'https://gw-hk.cmtelecom.cn/v1.0/message';

    /**
     * United Kingdom local gateway
     *
     * @deprecated Instead use {@see \CMText\Gateways::GLOBAL}
     * @see \CMText\Gateways::GLOBAL
     */
    const UK = 'https://gw-uk.cmtelecom.com/v1.0/message';
}

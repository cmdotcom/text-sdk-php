<?php

namespace CMText;


/**
 * Class Channels
 *
 * Contains all known Channels
 *
 * @package CMText
 */
class Channels
{
    /**
     * Send SMS messages.
     */
    const SMS = 'SMS';

    /**
     * Send WhatsApp for Business messages.
     * @note CM needs to configure this with you.
     */
    const WHATSAPP = 'WhatsApp';

    /**
     * Send Push messages using Hybrid messages.
     */
    const PUSH = 'Push';

    /**
     * Send RCS messages.
     * @note CM needs to configure this with you.
     */
    const RCS = 'RCS';

    /**
     * Send Viber messages.
     * @note CM needs to configure this with you.
     */
    const VIBER = 'Viber';

    /**
     * Send Voice messages.
     * @note CM needs to configure this with you.
     */
    const VOICE = 'Voice';

    /**
     * Send Apple Business Chat messages.
     * @note CM needs to configure this with you.
     */
    const IMESSAGE = 'iMessage';

    /**
     * Send Line messages.
     * @note CM needs to configure this with you.
     */
    const LINE = 'Line';

    /**
     * Send Twitter messages.
     * @note CM needs to configure this with you.
     */
    const TWITTER = 'Twitter';
}
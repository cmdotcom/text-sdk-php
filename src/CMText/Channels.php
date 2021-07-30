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

    /**
     * Send MobilePush messages.
     * @note This channel is the successor of the "Push" channel. Contact CM for information on how to migrate your current Push integration
     */
    const MOBILEPUSH = 'MobilePush';

    /**
     * Send Facebook Messenger messages.
     * @note CM needs to configure this with you.
     */
    const FACEBOOKMESSENGER = 'Facebook Messenger';

    /**
     * Send Google Business Messages messages.
     * @note CM needs to configure this with you.
     */
    const GOOGLEBUSINESSMESSAGES = 'Google Business Messages';

    /**
     * Send Instagram messages.
     * @note CM needs to configure this with you.
     */
    const INSTAGRAM = 'Instagram';
}
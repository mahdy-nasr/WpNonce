<?php
namespace WpNonce;

/**
 *   class       NonceVerifier
 *   @package    WpNonce
 *   @author     Mahdy Nasr
 *   @license    MIT : http://opensource.org/licenses/MI
 */

class NonceVerifier
{
    /**
     * verify an nounce given action
     * @since 1.0
     * @param  string  $nonce  nonce need to be verified
     * @param  Mixed  $action  action of the given Nonce
     * @return false|int       false if not verified or 1 for past 12h or 2 for past 24h
     */
    public static function verify($nonce, $action = -1)
    {
        return wp_verify_nonce($nonce, $action);
    }

    /**
     * check admin Nonce form
     * @since 1.0
     * @param  Mixed  $action       Action for the nonce need to be verified
     * @param  string $input_name   The form input name that used for Nonce. Default "_wpnonce"
     * @return false|int            False if not verified or 1 for past 12h or 2 for past 24h
     */
    public static function checkAdminReferer($action, $input_name = "_wpnonce")
    {
        return check_admin_referer($action, $input_name);
    }

    /**
     * check ajax requist Nonce
     * @since 1.0
     * @param  Mixed            $action      Action for the nonce need to be verified
     * @param  boolean|string   $arg_name    Optional. Key to check for nonce in $_REQUEST
     * @param  boolean          $die         Optional. if Nonce cannot verified.
     * @return false|int                     False if not verified or 1 for past 12h or 2 for past 24h
     */
    public static function checkAjaxReferer($action, $arg_name = false, $die = true)
    {
        return check_ajax_referer($action, $arg_name, $die);
    }
}

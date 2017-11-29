<?php
namespace WpNonce;

/**
*   class       WpNonce
*   @package    WpNonce
*   @author     Mahdy Nasr
*   @license    MIT : http://opensource.org/licenses/MI
*/

class Nonce
{
    private $action;
    private $name   = "_wpnonce";
    private $nonce  = "";

    public function __construct($action = -1)
    {
        $this->action = $action;
    }

    /**
     * convert class to string and return nonce as result
     * @since 1.0
     * @return string Nonce value
     */
    public function __toString()
    {
        return $this->nonce;
    }

    /**
     * get class properties
     * @since 1.0
     * @param  string $var class property variable
     * @return string      property value
     */
    public function __get($var)
    {
        if (isset($this->$var)) {
            return $this->$var;
        }
        return null;
    }

    /**
     * set class properties except nonce
     * @since 1.0
     * @param string $var   variable name (class property name)
     * @param string $value assigned value needed
     */
    public function __set($var, $value)
    {
        if (!isset($this->$var) || $var == "nonce") {
            return;
        }

        $this->$var = $value;
    }

    /**
     * call wp_nonce_ays function to display "are you sure" via checking action property.
     * @since 1.0
     */
    public function ays()
    {
        wp_nonce_ays($this->action);
    }

    /**
     * return Nonce string for action that had been set before.
     * @since 1.0
     * @return string  Nonce string
     */
    public function generateNonce()
    {
        return wp_create_nonce($this->action);
    }

    /**
     * return URL appended with URL query.
     *
     * @since 1.0
     *
     * @param string     $url Complete URL to append nonce action on it.
     * @return string    URL with nonce action added.
     */
    public function generateNonceUrl($url)
    {
        return wp_nonce_url($url, $this->action, $this->name);
    }

    /**
     * display or return a hidden field for Nonce
     *
     * @since 1.0
     * @param bool       $referer Optional. assign validation. Default true.
     * @param bool       $echo    Optional. display if true or return if false. Default true.
     * @return string Nonce HTML field.
     */
    public function generateNonceField($referer = true, $echo = true)
    {
        return wp_nonce_field($this->action, $this->name, $referer = true, $echo = true);
    }
}

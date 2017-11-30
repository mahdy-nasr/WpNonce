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
        if (empty($this->nonce)) {
            $this->nonce = $this->generateNonce();
        }

        return $this->nonce;
    }

    /**
     * get class properties
     * @since 1.0
     * @return string      property $action value
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * get class properties
     * @since 1.0
     * @return string      property $name value
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * set class properties except nonce
     * @since 1.0
     * @param string $value assign $val to property $name
     */
    public function setName($val)
    {
        $this->name = $val;
    }

    /**
     * set class properties except nonce
     * @since 1.0
     * @param string $value assign $val to property $action
     */
    public function setAction($val)
    {
        $this->action = $val;
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
     * @param bool       $referer Optional. for referer. Default true.
     * @param bool       $echo    Optional. display if true or return if false. Default true.
     * @return string Nonce HTML field.
     */
    public function generateNonceField($referer = true, $echo = true)
    {
        return wp_nonce_field($this->action, $this->name, $referer, $echo);
    }
}

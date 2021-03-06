<?php

namespace Frontend\Utils;

class AttributeUtils {

    /**
     * Remove the style attribute from an HTML tag
     * @param $input String HTML tags to remove style attribute.
     * @return string|string[]|null The input without the style attribute.
     */
    public static function remove_style( $input ) : string {
        return preg_replace( '/\sstyle="(.*)"/', '', $input );
    }

    /**
     * Remove the class attribute from an HTML tag
     *
     * @param $input String HTML tags to remove class attribute.
     * @return string|string[]|null The input without the style attribute.
     */
    public static function remove_class( $input ) : string {
        return preg_replace('/\sclass="(.*)"/', '', $input );
    }

    /**
     * Add classes to <p>. But before we remove style attribute and also remove the classes that
     * are already apply.
     *
     * @param $input string <p> tag(s) we want to add classes.
     * @param array $classes classes to add to paragraph.
     * @return string the <p> tag(s) with the added classes.
     */
    public static function add_class_to_paragraph( $input, $classes = [] ) : string {
        if ( ! $input ) return '';
        $input = self::remove_class( self::remove_style( $input ) );
        if (  empty( $classes ) ) return $input;

        $replace = '<p class="' . implode( ' ', $classes ) . '"$1';
        return preg_replace('/<p([> ])/', $replace, $input );
    }

    /**
     * Remove the HTTP and HTTPS from the email. The ACF (Wordpress Plugin) link field add that
     * to the input.
     *
     * @param $email string The link we want to sanitize (https://info@example.com)
     * @return string the sanitized email. (info@example.com)
     */
    private static function sanitize_for_email( $email ) : string {
        return str_replace('https://', '', str_replace('http://', '', $email ) );
    }

    /**
     * @param $input String
     * @param $type String attribute href of <a> tag can have multiple values.
     * sms: tel: or mailto:
     * @return string
     */
    public static function href( $input, $type = '' ) : string {
        if ( strpos( $input, '@' ) !== false ) $type = 'email';

        if ( $type !== '' ) {
            switch ($type) {
                case 'sms':
                    return sprintf('sms:+1%s', preg_replace('/[^0-9]/', '', $input ) ) ;
                    break;
                case 'email':
                    $input = self::sanitize_for_email( $input );
                    return sprintf('mailto:%s', $input ) ;
                    break;
                case 'tel':
                    return sprintf('tel:+1%s', preg_replace('/[^0-9]/', '', $input ) ) ;
                    break;
            }
        }
        return $input;
    }
}

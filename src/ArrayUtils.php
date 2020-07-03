<?php

namespace Frontend\Utils;

use Collator;

class ArrayUtils {

    /**
     * Takes an array and transform it into a string.
     *
     * @param $array array we want to stringify
     * @return array|string the string construct with the array values separated by a comma.
     */
    public static function stringnify_array ( $array ) {
        if ( ! is_array( $array ) || empty( $array ) ) return $array;

        $temp_arr = [];
        foreach ( $array as $item ) {
            if ( is_array( $item ) ) {
                foreach ( $item as $value ) {
                    $temp_arr[] = $value;
                }
            } else {
                $temp_arr[] = $item;
            }
        }
        return implode( ', ', $temp_arr );
    }

    /**
     * Sort an array with UTF-8 encoding
     *
     * @param $input_arr
     * @return mixed
     */
    public static function sort_fr( $input_arr ) {
        ( new Collator( 'fr_FR' ) )->sort($input_arr, SORT_STRING );
        return $input_arr;
    }

}

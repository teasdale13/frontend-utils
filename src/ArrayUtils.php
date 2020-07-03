<?php

namespace Frontend\Utils;

class ArrayUtils {

    public static function stringnify_array ( $array ) {
        if ( ! is_array( $array ) || empty( $array ) ) return $array;

        $temp_arr = [];
        foreach ( $array as $item) {
            if ( is_array( $item ) ) {
                foreach ( $item as $value ) {
                    $temp_arr[] = $value;
                }
            } else {
                $temp_arr[] = $item;
            }
        }
        return implode( ', ', $temp_arr);
    }

    public static function sort_fr( $input_arr ) {
        $collator = new \Collator('fr_FR');
        $collator->sort($input_arr, SORT_STRING );
        return $input_arr;
    }

}

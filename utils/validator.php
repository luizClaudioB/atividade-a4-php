<?php

class Validator {

    public static function validate($fields, $target) {
        $resp = array();
        foreach ($fields as $field => $properties) {
            if(isset($properties['required']) && $properties['required']) {
                if(!isset($target[$field]) || $target[$field] <= ' ') $resp[] = "Field '$field' is missing";
            }
            if(isset($target[$field]) && isset($properties['min_length'])) {
                if(strlen($target[$field]) < $properties['min_length']) $resp[] = "Field '$field' is too short. Min size: ".$properties['min_length'];
            }
            if(isset($target[$field]) && isset($properties['max_length'])) {
                if(strlen($target[$field]) > $properties['max_length']) $resp[] = "Field '$field' is too large. Max size: ".$properties['max_length'];
            }
        }

        if(count($resp)) {
            return $resp;
        } else {
            return true;
        }
    }
}
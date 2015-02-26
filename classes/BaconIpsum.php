<?php

/**
 * A class which gets dummy content from the http://baconipsum.com/ API
 *
 * @author: ianbarker <ian@theorganicagency.com>
 * @date:   29/05/2014
 *
 */
class BaconIpsum {

    private static $instance = null;

    private function __construct() {

    }

    public static function getInstance() {

        if (is_null(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;

    }

    public function getCopy($paragraphs = 5) {

        $raw = file_get_contents('http://baconipsum.com/api/?type=meat-and-filler&paras=' . $paragraphs);

        // remove \r
        $raw = str_replace('\r','',$raw);

        $data = json_decode($raw);


        return $data;

    }


}

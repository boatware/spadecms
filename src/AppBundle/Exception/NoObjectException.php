<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 02.09.18
 * Time: 00:47
 */

namespace AppBundle\Exception;


class NoObjectException extends \Exception {
    public function __construct($message) {
        error_log('NoObjectException: ' . $message);
    }
}
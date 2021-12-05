<?php

/**
 * This file is part of the lifeofguenter/php-gpg-keyinfo library.
 *
 * (c) Günter Grodotzki <gunter@grodotzki.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Lifeofguenter\GPGkeyinfo;

class Decode
{
    public static function toUtf8($string)
    {
        $string = preg_replace_callback('~\\\x([a-f0-9]{2})~i', 'self::unescape', $string);

        $detected_encoding = mb_detect_encoding($string, 'UTF-8, ISO-8859-1', true);

        if ($detected_encoding !== 'UTF-8') {
            $string = mb_convert_encoding($string, 'UTF-8', $detected_encoding);
        }

        return $string;
    }

    protected static function unescape($matches): string
    {
        return chr(hexdec($matches[1]));
    }
}

<?php

/**
 * This file is part of the NINEJKH/php-libgpg-json-keyinfo library.
 *
 * (c) Günter Grodotzki <gunter@grodotzki.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Lifeofguenter\GPGkeyinfo\Records;

interface RecordInterface
{
    public function __construct(array $fields);
}

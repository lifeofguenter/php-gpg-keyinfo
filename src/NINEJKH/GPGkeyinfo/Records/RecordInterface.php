<?php

/**
 * This file is part of the NINEJKH/php-libgpg-json-keyinfo library.
 *
 * (c) 9JKH (Pty) Ltd. <dev@9jkh.co.za>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace NINEJKH\GPGkeyinfo\Records;

interface RecordInterface
{
    public function __construct(array $fields);
}

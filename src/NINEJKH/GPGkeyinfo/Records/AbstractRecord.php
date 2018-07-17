<?php

/**
 * This file is part of the NINEJKH/php-gpg-keyinfo library.
 *
 * (c) 9JKH (Pty) Ltd. <dev@9jkh.co.za>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace NINEJKH\GPGkeyinfo\Records;

use NINEJKH\GPGkeyinfo\Record;
use DateTime;

class AbstractRecord implements RecordInterface
{
    protected $fields = [];

    public function __construct(array $fields = [])
    {
        if (!empty($fields)) {
            $this->parse($fields);
        }
    }

    public function __get($name)
    {
        return $this->fields[$name];
    }

    public function parse(array $fields)
    {
        foreach (Record::types() as $n => $mapping) {
            if (!isset($fields[$n])) {
                break;
            }

            if ($fields[$n] === '') {
                continue;
            }

            switch($mapping['type']) {
                case 'int':
                case 'number':
                    $value = (int) $fields[$n];
                    break;

                case 'validity':
                    $value = $this->parseValidity($fields[$n]);
                    break;

                case 'datetime':
                    if (empty($fields[$n])) {
                        $value = false;
                    }
                    elseif (ctype_digit($fields[$n]) && strlen($fields[$n]) === 10) {
                        $value = new DateTime('@' . $fields[$n]);
                    }
                    else {
                        $value = new DateTime($fields[$n]);
                    }
                    break;

                case 'to_utf8':
                    $value = \NINEJKH\GPGkeyinfo\Decode::toUtf8($fields[$n]);
                    break;

                case 'split':
                    $value = array_flip(str_split($fields[$n]));
                    break;

                default:
                    $value = $fields[$n];
                    break;
            }

            $this->fields[$mapping['name']] = $value;
        }
    }

    public function hasCapabilities()
    {
        return !empty($this->fields['capabilities']) && is_array($this->fields['capabilities']);
    }

    protected function parseValidity($value)
    {
        return Record::validities($value);
    }
}

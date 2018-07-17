<?php

/**
 * This file is part of the NINEJKH/php-gpg-keyinfo library.
 *
 * (c) 9JKH (Pty) Ltd. <dev@9jkh.co.za>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace NINEJKH\GPGkeyinfo;

use Iterator;

class Parser implements Iterator
{
    private $records = [];

    private $position = 0;

    public function __construct($data = null)
    {
        $this->position = 0;

        if ($data !== null) {
            $this->parse($data);
        }
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->records[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->records[$this->position]);
    }

    public function parse($data)
    {
        $pos = -1;
        $rows = preg_split('~\r\n|\r|\n~', $data, null, PREG_SPLIT_NO_EMPTY);

        foreach ($rows as $row) {
            $columns = explode(':', $row);

            if ($columns[0] === 'pub') {
                $this->records[++$pos] = [];
            }

            $class_name = 'NINEJKH\\GPGkeyinfo\\Records\\' . ucfirst($columns[0]);

            if (class_exists($class_name, true)) {
                $this->records[$pos][] = new $class_name($columns);
            }
        }
    }

    public function getRecords()
    {
        return $this->records;
    }
}

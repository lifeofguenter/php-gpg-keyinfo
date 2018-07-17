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

class Record
{
    const VALIDITY_NEW = 1;
    const VALIDITY_INVALID = 2;
    const VALIDITY_DISABLED = 4;
    const VALIDITY_REVOKED = 8;
    const VALIDITY_EXPIRED = 16;
    const VALIDITY_UNKNOWN = 32;
    const VALIDITY_UNDEFINED = 64;
    const VALIDITY_NOT = 128;
    const VALIDITY_MARGINAL = 256;
    const VALIDITY_FULL = 512;
    const VALIDITY_ULTIMATE = 1024;
    const VALIDITY_WELL = 2048;
    const VALIDITY_SPECIAL = 4096;

    protected static $validities = [
        'o' => self::VALIDITY_NEW,
        'i' => self::VALIDITY_INVALID,
        'd' => self::VALIDITY_DISABLED,
        'r' => self::VALIDITY_REVOKED,
        'e' => self::VALIDITY_EXPIRED,
        '-' => self::VALIDITY_UNKNOWN,
        'q' => self::VALIDITY_UNDEFINED,
        'n' => self::VALIDITY_NOT,
        'm' => self::VALIDITY_MARGINAL,
        'f' => self::VALIDITY_FULL,
        'u' => self::VALIDITY_ULTIMATE,
        'w' => self::VALIDITY_WELL,
        's' => self::VALIDITY_SPECIAL,
    ];

    // https://github.com/gpg/libgcrypt/blob/libgcrypt-1.8.3/src/gcrypt.h.in#L1103
    const PK_RSA   = 1;      /* RSA */
    const PK_RSA_E = 2;      /* (deprecated: use 1).  */
    const PK_RSA_S = 3;      /* (deprecated: use 1).  */
    const PK_ELG_E = 16;     /* (deprecated: use 20). */
    const PK_DSA   = 17;     /* Digital Signature Algorithm.  */
    const PK_ECC   = 18;     /* Generic ECC.  */
    const PK_ELG   = 20;     /* Elgamal       */
    const PK_ECDSA = 301;    /* (only for external use).  */
    const PK_ECDH  = 302;    /* (only for external use).  */
    const PK_EDDSA = 303;    /* (only for external use).  */

    protected static $types = [
        0 => [
            'name' => 'type',
            'type' => 'string',
        ],
        1 => [
            'name' => 'validity',
            'type' => 'validity',
        ],
        2 => [
            'name' => 'key_length',
            'type' => 'int',
        ],
        3 => [
            'name' => 'pub_key_algo',
            'type' => 'int',
        ],
        4 => [
            'name' => 'key_id',
            'type' => 'string',
        ],
        5 => [
            'name' => 'creation_date',
            'type' => 'datetime',
        ],
        6 => [
            'name' => 'expiration_date',
            'type' => 'datetime',
        ],
        7 => [
            'name' => 'serial_number',
            'type' => 'string',
        ],
        8 => [
            'name' => 'ownertrust',
            'type' => 'string',
        ],
        9 => [
            'name' => 'user_id',
            'type' => 'to_utf8',
        ],
        10 => [
            'name' => 'signature_class',
            'type' => 'string',
        ],
        11 => [
            'name' => 'capabilities',
            'type' => 'split',
        ],
        12 => [
            'name' => 'issuer_fpr',
            'type' => 'string',
        ],
        13 => [
            'name' => 'flag',
            'type' => 'string',
        ],
        14 => [
            'name' => 'sn_token',
            'type' => 'string',
        ],
        15 => [
            'name' => 'sig_algo',
            'type' => 'int',
        ],
        16 => [
            'name' => 'curve',
            'type' => 'string',
        ],
        17 => [
            'name' => 'compliance_flags',
            'type' => 'int',
        ],
        18 => [
            'name' => 'last_update',
            'type' => 'datetime',
        ],
        19 => [
            'name' => 'origin',
            'type' => 'to_utf8',
        ],
        20 => [
            'name' => 'comment',
            'type' => 'string',
        ],
    ];

    public static function types()
    {
        return static::$types;
    }

    public static function validities($letter = null)
    {
        if ($letter === null) {
            return static::$validities;
        }

        if (isset(static::$validities[$letter])) {
            return static::$validities[$letter];
        }
    }
}

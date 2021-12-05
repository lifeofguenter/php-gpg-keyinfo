<?php

/**
 * This file is part of the lifeofguenter/php-gpg-keyinfo library.
 *
 * (c) Günter Grodotzki <gunter@grodotzki.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Lifeofguenter\GPGkeyinfo\Records;

trait Capabilities
{
    public function canEncrypt()
    {
        return $this->hasCapability('e');
    }

    public function canSign()
    {
        return $this->hasCapability('s');
    }

    public function canCertify()
    {
        return $this->hasCapability('c');
    }

    public function canAuthenticate()
    {
        return $this->hasCapability('a');
    }

    public function canUnknown()
    {
        return $this->hasCapability('?');
    }

    public function hasCapability($letter)
    {
        if (
            $this->hasCapabilities() &&
            (isset($this->fields['capabilities'][$letter]) || isset($this->fields['capabilities'][strtoupper($letter)]))
        ) {
            return true;
        }

        return false;
    }
}

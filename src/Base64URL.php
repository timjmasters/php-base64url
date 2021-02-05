<?php

/*
 * Copyright (C) 2021 Timothy Masters <timothy.john.masters@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace TimJMasters\Base64URL;

class Base64URL {

    /**
     * Encode a string using a modified Base64 encoding as specified in <a href="https://tools.ietf.org/html/rfc4648#section-5">rfc4648 section 5</a>
     * @param string $string 
     * @return string Returns encoded base64 string without trailing = characters and replacements for unsafe characters: <ul><li>+ replaced with -</li><li>/ replaced with _</li></ul
     * @see base64_encode
     */
    public static function encode(string $string): string {
        // Normal base64 encode
        $base64 = base64_encode($string);

        // Remove trailing =
        $trim = rtrim($base64, "=");

        // Replace + with - and / with _
        return str_replace(["+", "/"], ["-", "_"], $trim);
    }

    /**
     * Decode a Base64URL encoded string
     * @param type $encoded
     * @return string <p>Returns the decoded data or <b><code>FALSE</code></b> on failure. The returned data may be binary.</p>
     * @see base64_decode
     */
    public static function decode(string $encoded): string {
        // Reverse replacements
        $trim = str_replace(["-", "_"], ["+", "/"], $encoded);

        // Normal base64 decode (strict)
        return base64_decode($trim, true);
    }

}

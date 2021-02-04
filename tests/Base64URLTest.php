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

namespace Tests\TimJMasters\Base64URL;

use PHPUnit\Framework\TestCase;
use TimJMasters\Base64URL\Base64URL;

final class Base64URLTest extends TestCase {

    public function testEmptyData() {
        // Empty string should encode as empty string
        $string = "";
        // Encode it
        $encoded = Base64URL::encode($string);

        // Check it's a string
        $this->assertIsString($encoded);

        // Check it's empty string
        $this->assertEquals("", $encoded, "Expected empty string to be encoded as an empty string");
    }

    public function testEncodeUsuallyUnsafeBase64() {
        // Check replacements for 63rd and 64th characters as standard base64 characters are unsafe for url encodings
        // The following string encoded using standard base64 encoding would result in "+/8="
        $string = pack("CC", 0b11111011, 0b11111111);

        // Encode the string
        $encoded = Base64URL::encode($string);

        // Check it doesn't contain any = characters
        $this->assertStringNotContainsString("=", $encoded, "Equals padding character not trimmed, it's not required for base64 encoded url safe strings and isn't safe for url encoding.");

        // Check it encodes as "-_8"
        $this->assertEquals("-_8", $encoded, "Unsafe characters don't appear to be replaced correctly.");

        // We've already checked single padding character, let's check double just to be sure
        // The following string would normally be encoded as "YQ=="
        $string = pack("a", "abcdefg");

        // Encode it
        $encoded = Base64URL::encode($string);

        // Check it doesn't contain any = characters
        $this->assertStringNotContainsString("=", $encoded, "Equals padding character not trimmed, it's not required for base64 encoded url safe strings and isn't safe for url encoding.");
    }

    public function testDecode() {
        // Test decoded equals random string encoded
        // Do 100 iterations
        for ($i = 0; $i < 100; $i++) {
            // Generate random string
            $length = random_int(20, 100);
            $string = random_bytes($length);

            // Encode the string
            $encoded = Base64URL::encode($string);

            // Check decoded equals the original
            $this->assertSame($string, Base64URL::decode($encoded));
        }
    }

}

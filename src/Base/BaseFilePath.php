<?php

/*
 * BSD 3-Clause License
 * 
 * Copyright (c) 2018, Abexto - Helicon Software Development / Amylian Project
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * 
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 * 
 * * Neither the name of the copyright holder nor the names of its
 *   contributors may be used to endorse or promote products derived from
 *   this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 */

namespace Amylian\Utils\Base;

/**
 * Path Helpers
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class BaseFilePath
{

    /**
     * Replaces system specific path separators with the specified path separator
     * 
     * @param string $path Path to normalize
     * @param string|null $dirSeparator Directory separator to use. If `null`, `DIRECTORY_SEPARATOR` is used.
     */
    public static function normalizePath($path, $dirSeparator = null)
    {
        (isset($dirSeparator)) || $dirSeparator = DIRECTORY_SEPARATOR;
        if ($dirSeparator !== '\\') {
            return str_replace('\\', $dirSeparator, $path);
        } elseif ($dirSeparator !== '/') {
            return str_replace('/', $dirSeparator, $path);
        } else {
            return $path;
        }
    }

    /**
     * Tries to determine if the given path is relative
     * @param type $path
     */
    public static function isRelativePath($path, $dirSeparator = null, $normalizePath = true)
    {
        (isset($dirSeparator)) || $dirSeparator = DIRECTORY_SEPARATOR;
        if ($normalizePath) {
            $path = static::normalizePath($path, $dirSeparator);
        }
        //
        // Check if we have got a relative path
        //
        $firstSeparatorPos = strpos($path, $dirSeparator);
        $driveSeparatorPos = strpos($path, ':');
        if ($firstSeparatorPos === false) {
            // Path does not contain a separator at all, thus it's very likely to be relative,
            // but it could be a windows path pointing just to a drive, thus we check if
            // the path contains a ":"
            return ($driveSeparatorPos === false); // No separator at all means: Relative ===> RETURN false
        } elseif ($firstSeparatorPos === 0) {
            // Path begins with a directory separator, thus we can assume, that it is an absolute path
            return false; // ===> RETURN false
        } else {
            // Path contains a directory separator, but does not begin with one. This could mean,
            // that the first element specifies a drive on windows (which would mean, that it is an 
            // absolute path. Or it could mean, that the path begins with a relative 
            // directory symbol like "." or "..", which would mean, that it is a relative path
            if ($driveSeparatorPos && $driveSeparatorPos < $firstSeparatorPos) {
                return true; // ===> RETURN
            } else {
                return (strncmp($path, "." . $dirSeparator, 2) || strncmp($path, ".." . $dirSeparator, 3)); // ==> RETURN
            }
        }
    }

    /**
     * 
     * @param type $path Path to resolve
     * @param type $basePath Base path to be used for relative paths
     * @param type $dirSeparator Separator to be used in the result (default if null: `DIRECTORY_SEPARATOR`)
     * @param type $isRelativePath `true`, if given path is relative, `false` if absolute - `null` for automatic detection
     * @param bool $normalizePath If set to false, no normalization on the given path will be performed (Default: true)
     * @return string
     */
    public static function cleanpath($path, $basePath = null, $dirSeparator = null, $isRelativePath = null)
    {
        (isset($dirSeparator)) || $dirSeparator = DIRECTORY_SEPARATOR;

        ($basePath !== null) || $basePath = getcwd();
        $basePath = static::normalizePath($basePath, $dirSeparator);
        $path = static::normalizePath($path, $dirSeparator);
        if ($isRelativePath === null) {
            $isRelativePath = static::isRelativePath($path, $dirSeparator, false);
        }
        

        if ($isRelativePath) {

            if ((substr($basePath, -1) == $dirSeparator) ||
                (substr($basePath, -1) == '/')){
                $path = $basePath . $path;
            } else {
                $path = $basePath . $dirSeparator . $path;
            }
        }

        //
        // Explode the path an clean it up
        //
            
        $pes = explode($dirSeparator, $path);
        $per = [];

        foreach ($pes as $i => $e) {
            switch ($e) {
                case '':
                    if ($i < 3)
                        $per[] = $e;
                    break;
                case '.':
                    break;
                case '..':
                    if ($i > 0) {
                        unset($per[count($per) - 1]);
                    }
                    break;
                default:
                    $per[] = $e;
            }
        }

        $result = implode($per, $dirSeparator);
        return $result;
    }

}

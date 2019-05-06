<?php

/*
 * BSD 3-Clause License
 * 
 * Copyright (c) 2019, Abexto - Helicon Software Development / Amylian Project
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

namespace Amylian\Utils;

/**
 * Extends \ArrayObject and provides additional useful methods
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development <andreas.prucha@gmail.com>
 */
class ArrayObject extends \ArrayObject
{
    const COUNT_IS_SET = '';
    /**
     * Entries which are not empty
     */
    const COUNT_NOT_EMPTY = '\Amylian\Utils\notEmpty';
    /**
     * Entires which are strings or numerics 
     */
    const COUNT_VALUES  = '\Amylian\Utils\isValue';
    
    /**
     * Entires which are strings or numerics 
     */
    const COUNT_TRUE  = '\Amylian\Utils\isTrue';
    
    /**
     * Counts the items
     * @param callable $countMethod
     * @return int
     */
    public function countItems($countMethod = COUNT_IS_SET)
    {
        if ($countMethod !== '' && !is_callable($countMethod)) {
            throw new Exception\InvalidArgumentException("Method countItems requires a valid callable in parameter 'countMethod' ('(string)$countMethod' given')");
        }
        $result = 0;
        foreach ($this as $v) {
            if ($v !== null) {
                if ($countMethod === '' || call_user_func($countMethod, $v)) {
                    $result++;
                }
            }
        }
        return $result;
    }
}

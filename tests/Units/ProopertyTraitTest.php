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

namespace Amylian\Utils\Tests\Units;


/**
 * Description of ProopertyTraitTest
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development <andreas.prucha@gmail.com>
 */
class ProopertyTraitTest extends \PHPUnit\Framework\TestCase
{
    
    public function testCanReadWriteMember()
    {
        $obj = new \Amylian\Utils\Tests\Support\ObjectWithProperties();
        $obj->memb = true;
        $this->assertTrue($obj->memb);
    }
    
    public function testCanReadWriteProp()
    {
        $obj = new \Amylian\Utils\Tests\Support\ObjectWithProperties();
        $obj->prop = true;
        $this->assertTrue($obj->prop);
    }
    
    public function testHasPropertyMemb()
    {
        $obj = new \Amylian\Utils\Tests\Support\ObjectWithProperties();
        $this->assertTrue($obj->hasProperty('memb'));
    }
    
    public function testHasPropertyProp()
    {
        $obj = new \Amylian\Utils\Tests\Support\ObjectWithProperties();
        $this->assertTrue($obj->hasProperty('prop'));
    }

    public function testHasNotPropertyUnknown()
    {
        $obj = new \Amylian\Utils\Tests\Support\ObjectWithProperties();
        $this->assertFalse($obj->hasProperty('unknown'));
    }
    
    public function testIsSetProp()
    {
        $obj = new \Amylian\Utils\Tests\Support\ObjectWithProperties();
        $obj->prop = true;
        $this->assertTrue(isset($obj->prop));
        unset($obj->prop);
        $this->assertFalse(isset($obj->prop));
    }
    
    
    
}

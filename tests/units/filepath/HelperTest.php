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

namespace amylian\utils\tests\units\filepath;

/**
 * Description of HelperTest
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class HelperTest extends \PHPUnit\Framework\TestCase
{
    public function testcleanpathOnExistingCleanFileAndEverythingDefault()
    {
        $this->assertSame(\amylian\utils\FilePath::cleanpath(__FILE__), __FILE__);
    }
    
    public function testcleanpathOnExistingCleanDirAndEverythingDefault()
    {
        $this->assertSame(\amylian\utils\FilePath::cleanpath(__DIR__), __DIR__);
    }
    
    public function testcleanpathOnExistingRelativeFileAndEverythingDefault()
    {
        $this->assertSame(\amylian\utils\FilePath::cleanpath('HelperTest.php',  __DIR__),
                         __DIR__.'/HelperTest.php');
    }
    
    public function testcleanpathOnExistingRelativeFileDirAndEverythingDefault()
    {
        $this->assertSame(\amylian\utils\FilePath::cleanpath('HelperTest.php',  __DIR__),
                         __DIR__.'/HelperTest.php');
    }
    
    public function testCleanpathMisc()
    {
        $this->assertSame(\amylian\utils\FilePath::cleanpath('./To/FileName',  '/A/Path'),
                         '/A/Path/To/FileName');
        $this->assertSame(\amylian\utils\FilePath::cleanpath('../Relative/Path/To/FileName',  '/A/Path'),
                         '/A/Relative/Path/To/FileName');
        $this->assertSame(\amylian\utils\FilePath::cleanpath('./With/Messy\\../Correct/Path\\Mixture',  'A:\\Windows\\Path'),
                         'A:/Windows/Path/With/Correct/Path/Mixture');
        $this->assertSame(\amylian\utils\FilePath::cleanpath('./With/Messy\\../Correct/Path\\Mixture',  'A:\\Windows\\Path'),
                         'A:/Windows/Path/With/Correct/Path/Mixture');
        $this->assertSame(\amylian\utils\FilePath::cleanpath('sub/index.php?req=param',  'https://example.com/'),
                         'https://example.com/sub/index.php?req=param');
    }
    
    
}

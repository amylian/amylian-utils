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

namespace Amylian\Utils;

/**
 * Provides easy property support
 * 
 * 
 * This trait provides easy access to get and set methods like member variables:
 * 
 * It follows the following convention:
 * - <b>Property-Getter</b> methods MUST be named getXxx()
 * - <b>Property-Setter</b> methods MUST be named setXxx($vlaue)
 * 
 * <b>Calling Getters:</b> <code>$v = $myObject->myProperty<code> is equal to
 * <code>$v = $myObject->getMyProperty();</code>
 *          
 * <b>Calling Setters:</b> <code>$myObject->myProperty = 'xxx'</code> is equal
 * to<code>$v = $myObject->setMyProperty('xxx')</code>
 * 
 * <b>ATTENTION:</b>In the case of an access to an unknown property an
 * exception of class 
 * 
 * @author Andreas Prucha
 */
trait ṔropertyTrait
{
    /**
     * Checks if the property exists
     * 
     * This function checks if a setter method and/or a getter method
     * is implemented for the property or the member variable is declared public
     * 
     * @param string $propertyName
     * @return bool
     */
    
    protected function __propertyTraitHasProperty($propertyName)
    {
        // Check if getter or setter method exists
        if (method_exists($this, 'get'.$propertyName) || method_exists($this, 'set'.$propertyName)) {
            return true;
        }
        // Check if property is public
        try
        {
            $classReflection = new \ReflectionProperty(get_class($this), $propertyName);
            return $classReflection->isPublic();
        } catch (\ReflectionException $ex) {
            return false;
        }
    }
    
    /**
     * Checks if the property exists
     * 
     * This function checks if a setter method and/or a getter method
     * is implemented for the property or the member variable is declared public
     * 
     * @param string $propertyName
     * @return bool
     */
    public function hasProperty($propertyName)
    {
        return $this->__propertyTraitHasProperty($propertyName);
    }
    
    /**
     * Tries to call the Getter for a property
     * 
     * @param type $propertyName
     * @return void
     * @throws UnknownPropertyException
     */
    public function __get($propertyName)
    {
        $methodName = 'get'.$propertyName;
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        } else {
            throw new \Amylian\Utils\Exception\UnknownPropertyException('Error getting property: "'.$propertyName.
                    '" in object of class. "'.get_class($this).' Getter "get'.ucfirst($propertyName).'" not implemented');
        }
    }
    
    /**
     * Tries to call the Setter for a property
     * 
     * @param string $propertyName
     * @param mixed $value
     * @return void
     * @throws UnknownPropertyException
     */
    public function __set($propertyName, $value)
    {
        $methodName = 'set'.$propertyName;
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);
        } else {
            throw new \Amylian\Utils\Exception\UnknownPropertyException ('Error seting property: "'.$propertyName.
                    '" in object of class. "'.get_class($this).' Setter "set'. ucfirst($propertyName).'" not implemented');
        }
    }
    
    /**
     * Checks if the property is not null
     * @param type $propertyName
     */
    public function __isset($propertyName)
    {
        $methodName = 'get'.$propertyName;
        if (method_exists($this, $methodName)) {
            return ($this->$methodName() !== null);
        } else {
            return false;
        }
    }
    
    /**
     * Checks if the property is not null
     * @param string $propertyName
     */
    public function __unset($propertyName)
    {
        $methodName = 'set'.$propertyName;
        if (method_exists($this, $methodName)) {
            $this->$methodName(null);
        } else {
            throw new \Amylian\Utils\Exception\UnknownPropertyException('Error seting property: "'.$propertyName.
                    '" in object of class. "'.get_class($this).' Setter "set'. ucfirst($propertyName).'" not implemented');
        }
    }
    
    
}

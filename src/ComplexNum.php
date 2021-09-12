<?php

namespace complex;

/**
 * Представление комплексного числа в виде объекта
 */
class ComplexNum 
{
    protected $re = 0;
    protected $im = 0;
    
    /**
     *
     */    
    public function __construct(float $re, $im = null) 
    {
        $this->re = $re;
        $this->im = $im === null ? 1 : $im;
    }
    
    /**
     *
     */    
    public function __get($name) 
    {
        if(isset($this->$name))
        {
            return $this->$name;        
        } 
        throw new \RuntimeException(sprintf('Property %s not found', $name));
    }
    
    /**
     *
     */    
    public function __toString() 
    {        
        $re = rtrim($this->re, 0) === '1' ? 1 : $this->re;
        $im = abs($this->im);
        $im = $im < 10 && rtrim($im, 0) === '1' ? '' : $im;

        switch(true)
        {
            case $this->re == 0 :
               return $im .'i';
            case $this->im == 0 :
               return (string)$this->re;
            case $this->re < 0 && $this->im > 0 :
               return '-'. abs($re) .' + '. $im .'i';
            case $this->re < 0 && $this->im < 0 :
               return '-'. abs($re) .' - '. $im .'i';
            case $this->re > 0 && $this->im < 0 :
               return $re .' - '. $im .'i';
            case $this->im > 0 :
               return $re .' + '. $im .'i';
            case $this->im < 0 :
               return $re .' - '. $im .'i';
            default :
               return $re .' + ('. $im .'i)';
        }
    }
}

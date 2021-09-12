<?php

namespace complex;

use complex\ComplexNum;

/**
 * Калькулятор комплексных чисел
 */
class Calculator 
{

    protected $cmpNum_1;
    protected $cmpNum_2;    
    
    /**
     * Комплексные числа, над которыми будут проводиться действия
     */    
    public function __construct(ComplexNum $cmpNum_1, ComplexNum $cmpNum_2) 
    {
        $this->cmpNum_1 = $cmpNum_1;
        $this->cmpNum_2 = $cmpNum_2;
    }
    
    /**
     * Сложение
     */    
    public function sum() 
    {
        $re = bcadd($this->cmpNum_1->re, $this->cmpNum_2->re, 5);
        $im = bcadd($this->cmpNum_1->im, $this->cmpNum_2->im, 5);
        return $this->createComplexNum($re, $im);        
    }
    
    /**
     * Вычитание
     */    
    public function sub() 
    {
        $re = bcsub($this->cmpNum_1->re, $this->cmpNum_2->re, 5);
        $im = bcsub($this->cmpNum_1->im, $this->cmpNum_2->im, 5);
        return $this->createComplexNum($re, $im);
    }
    
    /**
     * Умножение
     */    
    public function mult() 
    {
        $multRe = bcmul($this->cmpNum_1->re, $this->cmpNum_2->re, 5);
        $multIm = bcmul($this->cmpNum_1->re, $this->cmpNum_2->im, 5);
        $re = $multRe - bcmul($this->cmpNum_1->im, $this->cmpNum_2->im, 5);
        $im = $multIm + bcmul($this->cmpNum_1->im, $this->cmpNum_2->re, 5); 
        return $this->createComplexNum($re, $im);
    }
    
    /**
     * Деление
     */    
    public function division() 
    {
        $divisor = bcpow($this->cmpNum_2->re, 2, 5) + bcpow($this->cmpNum_2->im, 2, 5);
        if($divisor === 0)
        {
            return $this->createComplexNum(0, 0);
        }
        $multRe = bcmul($this->cmpNum_1->re, $this->cmpNum_2->re, 5);
        $multIm = bcmul($this->cmpNum_1->im, $this->cmpNum_2->re, 5);
        $re = $multRe + bcmul($this->cmpNum_1->im, $this->cmpNum_2->im, 5);
        $im = $multIm - bcmul($this->cmpNum_1->re, $this->cmpNum_2->im, 5); 
        $re = bcdiv($re, $divisor, 5);
        $im = bcdiv($im, $divisor, 5);
        return $this->createComplexNum($re, $im);
    }
    
    /**
     * При таком простом примере нет необходимости
     * делать инъекцию зависимости, достаточно простой композиции
     */    
    protected function createComplexNum($re, $im) 
    {
        return new ComplexNum((float)$re, (float)$im);
    }
}

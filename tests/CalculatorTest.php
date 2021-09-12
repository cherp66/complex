<?php 

namespace tests;

use PHPUnit\Framework\TestCase;

use complex\{
    ComplexNum,
    Calculator
};

class CalculatorTest extends TestCase
{
    /**
     * Комплексные числа в виде объектов
     */ 
    protected function getComplex()
    { 
        if(empty($this->complex)) {
            $this->complex = [ 
                [new ComplexNum(1, 1), new ComplexNum(2, 2)], 
                [new ComplexNum(-1, 1), new ComplexNum(2, -2)], 
                [new ComplexNum(-1, -1), new ComplexNum(-2, -2)],
                [new ComplexNum(100, 10), new ComplexNum(200, 20)],
                [new ComplexNum(1.5, 0.2), new ComplexNum(2.5, 0.4)],
            ];
        }        
        return $this->complex;
    }
    
    /**
     * Результаты сложения
     */ 
    protected function getExaplesSum()
    { 
        return [ 
            '3 + 3i', 
            '1 - i', 
            '-3 - 3i',
            '300 + 30i',
            '4 + 0.6i',
        ];
    }
    
    /**
     * Результаты разницы
     */ 
    protected function getExaplesSub()
    { 
        return [ 
            '-1 - i', 
            '-3 + 3i', 
            '1 + i',
            '-100 - 10i',
            '-1 - 0.2i',
        ];
    }
    
    /**
     * Результаты умножения
     */ 
    protected function getExaplesMult()
    { 
        return [ 
            '4i', 
            '4i', 
            '4i',
            '19800 + 4000i',
            '3.67 + 1.1i',
        ];
    }
    
    /**
     * Результаты деления
     */ 
    protected function getExaplesDivision()
    { 
        return [ 
            '0.5', 
            '-0.5', 
            '0.5',
            '0.5',
            '0.5975 - 0.0156i',
        ];
    }
    
    /**
     * Объект
     */  
    public function testComplexNum()
    { 
        $complex = new ComplexNum(1, 2);
        $this->assertInstanceOf(ComplexNum::class, $complex);
        $this->assertEquals('1 + 2i', (string)$complex);
    }
    
    /**
     * Исключение
     */  
    public function testException()
    { 
        $this->expectException(\RuntimeException::class);
        $complex = new ComplexNum(1, 2);
        $complex->dummy;
    }
    
    /**
     * Сложение
     */  
    public function testSum()
    { 
        $example = $this->getExaplesSum();
        $this->asserts($example, 'sum');
    } 

    /**
     * Вычитание
     */  
    public function testSub()
    { 
        $example = $this->getExaplesSub();
        $this->asserts($example, 'sub');
    } 

    /**
     * Умножение
     */  
    public function testMult()
    { 
        $example = $this->getExaplesMult();
        $this->asserts($example, 'mult');
    }    
    
    /**
     * Деление
     */  
    public function testDivision()
    { 
        $example = $this->getExaplesDivision();
        $this->asserts($example, 'division');
    }
    
    /**
     * 
     */ 
    public function asserts($examples, $method)
    { 
        foreach($this->getComplex() as $i => $data) {
            $res = (new Calculator($data[0], $data[1]))->$method();
            $this->assertEquals($examples[$i], (string)$res); 
        }
    }     
}

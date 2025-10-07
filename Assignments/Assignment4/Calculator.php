<?php

class Calculator {
    
    public function calc($operator = null, $num1 = null, $num2 = null) {
        if (func_num_args() !== 3) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
        if (!is_string($operator) || !in_array($operator, ['+', '-', '*', '/'])) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
        switch ($operator) {
            case '+':
                $answer = $num1 + $num2;
                break;
            case '-':
                $answer = $num1 - $num2;
                break;
            case '*':
                $answer = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0) {
                    return "<p>The calculation is {$num1} {$operator} {$num2}. The answer is cannot divide a number by zero.</p>";
                }
                $answer = $num1 / $num2;
                break;
        }
        
        return "<p>The calculation is {$num1} {$operator} {$num2}. The answer is {$answer}.</p>";
    }
}

?>


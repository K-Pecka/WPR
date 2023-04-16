<?php
class SimpleCalculator
{
    private $value1;
    private $value2;
    private $result = null;
    public function __construct($value1, $value2)
    {
        $this->value1 = is_numeric($value1) ? $value1 : null;
        $this->value2 = is_numeric($value2) ? $value2 : null;
    }
    public function check()
    {
        return !($this->value1 == null || $this->value2 == null);
    }
    public function add()
    {
        $this->result = $this->value1 + $this->value2;
    }
    public function subtract()
    {
        $this->result = $this->value1 - $this->value2;
    }
    public function multiply()
    {
        $this->result = $this->value1 * $this->value2;
    }
    public function divide()
    {
        $this->result = $this->value1 == 0 ? null : $this->value1 / $this->value2;
    }
    public function renderResult($operation)
    {
        return $this->result == null &&  $this->result != 0 ?
            "ERROR" :
            $this->value1 . " " . $operation . " " . $this->value2 . " = " . $this->result;
    }
}

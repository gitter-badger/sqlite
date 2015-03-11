<?php

namespace Concat\SQLite;

class RaiseFunction extends AbstractExpression {

    private $function;
    private $errorMessage;

    const IGNORE = "IGNORE";
    const ROLLBACK = "ROLLBACK";
    const ABORT = "ABORT";
    const FAIL = "FAIL"

    public function __construct($function, $errorMessage = ""){

        $this->errorMessage = $errorMessage;
        $this->function = $function;
    }

    protected function build(){

        $query = "RAISE ";

        if($this->errorMessage){
            $query .= ",$this->errorMessage";
        }

        $query .= " ($this->function)";

        return $query;
    }
}

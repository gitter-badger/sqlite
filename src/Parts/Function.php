<?php

namespace Concat\SQLite;

class Function extends AbstractExpression {

    private $name;

    private $parameters;

    private $distict;

    public function __construct($name, $parameters = "", $distict = false){
        $this->name = $name;
        $this->parameters = $parameters;
        $this->distict = $distict;
    }

    public function __toString(){
        $function = "$this-name(";

        if($this->distict){
            $function .= "DISTINCT ";
        }

        if($this->parameters){
            if(is_array($this->parameters)){
                $function .= join(",", $this->parameters);
            } else {
                $function .= $this->parameters;
            }
        }

        $function .= ")";

        return $function;
    }
}

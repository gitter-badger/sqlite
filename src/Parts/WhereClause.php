<?php

namespace Concat\SQLite;

class WhereClause extends AbstractExpression
{
    private $isand;

    private $left;
    private $operator;
    private $right;

    public function __construct($left, $operator, $right)
    {
        $this->left = $left;
        $this->operator = $operator;
        $this->right = $right;
    }

    public function setAnd($isand)
    {
        $this->isand = $isand ? "AND" : "OR";
    }

    public function __toString()
    {
        if ($this->operator === null || $this->right === null) {
            $query = $this->left;
        } else {
            $operator = strtoupper($this->operator);

            if (is_a($this->left, AbstractExpression::class)) {
                $left = "($this->left)";
            } else {
                $left = $this->left;
            }

            if (is_array($this->right)) {
                $right = "(".join(",", $this->right).")";
            } elseif (is_a($this->right, AbstractExpression::class)) {
                $right = "($this->right)";
            } else {
                $right = $this->quote($this->right);
            }

            $query = "$left $operator $right";
        }

        if ($this->isand) {
            $query .= " $this->isand";
        }

        return $query;
    }
}

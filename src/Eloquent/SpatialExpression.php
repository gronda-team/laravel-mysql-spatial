<?php

namespace Grimzy\LaravelMysqlSpatial\Eloquent;

use Illuminate\Database\Grammar;
use Illuminate\Database\Query\Expression;

class SpatialExpression extends Expression
{
    /**
     * Laravel 10 rewrote query expressions: the Expression contract now
     * declares getValue(Grammar $grammar). The parameter is optional + nullable
     * here so the signature stays compatible with Laravel 8/9 (whose base
     * Expression::getValue() takes no arguments) as well as Laravel 10.
     *
     * @param \Illuminate\Database\Grammar|null $grammar
     * @return string
     */
    public function getValue(?Grammar $grammar = null)
    {
        return "ST_GeomFromText(?, ?, 'axis-order=long-lat')";
    }

    public function getSpatialValue()
    {
        return $this->value->toWkt();
    }

    public function getSrid()
    {
        return $this->value->getSrid();
    }
}

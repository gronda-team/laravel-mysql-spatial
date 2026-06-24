<?php

namespace Grimzy\LaravelMysqlSpatial\Schema;

use Illuminate\Database\Schema\Blueprint as IlluminateBlueprint;

class Blueprint extends IlluminateBlueprint
{
    /**
     * Add a geometry column on the table.
     *
     * Signature kept compatible with Illuminate\Database\Schema\Blueprint::geometry()
     * as of Laravel 11 ($subtype, $srid). This grammar only applies $srid (see
     * MySqlGrammar::modifySrid()); $subtype is accepted for compatibility but unused.
     *
     * Backward compatibility: historically this fork accepted the SRID as the second
     * positional argument (e.g. geometry('col', 4326)). When an integer is passed as
     * $subtype, it is treated as the SRID so existing migrations keep working.
     *
     * @param string          $column
     * @param string|int|null $subtype
     * @param int|null        $srid
     *
     * @return \Illuminate\Support\Fluent
     */
    public function geometry($column, $subtype = null, $srid = null)
    {
        if (is_int($subtype)) {
            $srid = $subtype;
        }

        return $this->addColumn('geometry', $column, compact('srid'));
    }

    /**
     * Add a point column on the table.
     *
     * @param string   $column
     * @param null|int $srid
     *
     * @return \Illuminate\Support\Fluent
     */
    public function point($column, $srid = null)
    {
        return $this->addColumn('point', $column, compact('srid'));
    }

    /**
     * Add a linestring column on the table.
     *
     * @param string   $column
     * @param null|int $srid
     *
     * @return \Illuminate\Support\Fluent
     */
    public function lineString($column, $srid = null)
    {
        return $this->addColumn('linestring', $column, compact('srid'));
    }

    /**
     * Add a polygon column on the table.
     *
     * @param string   $column
     * @param null|int $srid
     *
     * @return \Illuminate\Support\Fluent
     */
    public function polygon($column, $srid = null)
    {
        return $this->addColumn('polygon', $column, compact('srid'));
    }

    /**
     * Add a multipoint column on the table.
     *
     * @param string   $column
     * @param null|int $srid
     *
     * @return \Illuminate\Support\Fluent
     */
    public function multiPoint($column, $srid = null)
    {
        return $this->addColumn('multipoint', $column, compact('srid'));
    }

    /**
     * Add a multilinestring column on the table.
     *
     * @param string   $column
     * @param null|int $srid
     *
     * @return \Illuminate\Support\Fluent
     */
    public function multiLineString($column, $srid = null)
    {
        return $this->addColumn('multilinestring', $column, compact('srid'));
    }

    /**
     * Add a multipolygon column on the table.
     *
     * @param string   $column
     * @param null|int $srid
     *
     * @return \Illuminate\Support\Fluent
     */
    public function multiPolygon($column, $srid = null)
    {
        return $this->addColumn('multipolygon', $column, compact('srid'));
    }

    /**
     * Add a geometrycollection column on the table.
     *
     * @param string   $column
     * @param null|int $srid
     *
     * @return \Illuminate\Support\Fluent
     */
    public function geometryCollection($column, $srid = null)
    {
        return $this->addColumn('geometrycollection', $column, compact('srid'));
    }

    /**
     * Specify a spatial index for the table.
     *
     * Signature kept compatible with Illuminate\Database\Schema\Blueprint::spatialIndex()
     * as of Laravel 12, which added a third $operatorClass argument (a PostgreSQL
     * concept). It is accepted for compatibility but unused by this MySQL grammar.
     *
     * @param string|array $columns
     * @param string|null  $name
     * @param string|null  $operatorClass
     *
     * @return \Illuminate\Support\Fluent
     */
    public function spatialIndex($columns, $name = null, $operatorClass = null)
    {
        return $this->indexCommand('spatial', $columns, $name);
    }

    /**
     * Indicate that the given index should be dropped.
     *
     * @param string|array $index
     *
     * @return \Illuminate\Support\Fluent
     */
    public function dropSpatialIndex($index)
    {
        return $this->dropIndexCommand('dropIndex', 'spatial', $index);
    }
}

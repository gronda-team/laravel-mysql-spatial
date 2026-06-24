<?php

namespace Grimzy\LaravelMysqlSpatial\Schema;

use Closure;
use Illuminate\Database\Schema\MySqlBuilder;

class Builder extends MySqlBuilder
{
    /**
     * Create a new command set with a Closure.
     *
     * @param string  $table
     * @param Closure $callback
     *
     * @return Blueprint
     */
    protected function createBlueprint($table, Closure $callback = null)
    {
        // Laravel 12 changed the Blueprint constructor to require the Connection as
        // its first argument; Laravel <= 11 accepted the table name first. The
        // removal of Connection::withTablePrefix() in Laravel 12 is used here as the
        // version signal so the fork supports both framework versions.
        if (method_exists($this->connection, 'withTablePrefix')) {
            return new Blueprint($table, $callback);
        }

        return new Blueprint($this->connection, $table, $callback);
    }
}

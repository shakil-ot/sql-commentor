<?php

namespace Shakil\QueryTracker;

use Illuminate\Support\ServiceProvider;
use Shakil\QueryTracker\Database\Connection;
use Shakil\QueryTracker\Database\MySqlConnection;

class QueryTrackerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }


    public function register()
    {
////        echo "shakil";
//        dd("hello");
        Connection::resolverFor('mysql', function ($connection, $database, $prefix, $config) {
            return new MySqlConnection($connection, $database, $prefix, $config);
        });

    }

}
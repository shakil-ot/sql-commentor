<?php

namespace Shakil\QueryTracker\Database;

use Illuminate\Database\Connection as BaseConnection;
use Shakil\QueryTracker\Utils;

class Connection extends BaseConnection
{
    protected function run($query, $bindings, \Closure $callback)
    {
        return parent::run(
            $this->appendSqlComments($query),
            $bindings,
            $callback
        );
    }


//    public function logQuery($query, $bindings, $time = null){
////        dd($query, $bindings, $time );
//    }

    private function appendSqlComments(string $query): string
    {
        static $configurationKey = 'google_sqlcommenter.include';
        $comments = [];
        $action = null;

        if (!empty(request()->route())) {
            $action = request()->route()->getAction();
//            dd(request()->route()->getActionMethod());
//            dd(request()->route());
        }
        if (config("{$configurationKey}.framework", true)) {
            $comments['framework'] = "laravel-" . app()->version();
        }
        if (config("{$configurationKey}.controller", true) && !empty($action['controller'])) {
            $comments['controller'] = explode("@", class_basename($action['controller']))[0];
        }
        if (config("{$configurationKey}.action", true) && !empty($action and $action['controller'] && str_contains($action['controller'], '@'))) {
            $comments['action'] = explode("@", class_basename($action['controller']))[1];
        }
        if (config("{$configurationKey}.route", true)) {
            $comments['route'] = request()->getRequestUri();
        }
        if (config("{$configurationKey}.db_driver", true)) {
            $connection = config('database.default');
            $comments['db_driver'] = config("database.connections.{$connection}.driver");
        }
//        if (config("{$configurationKey}.opentelemetry", true)) {
//            $carrier = Opentelemetry::getOpentelemetryValues();
//            $comments = $comments + $carrier;
//        }

        $comments['carrier'] = 'carrier';

        $query = trim($query);
        $hasSemicolon = $query[-1] === ';';
        $query = rtrim($query, ';');
        

//        dd( Utils::formatComments(array_filter($comments)) . ($hasSemicolon ? ';' : '') . $query);

        return Utils::formatComments(array_filter($comments)) . ($hasSemicolon ? ';' : '') . $query;
    }

}
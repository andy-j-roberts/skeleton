<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $table = 'metrics';
    protected $guarded = [];

    public static function add($metric)
    {
        return self::getMetric($metric)->increment('value');
    }

    public static function remove($metric)
    {
        $metric = self::getMetric($metric);
        if($metric->value > 0)
        {
            $metric->decrement('value');
        }

        return $metric;
    }

    public static function getMetric($metric)
    {
        return self::firstOrCreate(['metric' => $metric]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ReportesController extends Controller
{
    public function reportes(){
        $chart_options = [
            'chart_title' => 'user por mes',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];
        $chart = new LaravelChart($chart_options);


        return view('reportes', [
            'chart' => $chart
        ]);
    }
}

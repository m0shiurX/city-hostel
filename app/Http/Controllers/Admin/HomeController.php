<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Latest Reservations',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Reservation',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '10',
            'fields'                => [
                'room'   => 'room_info',
                'status' => '',
            ],
            'translation_key' => 'reservation',
        ];

        $settings1['data'] = [];
        if (class_exists($settings1['model'])) {
            $settings1['data'] = $settings1['model']::latest()
                ->take($settings1['entries_number'])
                ->get();
        }

        if (! array_key_exists('fields', $settings1)) {
            $settings1['fields'] = [];
        }

        $settings2 = [
            'chart_title'           => 'Total Seats',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Room',
            'group_by_field'        => 'updated_at',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'translation_key'       => 'room',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'           => 'Engaged Users',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'translation_key'       => 'user',
        ];

        $chart3 = new LaravelChart($settings3);

        $settings4 = [
            'chart_title'           => 'Total Seats',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Hostel',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '10',
            'fields'                => [
                'name'       => '',
                'address'    => '',
                'phone'      => '',
                'total_seat' => '',
            ],
            'translation_key' => 'hostel',
        ];

        $settings4['data'] = [];
        if (class_exists($settings4['model'])) {
            $settings4['data'] = $settings4['model']::latest()
                ->take($settings4['entries_number'])
                ->get();
        }

        if (! array_key_exists('fields', $settings4)) {
            $settings4['fields'] = [];
        }

        return view('home', compact('chart2', 'chart3', 'settings1', 'settings4'));
    }
}

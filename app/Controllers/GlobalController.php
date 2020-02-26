<?php

namespace ScaryLayer\Hush\Controllers;

use App\Http\Controllers\Controller;
use ScaryLayer\Hush\Helpers\Constructor;

class GlobalController extends Controller
{
    const CONFIG = 'hush.pages';

    protected $route;

    public function __construct()
    {
        $this->route = str_replace('admin.', '', str_replace('/', '.', request()->path()));
        abort_if(!config(self::CONFIG . '.' . $this->route), 404);
    }

    public function construct()
    {
        $settings = isset(config(self::CONFIG . '.' . $this->route)['get'])
                ? $this->route
                : $this->route . '.index';

        $settings = config(self::CONFIG . '.' . $this->route . '.get');
        abort_if(isset($settings['permission']) && !auth()->user()->permitted($settings['permission']), 403);

        $response = isset($settings['closure']) ? call_user_func($settings['closure']) : [];

        $baseUrl = explode('.', $this->route);
        $baseUrl = explode('.' . end($baseUrl), $this->route)[0];

        $breadcrumbs = null;
        if (isset($settings['breadcrumbs'])) {
            foreach ($settings['breadcrumbs'] as $text => $link) {
                $breadcrumbs[__("hush::admin.{$text}")] = $link;
            }
        }

        return view('hush::constructor.' . (request()->ajax() ? 'modal' : 'index'), collect($response)->merge([
            'settings' => $settings,
            'title' => isset($settings['title'])
                ? __('hush::admin.' . $settings['title'])
                : null,
            'breadcrumbs' => $breadcrumbs,
            'baseUrl' => str_replace('.', '/', $baseUrl)
        ])->all());
    }

    public function process()
    {
        $config = config(self::CONFIG . '.' . $this->route . '.' . \strtolower(request()->method()));
        abort_if(!$config, 405, 'Method not allowed');

        $config = $config[request()->action] ?? null;
        abort_if(!$config, 404);
        abort_if(isset($config['permission']) && !auth()->user()->permitted($config['permission']), 403);

        $this->runValidation($config);

        $response = call_user_func($config['closure']);

        return $response ?? [
            'status' => 'success',
            'notification' => [
                'type' => 'success',
                'text' => __('hush::admin.operation-success')
            ]
        ];
    }

    public function runValidation($config)
    {
        if (isset($config['rules'])) {
            $this->validate(
                request(),
                Constructor::closureDetector($config['rules']),
                isset($config['messages'])
                    ? Constructor::closureDetector($config['messages'])
                    : [],
                isset($config['attributes'])
                    ? Constructor::closureDetector($config['attributes'])
                    : []
            );
        } elseif (isset($config['request'])) {
            $this->validateWith($config['request']);
        }
    }
}
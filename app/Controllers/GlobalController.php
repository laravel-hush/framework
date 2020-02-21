<?php

namespace ScaryLayer\Hush\Controllers;

use App\Http\Controllers\Controller;

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
        $response = isset($settings['closure']) ? call_user_func($settings['closure']) : [];

        $baseUrl = explode('.', $this->route);
        $baseUrl = explode('.' . end($baseUrl), $this->route)[0];

        return view('hush::constructor.index', collect($response)->merge([
            'settings' => $settings,
            'baseUrl' => str_replace('.', '/', $baseUrl)
        ])->all());
    }

    public function process()
    {
        $config = config(self::CONFIG . '.' . $this->route . '.' . \strtolower(request()->method()));
        abort_if(!$config, 405, 'Method not allowed');

        $config = $config[request()->action] ?? null;
        abort_if(!$config, 404);

        if (isset($config['rules'])) {
            $this->validate(
                request(),
                is_array($config['rules']) ? $config['rules'] : call_user_func($config['rules']),
                $config['messages'] ?? [],
                $config['attributes'] ?? []
            );
        } elseif (isset($config['request'])) {
            $this->validateWith($config['request']);
        }

        $response = $config['closure']();

        return $response ?? [
            'status' => 'success',
            'notification' => [
                'type' => 'success',
                'text' => __('hush::admin.operation-success')
            ]
        ];
    }
}

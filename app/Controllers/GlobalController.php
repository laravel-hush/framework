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
                ? config(self::CONFIG . '.' . $this->route . '.get')
                : config(self::CONFIG . '.' . $this->route . '.index.get');

        $response = isset($settings['closure']) ? $settings['closure']() : [];

        return view('hush::constructor.index', collect($response)->merge([
            'settings' => $settings
        ])->all());
    }

    public function process()
    {
        $config = config(self::CONFIG . '.' . $this->route . '.' . \strtolower(request()->method()));
        abort_if(!$config, 405, 'Method not allowed');

        $config = $config[request()->action] ?? null;
        abort_if(!$config, 404);

        if (isset($config['rules'])) {
            $this->validate(request(), $config['rules'], $config['messages'] ?? [], $config['attributes'] ?? []);
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

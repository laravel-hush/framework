<?php

namespace ScaryLayer\Hush\Controllers;

use App\Http\Controllers\Controller;
use Closure;
use ScaryLayer\Hush\Helpers\Constructor;
use ScaryLayer\Hush\Models\Language;

class GlobalController extends Controller
{
    const CONFIG = 'hush.pages';
    const DEFAULT_ACTION = 'default';

    protected $route;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->route = str_replace(config('hush.app.prefix', 'admin') . '.', '', str_replace('/', '.', request()->path()));
        abort_if(!config(self::CONFIG . '.' . $this->route), 404);
    }

    /**
     * Generate GET page
     *
     * @return mixed
     */
    public function construct()
    {
        if (request()->action) {
            return $this->process();
        }

        if (!config(self::CONFIG . '.' . $this->route . '.' . self::DEFAULT_ACTION)) {
            return config(self::CONFIG . '.' . $this->route . '.index.' . self::DEFAULT_ACTION)
                ? redirect(request()->path() . '/index')
                : abort(404);
        }

        $settings = config(self::CONFIG . '.' . $this->route . '.' . self::DEFAULT_ACTION);
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

        $title = null;
        if (isset($settings['title'])) {
            $title = $settings['title'] instanceof Closure
                ? $settings['title']($response)
                : __('hush::admin.' . $settings['title']);
        }

        return view('hush::constructor.' . (request()->ajax() ? 'modal' : 'index'), collect($response)->merge([
            'settings' => $settings,
            'title' => $title,
            'langs' => Language::getList(),
            'breadcrumbs' => $breadcrumbs,
            'baseUrl' => str_replace('.', '/', $baseUrl)
        ])->all());
    }

    /**
     * Run actions
     *
     * @return mixed
     */
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

    /**
     * Run validation
     *
     * @param array $config
     * @return void
     */
    public function runValidation(array $config): void
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

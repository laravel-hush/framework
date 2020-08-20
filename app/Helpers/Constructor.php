<?php

namespace ScaryLayer\Hush\Helpers;

use Closure;

class Constructor
{
    /**
     * Generate link by config
     *
     * @param mixed $link
     * @param array $variables
     * @return string
     */
    public static function link($link, array $variables = []): string
    {
        if (is_string($link) && strpos($link, ':') !== false) {
            $params = explode('|', $link);
            [$type, $name] = explode(':', array_shift($params));

            #if (count($params)) dd($params);
            $params = collect($params)
                ->mapWithKeys(function ($param) {
                    [$name] = explode(':', $param);
                    [$empty, $value] = explode("$name:", $param);
                    return [$name => $value];
                })
                ->all();

            switch ($type) {
                case 'route':
                    return count($params)
                        ? route($name, $params)
                        : route($name);
                case 'page':
                    $params['url'] = str_replace('.', '/', $name);
                    return route('admin.constructor', $params);
                case 'action':
                    return route(
                        'admin.constructor.process',
                        collect(['url' => request()->url, 'action' => $name])
                            ->merge($params)
                            ->all()
                    );
                case 'link':
                    return $name;

            }
        } elseif ($link instanceof Closure) {
            $result = call_user_func($link, $variables);
            if (is_string($result)) {
                return $result;
            }

            switch ($result['type']) {
                case 'page':
                    return route('admin.constructor',
                        collect($result)
                            ->except('type', 'name')
                            ->merge(['url' => str_replace('.', '/', $result['name'] ?? request()->url)])
                            ->all()
                    );
                case 'action':
                    return route(
                        'admin.constructor.process',
                        collect($result)
                            ->except('type', 'name')
                            ->merge(['url' => str_replace('.', '/', $result['name'] ?? request()->url)])
                            ->all()
                    );
            }
        }

        return '#';
    }

    /**
     * Get the value by config
     *
     * @param array $variables
     * @param array $item
     * @param mixed $default
     * @return mixed
     */
    public static function value(array $variables, array $item, $default = null)
    {
        if (in_array($item['type'], ['text', 'textarea']) && ($item['multilingual'] ?? false)) {
            return isset($item['value'])
                ? self::closureDetector($item['value'], $variables)
                : $variables['model']->translationArray($item['field'] ?? $item['name']);
        } elseif (isset($item['lang'])) {
            return $variables['model']->translate(
                $item['field'] ?? $item['name'],
                $item['lang']
            );
        } elseif (isset($item['field'])) {
            return isset($variables['model']) && isset($variables['model'][$item['field']])
                ? $variables['model'][$item['field']]
                : null;
        } elseif (isset($item['value'])) {
            return self::closureDetector($item['value'], $variables);
        } elseif (isset($item['name'])) {
            return isset($variables['model']) && isset($variables['model'][$item['name']])
                ? $variables['model'][$item['name']]
                : null;
        }

        return $default;
    }

    /**
     * Detects if value is a closure and if it is - run it
     *
     * @param mixed $value
     * @param mixed $params
     * @return mixed
     */
    public static function closureDetector($value, $params = null)
    {
        return $value instanceof Closure
            ? call_user_func($value, $params)
            : $value;
    }

    /**
     * Check if menu item is active
     *
     * @param array $item
     * @return bool
     */
    public static function isMenuItemActive(array $item): bool
    {
        $link = Constructor::link($item['link'] ?? '#');
        $isActive = self::checkLinkActivity($link);
        if ($isActive || !isset($item['submenu'])) {
            return $isActive;
        }

        foreach ($item['submenu'] as $subitem) {
            $link = Constructor::link($subitem['link'] ?? '#');
            if (self::checkLinkActivity($link)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if link is active
     *
     * @param string $link
     * @return bool
     */
    private static function checkLinkActivity(string $link): bool
    {
        $parts = explode('/', $link);
        if (end($parts) == 'index') {
            array_pop($parts);
        }

        $link = implode('/', $parts);

        return mb_strpos(request()->url(), $link) !== false;
    }
}

<?php

namespace ScaryLayer\Hush\Helpers;

use Closure;

class Constructor
{
    /**
     * Generate link by config
     *
     * @param array $item
     * @param array $variables
     * @return string
     */
    public static function link(array $item, array $variables = []): string
    {
        $link = '#';
        if (isset($item['route'])) {
            $link = is_array($item['route'])
                ? route($item['route']['name'], call_user_func($item['route']['params'], $variables))
                : route($item['route']);
        } elseif (isset($item['constructor'])) {
            $link = is_string($item['constructor'])
                ? route('admin.constructor', ['url' => str_replace('.', '/', $item['constructor'])])
                : route(
                    $item['constructor']['route'] ?? 'admin.constructor',
                    collect($item['constructor'])
                        ->except('route', 'url')
                        ->merge(['url' => str_replace('.', '/', $item['constructor']['url'] ?? request()->url)])
                        ->all()
                );
        } elseif (isset($item['action'])) {
            $link = is_string($item['action'])
                ? route('admin.constructor.process', [
                    'url' => request()->url,
                    'action' => $item['action']
                ])
                : route(
                    'admin.constructor.process',
                    collect($item['action'])
                        ->except('route', 'url')
                        ->merge(['url' => str_replace('.', '/', $item['action']['url'] ?? request()->url)])
                        ->all()
                );
        } elseif (isset($item['link'])) {
            $link = $item['link'];
        } elseif (isset($item['closure'])) {
            $link = call_user_func($item['closure'], $variables);
        }

        return $link;
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
        $link = Constructor::link($item);
        $isActive = self::checkLinkActivity($link);
        if ($isActive || !isset($item['submenu'])) {
            return $isActive;
        }

        foreach ($item['submenu'] as $subitem) {
            $link = Constructor::link($subitem);
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

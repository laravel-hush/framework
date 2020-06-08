<?php

namespace ScaryLayer\Hush\Helpers;

use Closure;

class Constructor
{
    public static function link($item, $variables = [])
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
        } elseif (isset($item['link'])) {
            $link = $item['link'];
        } elseif (isset($item['closure'])) {
            $link = call_user_func($item['closure']);
        }

        return $link;
    }

    public static function value($variables, $item, $default = null)
    {
        if (in_array($item['type'], ['text-multilingual', 'textarea-multilingual'])) {
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

    public static function closureDetector($value, $params = null)
    {
        return $value instanceof Closure
            ? call_user_func($value, $params)
            : $value;
    }

    public static function isMenuItemActive($item)
    {
        $link = Constructor::link($item);
        $isActive = mb_strpos(request()->url(), $link) !== false;
        if ($isActive || !isset($item['submenu'])) {
            return $isActive;
        }

        foreach ($item['submenu'] as $subitem) {
            $link = Constructor::link($subitem);
            if (mb_strpos(request()->url(), $link) !== false) {
                return true;
            }
        }

        return false;
    }
}

<?php

namespace ScaryLayer\Hush\Helpers;

use ScaryLayer\Hush\View\Components\Input as InputComponent;

class Input
{
    /**
     * Render input by config
     *
     * @param array $input
     * @param array $variables
     * @return mixed
     */
    public static function render(array $input, array $variables)
    {
        $field = new InputComponent(
            $input['type'],
            $input['name'],
            Constructor::value($variables, $input, $input['default'] ?? null)
        );

        $field->data();

        $field->attributes = $field->attributes
            ->merge($input['attributes'] ?? []);

        switch ($input['type']) {
            case 'checkbox':
            case 'radio':
                $field->attributes = $field->attributes
                    ->merge([
                        'checked' => Constructor::value($variables, $input, $input['default'] ?? []),
                    ]);

                return $field
                    ->render()
                    ->with($field->data())
                    ->with('slot', isset($input['label']) ? __('hush::admin.' . $input['label']) : '')
                    ->render();

            case 'date':
            case 'datetime':
            case 'daterange':
            case 'datetimerange':
                $field->attributes = $field->attributes
                    ->merge([
                        'class' => $input['type'] . ' ' . ($input['attributes']['class'] ?? ''),
                        'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                    ]);

                break;

            case 'file':
                $field->attributes = $field->attributes
                    ->merge([
                        'multiple' => $input['multiple'] ?? false,
                        'preview' => $input['preview'] ?? false,
                        'id' => $input['attributes']['id'] ?? (isset($input['multiple']) ? null : $input['name'])
                    ]);

                break;

            case 'select':
                $field->attributes = $field->attributes
                    ->merge([
                        'label' => $input['label'] ?? null,
                        'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? null)),
                        'options' => isset($input['data']) ? call_user_func($input['data'], $variables) : [],
                        'multiple' => $input['multiple'] ?? false
                    ]);

                break;

            case 'text':
            case 'textarea':
                if (isset($input['multilingual']) && $input['multilingual']) {
                    $field->attributes = $field->attributes
                        ->merge([
                            'field-width' => $input['field_width'] ?? 'col-12',
                            'label' => $input['label'] ?? '',
                            'slugify' => isset($input['slugify']) && $input['slugify'] && $variables['model']
                                ? $input['slugify']
                                : false,
                            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? null)),
                            'multilingual' => $input['multilingual'] ?? false,
                            'multirow' => $input['multirow'] ?? false,
                        ]);

                    break;
                }

            default:
                $field->attributes = $field->attributes
                    ->merge([
                        'class' => ($input['attributes']['class'] ?? '')
                            . (isset($input['slugify']) && !$variables['model']->id ? 'sluggable' : ''),
                        'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? '')),
                        'data-slugify-target' => $input['slugify'] ?? null,
                    ]);

                break;

        }

        return $field
            ->render()
            ->with($field->data())
            ->render();
    }
}
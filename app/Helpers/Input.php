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
        switch ($input['type']) {

            case 'checkbox':
            case 'radio':
                $checkbox = new InputComponent(
                    $input['type'],
                    $input['name'],
                    Constructor::value($variables, $input, $input['default'] ?? [])
                );

                $checkbox->data();

                $checkbox->attributes = $checkbox->attributes->merge([
                    'checked' => Constructor::value($variables, $input, $input['default'] ?? []),
                    'class' => $input['class'] ?? '',
                ]);

                return $checkbox
                    ->render()
                    ->with($checkbox->data())
                    ->with('slot', isset($input['label']) ? __('hush::admin.' . $input['label']) : '')
                    ->render();

            case 'date':
            case 'datetime':
            case 'daterange':
            case 'datetimerange':
                $field = new InputComponent(
                    $input['type'],
                    $input['name'],
                    Constructor::value($variables, $input, $input['default'] ?? null)
                );

                $field->data();

                $field->attributes = $field->attributes->merge([
                    'class' => $input['type'] . ' ' . ($input['class'] ?? ''),
                    'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                ]);

                return $field
                    ->render()
                    ->with($field->data())
                    ->render();

            case 'file':
                $file = new InputComponent(
                    'file',
                    $input['name'],
                    Constructor::value($variables, $input, $input['default'] ?? [])
                );

                $file->data();

                $file->attributes = $file->attributes->merge([
                    'multiple' => $input['multiple'] ?? false,
                    'preview' => $input['preview'] ?? false,
                    'id' => $input['id'] ?? (isset($input['multiple']) ? null : $input['name'])
                ]);

                return $file
                    ->render()
                    ->with($file->data())
                    ->render();

            case 'select':
                $select = new InputComponent(
                    'select',
                    $input['name'],
                    Constructor::value($variables, $input, $input['default'] ?? [])
                );

                $select->data();

                $select->attributes = $select->attributes->merge([
                    'id' => $input['id'] ?? null,
                    'class' => $input['class'] ?? null,
                    'label' => $input['label'] ?? null,
                    'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? null)),
                    'options' => isset($input['data']) ? call_user_func($input['data'], $variables) : [],
                    'multiple' => $input['multiple'] ?? false
                ]);

                return $select
                    ->render()
                    ->with($select->data())
                    ->render();

            case 'text':
            case 'textarea':
                if (isset($input['multilingual']) && $input['multilingual']) {
                    $field = new InputComponent(
                        $input['type'],
                        $input['name'],
                        Constructor::value($variables, $input, $input['default'] ?? [])
                    );

                    $field->data();

                    $field->attributes = $field->attributes->merge([
                        'field-width' => $input['field_width'] ?? 'col-12',
                        'label' => $input['label'] ?? '',
                        'slugify' => isset($input['slugify']) && $input['slugify'] && $variables['model']
                            ? $input['slugify']
                            : false,
                        'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? null)),
                        'multilingual' => $input['multilingual'] ?? false,
                        'multirow' => $input['multirow'] ?? false,
                    ]);

                    return $field
                        ->render()
                        ->with($field->data())
                        ->render();
                }

            default:
                $field = new InputComponent(
                    $input['type'],
                    $input['name'],
                    Constructor::value($variables, $input, $input['default'] ?? null)
                );

                $field->data();

                $field->attributes = $field->attributes->merge([
                    'class' => ($input['class'] ?? '')
                        . (isset($input['slugify']) && !$variables['model']->id ? 'sluggable' : ''),
                    'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? '')),
                    'data-slugify-target' => $input['slugify'] ?? null,
                    'disabled' => $input['disabled'] ?? false,
                ])->merge($input['attributes'] ?? []);

                return $field
                    ->render()
                    ->with($field->data())
                    ->render();

        }
    }
}
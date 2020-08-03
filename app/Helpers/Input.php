<?php

namespace ScaryLayer\Hush\Helpers;

use Collective\Html\FormFacade as Form;
use ScaryLayer\Hush\View\Components\Input as InputComponent;
use ScaryLayer\Hush\View\Components\InputCheckbox;
use ScaryLayer\Hush\View\Components\InputFile;
use ScaryLayer\Hush\View\Components\InputMultilingual;
use ScaryLayer\Hush\View\Components\InputRadio;

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
                $checkbox = new InputCheckbox(
                    $input['name'],
                    Constructor::value($variables, $input, $input['default'] ?? [])
                );
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
                $file = new InputFile(
                    $input['name'],
                    $input['multiple'] ?? false,
                    $input['preview'] ?? false,
                    Constructor::value($variables, $input, $input['default'] ?? [])
                );
                return $file
                    ->render()
                    ->with($file->data())
                    ->with('id', $input['id'] ?? (isset($input['multiple']) ? null : $input['name']))
                    ->render();

            case 'radio':
                $radio = new InputRadio(
                    $input['name'],
                    Constructor::value($variables, $input, $input['default'] ?? [])
                );
                return $radio
                    ->render()
                    ->with($radio->data())
                    ->with('slot', isset($input['label']) ? __('hush::admin.' . $input['label']) : '')
                    ->render();

            case 'select':
                $placeholder = !isset($input['multiple']) || !$input['multiple']
                    ? __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                    : null;

                return Form::{$input['type']}(
                    $input['name'],
                    isset($input['data']) ? call_user_func($input['data'], $variables) : [],
                    Constructor::value($variables, $input, $input['default'] ?? []),
                    [
                        'id' => $input['id'] ?? null,
                        'class' => 'form-control ' . ($input['class'] ?? ''),
                        'placeholder' => $placeholder,
                        'multiple' => $input['multiple'] ?? false,
                        'data-placeholder' => $placeholder
                    ]);

            case 'text':
            case 'textarea':
                if (isset($input['multilingual']) && $input['multilingual']) {
                    $field = new InputMultilingual(
                        $input['type'],
                        $input['name'],
                        $input['multirow'] ?? false,
                        Constructor::value($variables, $input, $input['default'] ?? [])
                    );

                    $field->data();

                    $field->attributes = $field->attributes->merge([
                        'field-width' => $input['field_width'] ?? 'col-12',
                        'label' => $input['label'] ?? '',
                        'slugify' => isset($input['slugify']) && $input['slugify'] && $variables['model']
                            ? $input['slugify']
                            : false,
                        'placeholder' => $input['placeholder'] ?? null
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
                ])->merge($input['attributes'] ?? []);

                return $field
                    ->render()
                    ->with($field->data())
                    ->render();

        }
    }
}
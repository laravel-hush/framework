<?php

namespace ScaryLayer\Hush\Helpers;

use Collective\Html\FormFacade as Form;
use ScaryLayer\Hush\Models\Language;

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
                return view('hush::components.inputs.checkbox', [
                    'name' => $input['name'],
                    'is_checked' => Constructor::value($variables, $input, $input['default'] ?? []),
                    'label' => isset($input['label'])
                        ? __('hush::admin.' . $input['label'])
                        : ''
                    ]);
                    
            case 'date':
            case 'datetime':
            case 'daterange':
            case 'datetimerange':
                return Form::text($input['name'], Constructor::value($variables, $input, $input['default'] ?? null), [
                    'class' => "form-control {$input['type']}" . ($input['class'] ?? ''),
                    'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                ]);

            case 'file':
                return view('hush::components.inputs.file', [
                    'name' => $input['name'],
                    'value' => Constructor::value($variables, $input, $input['default'] ?? []),
                    'id' => $input['id'] ?? (isset($input['multiple']) ? null : $input['name']),
                    'multiple' => $input['multiple'] ?? null
                ]);

            case 'password':
                return Form::{$input['type']}($input['name'], [
                    'class' => 'form-control ' . ($input['class'] ?? ''),
                    'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                ]);

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

            case 'text-multilingual':
            case 'textarea-multilingual':
                return view("hush::components.inputs.{$input['type']}", [
                    'name' => $input['name'],
                    'values' => Constructor::value($variables, $input, $input['default'] ?? []),
                    'label' => $input['label'] ?? '',
                    'input' => $input,
                    'model' => $variables['model'] ?? null,
                    'langs' => Language::getList(),
                ]);

            default:
                return Form::{$input['type']}(
                    $input['name'],
                    Constructor::value($variables, $input, $input['default'] ?? null),
                    array_merge([
                        'class' => 'form-control '
                            . ($input['class'] ?? '')
                            . (isset($input['slugify']) && !$variables['model']->id ? 'sluggable' : ''),
                        'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? '')),
                        'data-slugify-target' => $input['slugify'] ?? null,
                    ], $input['attributes'] ?? []));

        }
    }
}
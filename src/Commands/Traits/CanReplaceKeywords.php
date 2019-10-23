<?php

namespace AlAminFirdows\LaravelMultiAuth\Commands\Traits;

use Illuminate\Support\Str;

trait CanReplaceKeywords
{
    /**
     * Replace names with pattern.
     * 
     * @param $stub
     * @return $this
     */
    public function replaceNames($template)
    {
        $name = $this->getParsedNameInput();

        $name = Str::snake(Str::camel(Str::plural($name)));

        $plural = [
            '{{pluralCamel}}',
            '{{pluralSlug}}',
            '{{pluralSnake}}',
            '{{pluralClass}}',
        ];

        $singular = [
            '{{singularCamel}}',
            '{{singularSlug}}',
            '{{singularSnake}}',
            '{{singularClass}}',
        ];

        $replacePlural = [
            Str::camel($name),
            Str::slug($name),
            Str::snake($name),
            ucfirst(Str::camel($name)),
        ];

        $replaceSingular = [
            str_singular(Str::camel($name)),
            str_singular(Str::slug($name)),
            str_singular(Str::snake($name)),
            str_singular(ucfirst(Str::camel($name))),
        ];

        $template = str_replace($plural, $replacePlural, $template);
        $template = str_replace($singular, $replaceSingular, $template);
        $template = str_replace('{{Class}}', ucfirst(Str::camel($name)), $template);

        return $template;
    }
}

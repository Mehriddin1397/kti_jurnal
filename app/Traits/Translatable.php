<?php

namespace App\Traits;

trait Translatable
{
    /**
     * Dyamically return translated field based on app locale.
     * Fallback to 'uz' -> 'en' -> 'ru' if empty.
     */
    public function getTranslated(string $attribute, ?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $column = $attribute . '_' . $locale;

        // Try the requested locale
        if (!empty($this->{$column})) {
            return $this->{$column};
        }

        // Fallback chain: uz -> en -> ru
        return $this->{$attribute . '_uz'}
            ?: $this->{$attribute . '_en'}
            ?: $this->{$attribute . '_ru'}
            ?? '';
    }
}

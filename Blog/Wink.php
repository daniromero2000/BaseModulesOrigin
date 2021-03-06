<?php

namespace Modules\Blog;

class Wink 
{
    /**
     * Get the default JavaScript variables for Wink.
     *
     * @return array
     */
    public static function scriptVariables()
    {
        return [
            'unsplash_key' => config('services.unsplash.key'),
            'path' => config('wink.path'),
            'preview_path' => config('wink.preview_path'),
            'author' => auth('employee')->check() ? auth('employee')->user()->only('name', 'avatar', 'id') : null,
            'default_editor' => config('wink.editor.default'),
        ];
    }
}

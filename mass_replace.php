<?php

$dir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views/public');
$iterator = new RecursiveIteratorIterator($dir);

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);

        $patterns = [
            '/(?:\$([a-zA-Z0-9_]+)->)?title_uz \?: (?:\$\1->)?title_en/' => 'title',
            '/(?:\$([a-zA-Z0-9_]+)->)?title_en \?: (?:\$\1->)?title_uz/' => 'title',
            '/(?:\$([a-zA-Z0-9_]+)->)?name_uz \?: (?:\$\1->)?name_en/' => 'name',
            '/(?:\$([a-zA-Z0-9_]+)->)?name_en \?: (?:\$\1->)?name_uz/' => 'name',
            '/(?:\$([a-zA-Z0-9_]+)->)?abstract_uz \?: (?:\$\1->)?abstract_en/' => 'abstract',
            '/(?:\$([a-zA-Z0-9_]+)->)?abstract_en \?: (?:\$\1->)?abstract_uz/' => 'abstract',
            '/(?:\$([a-zA-Z0-9_]+)->)?description_uz \?: (?:\$\1->)?description_en/' => 'description',
            '/(?:\$([a-zA-Z0-9_]+)->)?description_en \?: (?:\$\1->)?description_uz/' => 'description',
            // Now the simple ones:
            '/->title_uz/' => '->title',
            '/->title_en/' => '->title',
            '/->name_uz/' => '->name',
            '/->name_en/' => '->name',
            '/->abstract_uz/' => '->abstract',
            '/->abstract_en/' => '->abstract',
            '/->description_uz/' => '->description',
            '/->description_en/' => '->description',
            '/->body_uz/' => '->body', // About/News
            '/->keywords_uz(?: \?: ->keywords_en)?/' => '->keywords',
        ];

        $newContent = $content;
        foreach ($patterns as $pattern => $replacement) {
            $newContent = preg_replace($pattern, $replacement, $newContent);
        }

        if ($newContent !== $content) {
            file_put_contents($path, $newContent);
            echo "Updated: $path\n";
        }
    }
}

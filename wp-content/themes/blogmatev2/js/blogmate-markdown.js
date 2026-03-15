/**
 * Blogmate Markdown support
 *
 * @package Blogmate
 * @since 1.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Initialize markdown-it
        var md = window.markdownit({
            html: true,
            linkify: true,
            typographer: true
        });

        // Process markdown content in entry-content
        $('.entry-content').each(function() {
            var $this = $(this);
            var markdown = $this.text();
            markdown = markdown.replace(/\n/g, "\n\n");
            // console.info(markdown)
            var html = md.render(markdown);
            $this.html(html);
        });

        // Process markdown content with specific class
        $('.blogmate-markdown-content').each(function() {
            var $this = $(this);
            var markdown = $this.text();
            var html = md.render(markdown);
            $this.html(html).removeClass('blogmate-markdown-content');
        });

        // Add markdown support to textareas (if needed)
        $('.blogmate-markdown-editor').each(function() {
            var $textarea = $(this);
            var $preview = $('<div class="blogmate-markdown-preview"></div>').insertAfter($textarea);

            // Initial preview
            var markdown = $textarea.val();
            var html = md.render(markdown);
            $preview.html(html);

            // Update preview on input
            $textarea.on('input', function() {
                var markdown = $(this).val();
                var html = md.render(markdown);
                $preview.html(html);
            });
        });
    });
})(jQuery);
/**
 * Blogmate Mermaid support
 *
 * @package Blogmate
 * @since 1.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Check if mermaid is available
        if (typeof mermaid !== 'undefined') {
            // Initialize mermaid with proper configuration
            mermaid.initialize({
                startOnLoad: false,
                theme: 'default',
                securityLevel: 'loose',
                flowchart: {
                    useMaxWidth: true,
                    htmlLabels: true
                }
            });

            // Process mermaid diagrams after DOM is fully updated
            setTimeout(function() {
                renderMermaidDiagrams();
            }, 100);
        }
    });

    function renderMermaidDiagrams() {
        // Find all unprocessed mermaid elements
        $('.mermaid:not([data-processed])').each(function(index) {
            var $this = $(this);
            var element = $this[0];
            
            // Generate unique ID if not present
            var id = 'mermaid-' + Date.now() + '-' + index;
            if (!element.id) {
                element.id = id;
            }

            // Get mermaid code
            var code = $this.data('original-code') || $this.text();

            // Render mermaid diagram
            try {
                mermaid.render(id + '-svg', code).then(function(result) {
                    // Replace element with rendered SVG
                    $this.html(result.svg);
                    
                    // Apply proper styling
                    $this.css({
                        'width': '100%',
                        'text-align': 'center',
                        'margin': '1.5rem 0'
                    });

                    // Mark as processed
                    $this.attr('data-processed', 'true');
                }).catch(function(error) {
                    // Display error message
                    $this.html('<div class="mermaid-error">Mermaid 渲染错误: ' + error.message + '</div>');
                    $this.attr('data-processed', 'true');
                });
            } catch (error) {
                // Display error message
                $this.html('<div class="mermaid-error">Mermaid 渲染错误: ' + error.message + '</div>');
                $this.attr('data-processed', 'true');
            }
        });
    }
})(jQuery);
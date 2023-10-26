<?php
/**
 * Slick all
 */

$selector = get_field("selector");
$settings = get_field("settings");
$css = get_field("css");

$post_id = get_the_ID();

// Admin Ausgabe
if (is_admin()) {
    echo "<div class='block-editor-output'>▶️ Slick All - Selector: $selector</div>";
    return;
}

?>

<div class="slick-trigger">
    <?php if ($css): ?>
    <style>
    <?php echo $css;
?>
    </style>
    <?php endif;?>

    <script>
    jQuery(document).ready(function($) {

        // Only run if there are multiple children
        function hasMultipleChildren(parentSelector) {
            const $parent = $(parentSelector);
            if ($parent.length) {
                const childrenCount = $parent.children().length;
                return childrenCount >= 2;
            }
            return false;
        }

        const sliderSelector = "<?php echo $selector; ?>";
        const result = hasMultipleChildren(sliderSelector);

        if (result) {} else {
            return;
        }

        $(sliderSelector).slick(
            <?php if ($settings): ?> <?php echo $settings; ?> <?php endif;?>
        );
    });
    </script>
</div>
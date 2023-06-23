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
        $("<?php echo $selector; ?>").slick(
            <?php if ($settings): ?> <?php echo $settings; ?> <?php endif;?>
        );
    });
    </script>
</div>
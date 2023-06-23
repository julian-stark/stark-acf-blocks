<?php
/**
 * Scroll Animations - SAL
 */

// Admin Ausgabe
if (is_admin()) {
    echo "<div class='block-editor-output'>▶️ Scroll Animations</div>";
    return;
}

?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    sal(<?php echo get_field("sal_options"); ?>);
});
</script>
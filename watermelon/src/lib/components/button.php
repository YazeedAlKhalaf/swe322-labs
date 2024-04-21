<?php
function LinkButton($href, $text, $additionalClasses = '')
{
?>
    <a href="<?php echo $href; ?>" class="font-medium bg-green-500 px-3 py-2 rounded-lg hover:bg-green-600 transition-all <?php echo $additionalClasses; ?>">
        <?php echo $text; ?>
    </a>
<?php
}
?>
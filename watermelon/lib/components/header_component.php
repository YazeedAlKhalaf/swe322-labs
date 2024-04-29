<?php
class HeaderLink
{
    public $url;
    public $text;

    public function __construct($url, $text)
    {
        $this->url = $url;
        $this->text = $text;
    }
}
?>

<?php
/**
 * @param HeaderLink[] $links An array of HeaderLink objects
 */
function HeaderComponent($links = array())
{
?>
    <header class="flex flex-row justify-between items-center p-4 bg-green-300 h-24">
        <a href="/">
            <img src="static/images/logo.svg" class="h-6" alt="watermelon logo" />
        </a>
        <div class="flex flex-row gap-4 font-medium">
            <?php foreach ($links as $link) : ?>
                <a href="<?php echo $link->url; ?>" class="hover:bg-green-400 rounded-lg px-3 py-2 transition-all"><?php echo $link->text; ?></a>
            <?php endforeach; ?>
        </div>
    </header>
<?php
}
?>

<?php
$landing_links = array(
    new HeaderLink('features', 'Features'),
    new HeaderLink('pricing', 'Pricing'),
    new HeaderLink('testimonials', 'Testimonials')
);
?>
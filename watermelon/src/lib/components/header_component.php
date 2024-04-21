<?php
function HeaderComponent()
{
?>
    <header class="flex flex-row justify-between items-center p-4 bg-green-300">
        <a href="/">
            <img src="/static/images/logo.svg" class="h-6" />
        </a>
        <div class="flex flex-row gap-4 font-medium">
            <a href="/features" class="hover:bg-green-400 rounded-lg px-3 py-2 transition-all">Features</a>
            <a href="/pricing" class="hover:bg-green-400 rounded-lg px-3 py-2 transition-all">Pricing</a>
            <a href="/testimonials" class="hover:bg-green-400 rounded-lg px-3 py-2 transition-all">Testimonials</a>
        </div>
    </header>
<?php
}
?>
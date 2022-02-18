<?php
function getNavbar($isLoggedIn, $navbarItems)
{
    echo '<nav id="navbar" class="navbar sticky-top navbar-light bg-light px-3">
    <a class="navbar-brand" href="/"><img src="/tugas05/logo5.svg" alt="Logo Tugas05" height="36px"></a>
        <ul class="nav ">' .
        $navbarItems.
        '</ul>
    </nav>
    ';
}

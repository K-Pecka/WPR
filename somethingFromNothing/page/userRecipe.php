<?php
session_start();
require_once '../module/setPage.php';
?>
<DOCTYPE html>
    <html>

    <head>
        <?php echo $head; ?>
    </head>

    <body>
        <?php echo $nav; ?>
        <main id="content">
            <header>
                <?php echo $header ?>
            </header>
            <section id="recipes">

            </section>

        </main>
        <?php echo $footer; ?>
    </body>

    </html>
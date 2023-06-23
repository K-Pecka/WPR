<?php
session_start();
require_once '../module/setPage.php';
?>
<DOCTYPE html>
    <html>

    <head>
        <?php echo $head; ?>
        <style>
            #UserRecipes {
                display: flex;
                flex-direction: column;
            }

            .recipe,
            .recipe div:first-child {
                display: flex;
                align-items: center;
                justify-content: space-between;
                height: 10%;
                width: 100%;
            }

            .recipe div:first-child {
                justify-content: start;
            }

            .recipe div:first-child h2 {
                margin-left: 5%;
            }

            img {
                height: 100%;
                width: 20%;
            }

            .recipe div:last-child {
                min-width: 20%;
            }
        </style>
    </head>

    <body>
        <?php echo $nav; ?>
        <main id="content">
            <header>
                <?php echo $header ?>
            </header>
            <section>
                <div id="UserRecipes">

                </div>
            </section>

        </main>
        <?php echo $footer; ?>
    </body>

    </html>
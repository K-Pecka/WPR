<?php
session_start();
require_once '../module/setPage.php';
?>
<DOCTYPE html>
    <html>

    <head>
        <?php echo $head; ?>
        <style>
            #context-menu {
                display: none;
                position: absolute;
                background-color: #f1f1f1;
                border: 1px solid #ccc;
                padding: 5px 0;
            }

            #context-menu ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            #context-menu li {
                padding: 5px 20px;
                cursor: pointer;
            }

            #context-menu li:hover {
                background-color: #ccc;
            }
        </style>
    </head>

    <body>
        <?php echo $nav; ?>
        <main id="content">
            <header>
                <?php echo $header ?>
            </header>
            <section id="recipes">
            </section>
            <div id="context-menu" class="context-menu">
                <ul>
                    <li class="delete">Usuń z ulubionych</li>
                </ul>
            </div>
        </main>

        <?php echo $footer; ?>
    </body>


    </html>
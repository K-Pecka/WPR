<?php
$footer = '<footer>
    <div class="footer-content">
      <p>&copy; 2023 {{TITLE}}. Wszelkie prawa zastrzeżone.</p>
      <ul class="footer-links">
        <li><a href="#">Polityka prywatności</a></li>
        <li><a href="#">Regulamin</a></li>
        <li><a href="#">Kontakt</a></li>
      </ul>
    </div>
  </footer>';
$footer = str_replace("{{TITLE}}", $config->title, $footer);

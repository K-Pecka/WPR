<?php
$footer = '<footer>
    <div class="footer-content">
      <p>&copy; 2023 {{TITLE}}. ' . $HTML->footer->© . '.</p>
      <ul class="footer-links">';

foreach ($HTML->footer->a as $a) {
  $footer .= '<li><a href="' . $a->href . '">' . $a->content . '</a></li>';
}

$footer .= '</ul>
    </div>
  </footer>';
$footer = str_replace("{{TITLE}}", $config->title, $footer);

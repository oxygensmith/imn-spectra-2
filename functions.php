<?php
// Include everything in the inc folder

foreach (glob(__DIR__ . "/inc/*") as $filename) {
    if (!is_dir($filename)) {
        require_once($filename);
    }
}
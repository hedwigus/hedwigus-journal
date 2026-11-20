<?php
/** Preview bootstrap: stub WordPress, then render the real theme templates. */
require __DIR__ . '/wp-stub.php';
include dirname( __DIR__ ) . '/index.php';

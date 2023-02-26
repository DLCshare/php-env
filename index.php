<?php

use DLCshare\PhpEnv\ReadEnv;

require_once 'src/ReadEnv.php';

if ((new ReadEnv(__DIR__))->load()) {
    print_r($_ENV);
} else {
    echo ".env not found";
}
?>
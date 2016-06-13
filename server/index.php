<?php
require_once dirname(__FILE__)."/lib/functions.php";

env_init();

ref_set($_REQUEST["ref"]);

include dirname(__FILE__)."/theme/login.php";


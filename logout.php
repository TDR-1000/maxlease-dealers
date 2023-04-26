<?php

include 'backoffice/MAXEngine/MAX.php';

MAXSession::destroySession();

redirect('login.php');

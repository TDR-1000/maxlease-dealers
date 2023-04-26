<?php

include 'MAXEngine/MAX.php';

MAXSession::destroySession();

redirect('login.php');

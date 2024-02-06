<?php

namespace App\Enums;

enum Messages: string {
    case WRONG_CREDENTIALS = 'Please check you password or Email';
    case TASK_STATUS_DONE = 'Can\'t delete task with status DONE';
}

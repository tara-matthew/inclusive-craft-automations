<?php

namespace App;

enum ReminderStatus: string
{
    case UNPROCESSED = 'unprocessed';
    case SENT = 'sent';
    case FAILED = 'failed';

}

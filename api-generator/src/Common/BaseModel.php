<?php

namespace Fifth\Generator\Common;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use BaseFragment;

    public const ATTACHMENTS_PATH = 'attachments/';

    protected $nonUpdatable = [];
}

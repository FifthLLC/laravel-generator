<?php

namespace Fifth\Generator\Models;

use Fifth\Generator\Models\BaseFragment;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use BaseFragment;

    public const ATTACHMENTS_PATH = 'attachments/';

    protected $nonUpdatable = [];
}

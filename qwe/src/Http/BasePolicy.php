<?php


namespace Fifth\Generator\Http;


use Illuminate\Auth\Access\HandlesAuthorization;

abstract class BasePolicy
{
    use HandlesAuthorization;
}

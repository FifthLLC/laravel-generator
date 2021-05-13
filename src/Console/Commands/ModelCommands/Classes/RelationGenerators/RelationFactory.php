<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators;


use Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators\RelationTypes\BelongsToMany;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators\RelationTypes\BelongsToOne;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators\RelationTypes\HasMany;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators\RelationTypes\HasOne;

class RelationFactory
{
    public static function getRelationByType($type): ?BaseRelation
    {
        switch ($type) {
            case 'hasOne': return new HasOne();
            case 'hasMany': return new HasMany();
            case 'belongsToOne': return new BelongsToOne();
            case 'belongsToMany': return new BelongsToMany();
            default: return null;
        }
    }
}

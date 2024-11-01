<?php

namespace Alpayklncrsln\RuleSchema\Default;

use Alpayklncrsln\RuleSchema\Rule;
use Alpayklncrsln\RuleSchema\RuleSchema;

class DefaultRuleSchema
{
    public static function login(): RuleSchema
    {
        return RuleSchema::create(
            Rule::make('email')->required()->email()->max()->exists('users', 'email'),
            Rule::make('password')->required()->min(8)->max()
        );
    }

    public static function register(): RuleSchema
    {
        return RuleSchema::create(
            Rule::make('name')->required()->max(),
            Rule::make('email')->required()->email()->max()->unique('users', 'email'),
            Rule::make('password')->required()->min(8)->max()->confirmed(),
        );
    }

    public static function resetPassword(): RuleSchema
    {
        return RuleSchema::create(
            Rule::make('email')->required()->email()->max()->exists('users', 'email'),
            Rule::make('token')->required()->exists('password_resets', 'token'),
            Rule::make('password')->required()->min(8)->max()->confirmed(),
        );
    }

    public static function updatePassword(): RuleSchema
    {
        return RuleSchema::create(
            Rule::make('password')->required()->min(8)->max()->confirmed(),
        );
    }
}

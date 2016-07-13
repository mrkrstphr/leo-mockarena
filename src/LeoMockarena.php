<?php

namespace Mockarena\Leo;

use Mockarena\Leo\Matcher\ArgumentsMatcher;
use Mockarena\Leo\Matcher\CalledMatcher;
use Peridot\Leo\Assertion;

/**
 * Class LeoMockarena
 * @package Mockarena\Leo
 */
class LeoMockarena
{
    /**
     * @param Assertion $assertion
     */
    public function __invoke(Assertion $assertion)
    {
        $assertion->addMethod('calls', function ($index) {
            return $this->flag('calls', $index);
        });

        $assertion->addMethod('arguments', function (array $args, $message = "") {
            $this->flag('message', $message);
            return new ArgumentsMatcher($args);
        });

        $assertion->addMethod('called', function ($times, $message = "") {
            $this->flag('message', $message);
            return new CalledMatcher($times);
        });
    }
}

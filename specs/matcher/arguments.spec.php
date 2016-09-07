<?php

use Mockarena\Leo\Matcher\ArgumentsMatcher;
use Peridot\Leo\Assertion;
use Peridot\Leo\Responder\ResponderInterface;
use Prophecy\Prophet;

describe(ArgumentsMatcher::class, function () {
    describe('match()', function () {
        it('should return true if the arguments match', function () {
            $fn = new \Mockarena\MockFunction('foo');
            $fn->calls[] = [1, 2, 3];
            $matcher = new ArgumentsMatcher([1, 2, 3]);
            $result = $matcher->match($fn);

            expect($result->isMatch())->to->be->true();
        });

        it('should return false if the arguments do match', function () {
            $fn = new \Mockarena\MockFunction('foo');
            $fn->calls[] = [1, 2, 4];
            $matcher = new ArgumentsMatcher([1, 2, 3]);
            $result = $matcher->match($fn);

            expect($result->isMatch())->to->be->false();
        });

        it('should call the callback if a callback was passed', function () {
            $fn = new \Mockarena\MockFunction('foo');
            $fn->calls[] = [];
            $fifty = 0;
            $matcher = new ArgumentsMatcher(function () use (&$fifty) {
                $fifty = 50;
            });
            $matcher->match($fn);

            expect($fifty)->to->equal(50);
        });

        it('should adhere to the calls flag to grab a specific call', function () {
            $fn = new \Mockarena\MockFunction('foo');
            $fn->calls = [[1, 2, 3], [1, 2, 4]];

            $responder = (new Prophet())->prophesize(ResponderInterface::class);
            $assertion = new Assertion($responder->reveal());
            $assertion->flag('calls', 1);

            $matcher = new ArgumentsMatcher([1, 2, 4]);
            $matcher->setAssertion($assertion);

            $result = $matcher->match($fn);
            expect($result->isMatch())->to->be->true();
        });
    });
});

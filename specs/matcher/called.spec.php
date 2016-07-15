<?php

use Mockarena\Leo\Matcher\CalledMatcher;
use Mockarena\MockFunction;

describe(CalledMatcher::class, function () {
    describe('match()', function () {
        it('should return true if the number of calls match', function () {
            $fn = new MockFunction('foo');
            $fn->calls = [[], [], []];
            $matcher = new CalledMatcher(3);
            $result = $matcher->match($fn);

            expect($result->isMatch())->to->be->true();
        });

        it('should return false if the number of calls do not match', function () {
            $fn = new MockFunction('foo');
            $fn->calls = [[], []];
            $matcher = new CalledMatcher(4);
            $result = $matcher->match($fn);

            expect($result->isMatch())->to->be->false();
        });
    });
});

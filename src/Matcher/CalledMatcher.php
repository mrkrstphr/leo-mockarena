<?php

namespace Mockarena\Leo\Matcher;

use Peridot\Leo\Matcher\AbstractMatcher;
use Peridot\Leo\Matcher\Template\ArrayTemplate;

/**
 * Class CalledMatcher
 * @package Mockarena\Leo\Matcher
 */
class CalledMatcher extends AbstractMatcher
{
    /**
     * @var int
     */
    protected $actualCalls = 0;

    /**
     * @var string
     */
    protected $functionName;

    /**
     * {@inheritdoc}
     */
    public function getDefaultTemplate()
    {
        $template = new ArrayTemplate([
            'default' => 'Expected {{function}} to be called {{expected}} time(s), was actual {{actual}} times',
            'negated' => 'Expected {{function}} to not be called {{expected}} time(s), was called {{actual}} times'
        ]);

        return $template->setTemplateVars([
            'actual' => $this->actualCalls,
            'function' => $this->functionName
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function doMatch($actual)
    {
        $this->functionName = $actual->functionName;
        $this->actualCalls = count($actual->calls);
        return count($this->actualCalls) === $this->expected;
    }
}

<?php

namespace Mockarena\Leo\Matcher;

use Peridot\Leo\Matcher\AbstractMatcher;
use Peridot\Leo\Matcher\Template\ArrayTemplate;

/**
 * Class ArgumentsMatcher
 * @package Mockarena\Leo\Matcher
 */
class ArgumentsMatcher extends AbstractMatcher
{
    /**
     * @var array
     */
    protected $actualArguments;
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultTemplate()
    {
        $template = new ArrayTemplate([
            'default' => 'Expected {{expected}} to equal {{actual}} ',
            'negated' => 'Expected {{expected}} to not equal {{actual}}'
        ]);

        return $template->setTemplateVars(['actual' => $this->actualArguments]);
    }

    /**
     * {@inheritdoc}
     */
    protected function doMatch($actual)
    {
        $this->actualArguments = $actual->calls[$this->assertion->flag('calls')];
        return $this->expected === $this->actualArguments;
    }
}

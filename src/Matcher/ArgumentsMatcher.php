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
        $call = 0;
        if ($this->assertion && $this->assertion->flag('calls')) {
            $call = $this->assertion->flag('calls');
        }

        $this->actualArguments = $actual->calls[$call];
        return $this->expected === $this->actualArguments;
    }
}

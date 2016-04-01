<?php

/**
 * This file is part of slick/session package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Session;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

/**
 * Step definitions for slick/session package
 * 
 * @package Session
 * @behatContext
 */
class SessionContext extends \AbstractContext implements
    Context, SnippetAcceptingContext
{

}
<?php
/**
 * Part of the Joomla Framework Http Package
 *
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Http\Exception;

use Psr\Http\Client\ClientExceptionInterface;

/**
 * Exception representing an invalid or undefined HTTP response code
 *
 * @since  1.2.0
 */
class InvalidResponseCodeException extends \UnexpectedValueException implements ClientExceptionInterface
{
}

<?php

/**
 * Verdict - Decision Engine Library
 * Copyright (c) 2011-2011 Ryan Fink <rfink@redventures.net>
 *
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Verdict\Decision\Comparison;
use Verdict\Decision\Comparison\ComparisonAbstract;

/**
 * Check to see if our context is NOT in the config array
 * @author rfink
 * @since  Feb 22, 2011
 */
class NotIn extends ComparisonAbstract {


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Abstract#set_config($config)
	 */
	public function set_config($configVal) {

		if (!is_array($configVal)) {

			throw new \InvalidArgumentException('Configuration must be an array');

		}

		parent::set_config($configVal);
		return $this;

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Comparison/Decision_Comparison_Interface#compare()
	 */
	public function compare() {

		return !in_array($this->_context, $this->_config);

	}

}

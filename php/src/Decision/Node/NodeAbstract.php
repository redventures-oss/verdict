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

namespace Verdict\Decision\Node;
use Verdict\Decision\Node\NodeInterface;
use Verdict\Decision\Node\Leaf;
use Verdict\Decision\Node\Branch;
use Verdict\Decision\Comparison\ComparisonAbstract;

/**
 * Abstract base class for decision node classes
 * @author rfink
 * @since  Mar 13, 2011
 */
abstract class NodeAbstract implements NodeInterface {

	/**
	 * Array of child nodes
	 * @var Decision_Node_Abstract[]
	 */
	protected $_nodesArray = array();

	/**
	 * Condition node, when evaluated, returns TRUE or FALSE
	 * @var ComparisonAbstract
	 */
	protected $_ConditionNode = null;

	/**
	 * Pointer to our parent node
	 * @var Branch
	 */
	protected $_ParentNode = null;

	/**
	 * Key that is unique to our node
	 * @var mixed
	 */
	protected $_key = null;


	/**
	 * Set a pointer to our parent node
	 * @param Branch $Node
	 * @return NodeAbstract
	 */
	public function set_parent_node(Branch $Node) {

		$this->_ParentNode = $Node;
		return $this;

	}


	/**
	 * Set our key
	 * @param mixed $key
	 * @return Decision_Node_Abstract
	 */
	public function set_key($key) {

		$this->_key = $key;
		return $this;

	}


	/**
	 * Get our key value
	 * @return mixed
	 */
	public function get_key() {

		return $this->_key;

	}


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Node/Decision_Node_Interface#add_node($Node)
	 */
	public function add_node(NodeAbstract $Node) {

		$this->_nodesArray[] = $Node;
		return $this;

	}


	/**
	 * Set our condition node on the object
	 * @param ComparisonAbstract $Node
	 * @return NodeAbstract
	 */
	public function set_condition_node(ComparisonAbstract $Node) {

		$this->_ConditionNode = $Node;
		return $this;

	}


	/**
	 * Evaluate our decision
	 * @return Decision_Node_Value
	 */
	public function evaluate() {

		// TODO: What if we have no condition?

		// First, attempt to evaluate our current condition
		//   If it does not evaluate, discontinue traversing this path
		if (!$this->_ConditionNode->compare()) {

			return null;

		}

		// Iterate through our internal nodes and walk them
		foreach ($this->_nodesArray as $Node) {

			$Value = $Node->evaluate();

			if ($Value instanceof Leaf) {

				return $Value;

			}

		}

		// None of our nodes evaluated to true
		return null;

	}

}
<?php

/**
 * Abstract base class for decision node classes
 * @author rfink
 * @since  Mar 13, 2011
 */
abstract class Decision_Node_Abstract implements Decision_Node_Interface {

	/**
	 * Array of child nodes
	 * @var Decision_Node_Abstract[]
	 */
	protected $_nodesArray = array();

	/**
	 * Condition node, when evaluated, returns TRUE or FALSE
	 * @var Decision_Comparison_Interface
	 */
	protected $_ConditionNode = null;


	/**
	 * (non-PHPdoc)
	 * @see php/Decision/Node/Decision_Node_Interface#add_node($Node)
	 */
	public function add_node(Decision_Node_Abstract $Node) {

		$this->_nodesArray[] = $Node;
		return $this;

	}


	/**
	 * Set our condition node on the object
	 * @param Decision_Comparison_Abstract $Node
	 * @return Decision_Node_Abstract
	 */
	public function set_condition_node(Decision_Comparison_Abstract $Node) {

		$this->_ConditionNode = $Node;
		return $this;

	}


	/**
	 * Evaluate our decision
	 * @return Decision_Node_Value
	 */
	public function evaluate() {

		// First, attempt to evaluate our current condition
		//   If it does not evaluate, discontinue traversing this path
		if (!$this->_ConditionNode->compare()) {

			return null;

		}

		// Iterate through our internal nodes and walk them
		foreach ($this->_nodesArray as $Node) {

			$Value = $Node->compare();

			if ($Value instanceof Decision_Node_Leaf) {

				return $Value;

			}

		}

		// None of our nodes evaluated to true
		return null;

	}

}

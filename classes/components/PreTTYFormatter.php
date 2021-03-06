<?php

class PreTTYFormatter implements iPreTTYComponent {

	private $indent = 0;
	private $priorindent = 1;
	private $firstline = true;
	private $trailingDots = false;

	/**
	 * This will make the next line appear with more indentation,
	 * as if a subset of the prior item
	 *
	 * @return OutputtingProcess for chaining API
	 */
	public function indent() {
		$this->indent++;
		return $this;
	}

	/**
	 * This will make the next line appear with less indentation,
	 * indicating the prior set of tasks for the prior subsets
	 * were completed.
	 *
	 * @return OutputtingProcess for chaining API
	 */
	public function outdent() {
		$this->indent--;
		return $this;
	}

	public function getIndent() {
		return $this->indent;
	}

	public function setWidth($v) {
		$this->width = $v;
	}

	public function wrapString(PreTTYString $text) {
	 return $text->getString()
		? $this->getIndentText() . $text->render($this->getMaxContentLength()) .
		  $this->getLineFill($text) . PHP_EOL
		: "||" . PHP_EOL;
	}

	private function getIndentLength() {
		return $this->width - 6 - 3 * $this->indent;
	}

	private function getMaxContentLength() {
		return $this->getIndentLength() - 4;
	}

	private function getIndentText() {
		$return = '';

		$first = $this->firstline || $this->indent != $this->priorindent;

		if($first && !$this->firstline) $return .= $this->getEmptyLine();
		$repeat = $first ? '===' : '	 ';

		$return .= '||' . str_repeat($repeat, $this->indent);
		$return .= $first ? '> [ ' : '  [ ';

		$this->priorindent = $this->indent;
		if($this->firstline) $this->firstline = false;

		return $return;
	}

	private function getEmptyLine() {
		return '||' . str_repeat(' ', $this->width - 3) . ']' . PHP_EOL;
	}

	private function getLineFill(PreTTYString $text) {
		$len = $this->getIndentLength() - min($text->getLength(), $this->getMaxContentLength()) - 1;
		return $this->trailingDots ? str_repeat('.', $len) . ']' : ' ]';
	}

	public function setEncoder(PreTTYColorEncoder $encoder) {
		return;
	}

  public function setTrailingDots($setting = true) {
	  $this->trailingDots = $setting;
  }

	public function runHook($hook, array $data = array()) {
		if($hook === iPreTTYComponent::HOOK_INDENT) $this->indent();
		if($hook === iPreTTYComponent::HOOK_OUTDENT) $this->outdent();
		if($hook === iPreTTYComponent::HOOK_SAY) return $this->wrapString($data['string']);
	}
}

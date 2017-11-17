<?php

abstract class Templatable {
	/**
	 * @var Template 
	 */
	protected $template;
	protected $template_name;
	protected $template_replacements;
	
	abstract protected function getTemplateDir();
	
	public function setTemplate(Template $template) {
		$this->template = $template;
	}
	
	protected function loadTemplate($file_name) {
		return Template::loadTemplate($this->getTemplateDir() . '/' . $file_name);
	}
	
	public function setTemplateName($name) {
		$this->template_name = $name;
	}
	
	public function loadAndSetTemplate($file_name) {
		$this->setTemplate($this->loadTemplate($file_name));
	}
	
	public function addTemplateReplacements(array $replacements) {
		foreach ($replacements as $key => $value) {
			$this->addTemplateReplacement($key, $value);
		}
	}
	
	public function addTemplateReplacement($key, $value) {
		$this->template_replacements[$key] = $value;
	}
	
	public function replace() {
		$this->template->replaceVars($this->template_replacements, false);
	}
	
	protected function prepareTemplate() {
		if (is_null($this->template)) {
			$this->template = $this->loadTemplate($this->template_name ? $this->template_name : 'default.html');
		}
	}
	
}

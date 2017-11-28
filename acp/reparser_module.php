<?php

/**
* @package   s9e\reparser
* @copyright Copyright (c) 2017 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\reparser\acp;

class reparser_module
{
	public function main($id, $mode)
	{
		global $container;

		$this->tpl_name   = 'acp_s9e_reparser_' . $mode;
		$this->page_title = $container->get('language')->lang('ACP_REPARSER_' . strtoupper($mode));
	}
}
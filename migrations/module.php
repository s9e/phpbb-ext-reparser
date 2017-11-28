<?php

/**
* @package   s9e\reparser
* @copyright Copyright (c) 2017 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\reparser\migrations;

class module extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return [
			['module.add', ['acp', 'ACP_CAT_MAINTENANCE', 'ACP_REPARSER']],
			['module.add', ['acp', 'ACP_REPARSER', [
				'auth'            => 'ext_s9e/reparser',
				'module_basename' => '\\s9e\\reparser\\acp\\reparser_module',
				'modes'           => ['reparse']
			]]]
		];
	}
}
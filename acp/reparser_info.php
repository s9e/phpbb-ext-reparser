<?php

/**
* @package   s9e\reparser
* @copyright Copyright (c) 2017 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\reparser\acp;

class reparser_info
{
	public function module()
	{
		return [
			'filename' => '\\s9e\\reparser\\acp\\reparser_module',
			'title'    => 'ACP_REPARSER',
			'modes'    => [
				'reparse' => [
					'title' => 'ACP_REPARSE_POSTS',
					'auth'  => 'ext_s9e/reparser',
					'cat'   => ['ACP_CAT_MAINTENANCE']
				]
			]
		];
	}
}
<?php

/**
* @package   s9e\reparser
* @copyright Copyright (c) 2017 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\reparser;

use phpbb\auth\auth;
use phpbb\request\request_interface;
use phpbb\textreparser\plugins\post_text as reparser;
use phpbb\user;

class controller
{
	/**
	* @var bool
	*/
	protected $isAllowed;

	/**
	* @var reparser
	*/
	protected $reparser;

	/**
	* @var request_interface
	*/
	protected $request;

	/**
	* @var string
	*/
	protected $url;

	public function __construct(auth $auth, $path, request_interface $request, reparser $reparser, user $user)
	{
		$this->isAllowed = ($auth->acl_get('a_') && $request->variable('sid', '') === $user->session_id);
		$this->reparser  = $reparser;
		$this->request   = $request;
		$this->url       = $path . 'viewtopic.php';
	}

	public function reparsePost()
	{
		$postId = $this->request->variable('p', 0);
		if ($this->isAllowed)
		{
			$this->reparser->reparse_range($postId, $postId);
		}
		else
		{
			die('Unauthorized');
		}

		redirect(append_sid($this->url, 'p=' . $postId . '#p' . $postId));
	}
}
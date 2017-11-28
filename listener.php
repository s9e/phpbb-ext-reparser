<?php

/**
* @package   s9e\reparser
* @copyright Copyright (c) 2017 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\reparser;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\auth\auth;
use phpbb\controller\helper;
use phpbb\user;

class listener implements EventSubscriberInterface
{
	/**
	* @var bool
	*/
	protected $isAdmin;

	/**
	* @var helper
	*/
	protected $helper;

	/**
	* @var string
	*/
	protected $sessionId;

	public function __construct(auth $auth, helper $helper, user $user)
	{
		$this->isAdmin   = $auth->acl_get('a_');
		$this->helper    = $helper;
		$this->sessionId = $user->session_id;
	}
	
	public static function getSubscribedEvents()
	{
		return [
			'core.user_setup'                => 'onUserSetup',
			'core.viewtopic_modify_post_row' => 'onViewtopic'
		];
	}

	public function onViewtopic($event)
	{
		if (!$this->isAdmin)
		{
			return;
		}

		$vars = $event['post_row'];
		$vars['U_REPARSE'] = $this->helper->route(
			's9e.reparser.reparse.post',
			[
				'p'   => $event['row']['post_id'],
				'sid' => $this->sessionId
			],
			true,
			false
		);
		$event['post_row'] = $vars;
	}

	public function onUserSetup($event)
	{
		$set = $event['lang_set_ext'];
		$set[] = array(
			'ext_name' => 's9e/reparser',
			'lang_set' => 'reparser',
		);
		$event['lang_set_ext'] = $set;
	}
}
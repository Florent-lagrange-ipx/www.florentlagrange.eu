<?php
class FrontainerUserSignup
{
	protected $manager;
	protected $space;
	protected $cuser;
	protected $category;

	public function __construct(& $manager, $space)
	{
		$this->manager = $manager;
		$this->space = $space;
		$this->cuser = false;
		// get Users category
		$catClass = $this->manager->getCategoryClass();
		$this->category = $catClass->getCategory('name=Users');

		// Users category was not found
		if(!$this->category)
		{
			MsgReporter::setClause('err_users_cat_notfound', array(), true, $this->space);
			return false;
		}
	}


	public function currentUser() {return $this->cuser;}


	public function logout($redirect)
	{
		session_destroy();
		$_SESSION = array();
		if (!headers_sent())
		{
			// set a flash and redirect to the login page
			header('Status: 200');
			header('Location: ' . htmlspecialchars($redirect));
			exit();
		} else
		{
			// throw an error message
			exit();
		}
	}


	public function login($data)
	{
		// check if data has send
		if(empty($data['password']) || empty($data['email']))
		{
			MsgReporter::setClause('err_login_empty_value', array(), true, $this->space);
			return false;
		}

		// validate email
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
		{
			MsgReporter::setClause('err_login_email_invalid', array(), true, $this->space);
			return false;
		}

		// initialize items of category Users
		$itemClass = $this->manager->getItemClass();
		$itemClass->init($this->category->get('id'));

		// check user data exists
		$this->cuser = $itemClass->getItem('email='.$data['email']);

		// user email not found
		if(!$this->cuser)
		{
			MsgReporter::setClause('err_user_data', array(), true, $this->space);
			return false;
		}

		// Ok, let's check the password. First, prepare input password and salt
		$password = $this->cuser->fields->password->value;
		$inputpassword = sha1($data['password'].$this->cuser->fields->password->salt);

		// correct entered user data
		if($password == $inputpassword)
		{
			// check whether user's field "activated" is true
			if(!isset($this->cuser->active) || $this->cuser->active != 1)
			{
				MsgReporter::setClause('err_user_disabled', array(), true, $this->space);
				return false;
			}

			// remove recovery value
			$this->cuser->fields->recovery->value = '';
			$this->cuser->save();
			if(!isset($_SESSION['loggedin']) || is_null($_SESSION['loggedin'])) $_SESSION['loggedin'] = true;
			$_SESSION['userid'] = $this->cuser->get('id');
			return true;
		}

		MsgReporter::setClause('err_user_data', array(), true, $this->space);
		return false;
	}



	public function signup($data)
	{
		// check check whether all data is send
		if(empty($data['password']) || empty($data['email']) || empty($data['name']))
		{
			MsgReporter::setClause('err_login_empty_value', array(), true, $this->space);
			return false;
		}

		// validate email
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
		{
			MsgReporter::setClause('err_login_email_invalid', array(), true, $this->space);
			return false;
		}

		// initialize items of category Users
		$itemClass = $this->manager->getItemClass();
		if(!$this->category)
		{
			return false;
		}
		$itemClass->init($this->category->get('id'));

		// check user data exists
		$user = $itemClass->getItem('email='.$data['email']);

		// check whether this email address used by other user
		if($user)
		{
			MsgReporter::setClause('err_user_data_exists', array(), true, $this->space);
			return false;
		}

		if(!$itemClass->maxItemsExceeded($this->category->get('id')))
		{
			MsgReporter::setClause('err_maximum_users', array(), true, $this->space);
			return false;
		}

		$name = substr(htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8', false), 0, 80);

		// Ok, everything is fine, create new inactive user account
		$this->cuser = $this->manager->newItem($this->category->get('id'));

		// generate new salt
		$passField = new InputPassword($this->cuser->fields->password);
		$this->cuser->fields->password->salt = $passField->randomString();

		// check the password length
		$max = !empty($this->cuser->fields->password->maximum) ? $this->cuser->fields->password->maximum : false;
		$min = !empty($this->cuser->fields->password->minimum) ? $this->cuser->fields->password->minimum : false;
		if($max && strlen($data['password']) > $max)
		{
			MsgReporter::setClause('err_input_max_length', array('fieldname' => $this->cuser->fields->password->label,
					'count' => $this->cuser->fields->password->maximum), true, $this->space
			);
			return false;
		}
		if($min && strlen($data['password']) < $min)
		{
			MsgReporter::setClause('err_input_min_length', array('fieldname' => $this->cuser->fields->password->label,
					'count' => $this->cuser->fields->password->minimum), true, $this->space
			);
			return false;
		}

		// save salt in recovery field for limiting activation by user
		$this->cuser->fields->recovery->value = $this->cuser->fields->password->salt;

		// Ok, let's prepare submited password with salt
		$this->cuser->fields->password->value = sha1($data['password'].$this->cuser->fields->password->salt);

		// save user name
		$this->cuser->name = $name;

		// save email
		$this->cuser->fields->email->value = substr(htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8', false), 0, 50);

		// save user
		if($this->cuser->save())
		{
			// generate slug from user id
			//$this->cuser->fields->slug->value = (string) $this->cuser->get('id');
			$this->cuser->save();

			// prepare message data and sent an email
			$tplmsg = $this->manager->newTemplate();
			$tplmsg->content = MsgReporter::getClause('activation_email', array(), $this->space);
			$tplEngine = $this->manager->getTemplateEngine();

			$url = get_section_url(ACTIVATE_SLUG);

			$url = strpos($url, '?') ? $url.'&key='
				.rawurlencode($this->cuser->fields->password->salt).'&user='.rawurlencode($this->cuser->name) :
				$url.'?key='.rawurlencode($this->cuser->fields->password->salt).'&user='.rawurlencode($this->cuser->name);

			$msg = $tplEngine->render($tplmsg, array(
					'name' => htmlspecialchars($this->cuser->name, ENT_QUOTES, 'UTF-8', false),
					'sitename' => !empty($this->manager->config->frontainer->sitename) ?
							htmlspecialchars($this->manager->config->frontainer->sitename) : 'My Website',
					'link_address' => $url,
					'link_text' => $url
				)
			);

			$subject = MsgReporter::getClause('activation_email_subject', array(), $this->space);
			$recipient = htmlspecialchars($this->cuser->fields->email->value);
			$from = !empty($this->manager->config->frontainer->email_from) ?
				htmlspecialchars($this->manager->config->frontainer->email_from) : 'Mypage@email.com';
			$reply = !empty($this->manager->config->frontainer->email_to) ?
				htmlspecialchars($this->manager->config->frontainer->email_to) : 'Mypage@email.com';

			if(!dropEmail($recipient, $subject, $msg, $from, $reply))
			{
				MsgReporter::setClause('err_cannot_sent', array(), true, $this->space);
				return false;
			}

			return true;
		}

		MsgReporter::setClause('err_saving_user', array(), true, $this->space);
		return false;
	}



	public function activate($data)
	{
		// check if data has send
		if(empty($data['key']) || empty($data['user']))
		{
			// do not show message for security reasons
			//MsgReporter::setClause('err_data_incomplete', array(), true, $this->space);
			return false;
		}

		// initialize items of category Users
		$itemClass = $this->manager->getItemClass();
		$itemClass->init($this->category->get('id'));

		// check user data exists
		$this->cuser = $itemClass->getItem('name='.rawurldecode($data['user']));

		// check whether this user name unknown
		if(!$this->cuser)
		{
			// do not show message for security reasons
			MsgReporter::setClause('err_user_data', array(), true, $this->space);
			return false;
		}

		$activationkey = !empty($this->cuser->fields->recovery->value) ? $this->cuser->fields->recovery->value : false;


		if(!$activationkey || empty($activationkey))
		{
			return false;
		}

		// check activation key valide
		if($activationkey != rawurldecode($data['key']))
		{
			// do not show message for security reasons
			//MsgReporter::setClause('err_user_data', array(), true, $this->space);
			return false;
		}

		// check if the user is already activated
		if(isset($this->cuser->active) && $this->cuser->active == 1)
		{
			MsgReporter::setClause('err_account_activated', array(), true, $this->space);
			return false;
		}

		// Ok, let's activate user
		// reset recovery value
		$this->cuser->fields->recovery->value = '';
		$this->cuser->active = 1;
		// save user
		if($this->cuser->save())
		{
			return true;
		}

		MsgReporter::setClause('err_activating_user', array(), true, $this->space);
		return false;
	}



	public function recovery($data)
	{
		// check if data has send
		if(empty($data['email']))
		{
			MsgReporter::setClause('err_recovery_value', array(), true, $this->space);
			return false;
		}

		// validate email
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
		{
			MsgReporter::setClause('err_login_email_invalid', array(), true, $this->space);
			return false;
		}

		// initialize items of category Users
		$itemClass = $this->manager->getItemClass();
		$itemClass->init($this->category->get('id'));

		// check user data exists
		$this->cuser = $itemClass->getItem('email='.$data['email']);

		// check whether this email exists
		if(!$this->cuser)
		{
			MsgReporter::setClause('err_email_recovery', array(), true, $this->space);
			return false;
		}

		// Ok, everything is fine, generate new reset code
		$passField = new InputPassword($this->cuser->fields->password);
		$resetcode = $passField->randomString();
		// save resetcode + time stamp in reqovery field
		$key = sha1($resetcode);
		$this->cuser->fields->recovery->value = $key.' '.time();

		// save user
		if($this->cuser->save())
		{
			// send a reset auth message to the user
			$tplmsg = $this->manager->newTemplate();
			$tplmsg->content = MsgReporter::getClause('reset_password_email', array(), $this->space);
			$tplEngine = $this->manager->getTemplateEngine();

			$url = get_section_url(RECOVERY_SLUG);

			$url = strpos($url, '?') ? $url.'&key='.rawurlencode($key).'&user='.rawurlencode($this->cuser->name) :
				$url.'?key='.rawurlencode($key).'&user='.rawurlencode($this->cuser->name);

			$msg = $tplEngine->render($tplmsg, array(
					'name' => htmlspecialchars($this->cuser->name, ENT_QUOTES, 'UTF-8', false),
					'email' => htmlspecialchars($this->cuser->fields->email->value, ENT_QUOTES, 'UTF-8', false),
					'sitename' => !empty($this->manager->config->frontainer->sitename) ?
							htmlspecialchars($this->manager->config->frontainer->sitename) : 'My Web Site',
					'link_address' => $url,
					'link_text' => $url
				)
			);

			$subject = MsgReporter::getClause('activation_email_subject', array(), $this->space);
			$recipient = htmlspecialchars($this->cuser->fields->email->value);
			$from = !empty($this->manager->config->frontainer->email_from) ?
				htmlspecialchars($this->manager->config->frontainer->email_from) : 'Mypage@email.com';
			$reply = !empty($this->manager->config->frontainer->email_to) ?
				htmlspecialchars($this->manager->config->frontainer->email_to) : 'Mypage@email.com';

			if(!dropEmail($recipient, $subject, $msg, $from, $reply))
			{
				MsgReporter::getClause('err_cannot_sent', array(), true, $this->space);
				return false;
			}

			return true;
		}

		MsgReporter::setClause('err_saving_user', array(), true, $this->space);
		return false;
	}



	public function validateRecovery($data)
	{
		// check user data
		if(empty($data['key']) || empty($data['user']))
		{
			MsgReporter::setClause('err_recovery_data', array(), true, $this->space);
			return false;
		}

		// initialize items of category Users
		$itemClass = $this->manager->getItemClass();
		$itemClass->init($this->category->get('id'));

		// check user data correct
		$this->cuser = $itemClass->getItem('name='.rawurldecode($data['user']));

		// check whether the user exists
		if(!$this->cuser)
		{
			MsgReporter::setClause('err_email_recovery', array(), true, $this->space);
			return false;
		}

		// the user was found. check recovery code
		if(empty($this->cuser->fields->recovery->value))
		{
			MsgReporter::setClause('err_recovery_notrequested', array(), true, $this->space);
			return false;
		}

		$parts = explode(' ', $this->cuser->fields->recovery->value);
		// check the recovery key
		if(!isset($parts[0]) || $parts[0] != rawurldecode($data['key']))
		{
			MsgReporter::setClause('err_recovery_key_notmatch', array(), true, $this->space);
			return false;
		}
		// check recovery time 24 h maximum
		$yesterday = time() - (60 * 60 * 24 * 1);
		if(isset($parts[1]) && $parts[1] > $yesterday)
		{
			return true;
		}
		// remove recovery field value
		$this->cuser->fields->recovery->value = '';
		$this->cuser->save();
		MsgReporter::setClause('err_time_expired', array(), true, $this->space);
		return false;
	}



	public function reset($data)
	{
		// check user data
		if(empty($data['key']) || empty($data['user']) || empty($data['password']) || empty($data['confirm_password']))
		{
			MsgReporter::setClause('err_recovery_data', array(), true, $this->space);
			return false;
		}

		// initialize items of category Users
		$itemClass = $this->manager->getItemClass();
		$itemClass->init($this->category->get('id'));

		// check user data correct
		$this->cuser = $itemClass->getItem('name='.rawurldecode($data['user']));

		// check whether the user exists
		if(!$this->cuser)
		{
			MsgReporter::setClause('err_email_recovery', array(), true, $this->space);
			return false;
		}

		// the user was found. check recovery code
		if(empty($this->cuser->fields->recovery->value))
		{
			MsgReporter::setClause('err_recovery_notrequested', array(), true, $this->space);
			return false;
		}

		$parts = explode(' ', $this->cuser->fields->recovery->value);
		// check the recovery key
		if(!isset($parts[0]) || $parts[0] != rawurldecode($data['key']))
		{
			MsgReporter::setClause('err_recovery_key_notmatch', array(), true, $this->space);
			return false;
		}
		// check recovery time 24 h maximum
		$yesterday = time() - (60 * 60 * 24 * 1);
		if(isset($parts[1]) && $parts[1] > $yesterday)
		{
			// compare passwords
			if($data['password'] != $data['confirm_password'])
			{
				MsgReporter::setClause('reset_pass_notmatch', array(), true, $this->space);
				return false;
			}

			// check the password length
			$max = !empty($this->cuser->fields->password->maximum) ? $this->cuser->fields->password->maximum : false;
			$min = !empty($this->cuser->fields->password->minimum) ? $this->cuser->fields->password->minimum : false;
			if($max && strlen($data['password']) > $max)
			{
				MsgReporter::setClause('err_input_max_length', array('fieldname' => $this->cuser->fields->password->label,
						'count' => $this->cuser->fields->password->maximum), true, $this->space
				);
				return false;
			}
			if($min && strlen($data['password']) < $min)
			{
				MsgReporter::setClause('err_input_min_length', array('fieldname' => $this->cuser->fields->password->label,
						'count' => $this->cuser->fields->password->minimum), true, $this->space
				);
				return false;
			}

			// empty recovery field value
			$this->cuser->fields->recovery->value = '';
			// change user password
			$this->cuser->fields->password->value = sha1($data['password'].$this->cuser->fields->password->salt);
			$this->cuser->save();
			return true;

		}
		$this->cuser->fields->recovery->value = '';
		$this->cuser->save();
		MsgReporter::setClause('err_time_expired', array(), true, $this->space);
		return false;
	}



	protected function validateFieldValue($fieldname, $value)
	{
		if(!$this->cuser || !$this->cuser->setFieldValue($fieldname, $value))
		{
			// parse error codes
			switch (MsgReporter::errorCode())
			{
				case 1:
					MsgReporter::setClause('err_required_field', array(), true, $this->space);
					return false;
				case 2:
					MsgReporter::setClause('err_input_min_length', array('fieldname' => $this->cuser->fields->$fieldname->label,
							'count' => $this->cuser->fields->$fieldname->minimum), true, $this->space
					);
					return false;
				case 3:
					MsgReporter::setClause('err_input_max_length', array('fieldname' => $this->cuser->fields->$fieldname->label,
							'count' => $this->cuser->fields->$fieldname->maximum), true, $this->space
					);
					return false;
				case 5:
					MsgReporter::setClause('err_input_incomplete',
						array('fieldname' => $this->cuser->fields->$fieldname->label), true, $this->space);
					return false;
				case 7:
					MsgReporter::setClause('err_input_comparison',
						array('fieldname' => $this->cuser->fields->$fieldname->label), true, $this->space);
					return false;
				case 8:
					MsgReporter::setClause('err_input_format',
						array('fieldname' => $this->cuser->fields->$fieldname->label), true, $this->space);
					return false;
			}
			return false;
		}
		return true;
	}



}
<?php

class VKontakteAdvancedOAuthService extends VKontakteOAuthService {	
	
	protected $scope = 'friends';
	
	protected function fetchAttributes() {
		$info = (array)$this->makeSignedRequest('https://api.vkontakte.ru/method/getProfiles', array(
			'query' => array(
				'uids' => $this->uid,
				'fields' => 'screen_name, timezone, photo', // uid, first_name and last_name is always available
			),
		));
		
		$info = $info['response'][0];

		$this->attributes['id'] = $info->uid;
		$this->attributes['name'] = $info->first_name.' '.$info->last_name;
		$this->attributes['timezone'] = timezone_name_from_abbr('', $info->timezone*3600, date('I'));
		$this->attributes['photo'] = $info->photo;
		$this->attributes['url'] = 'http://vkontakte.ru/id'.$info->uid;
		
		if (!empty($info->screen_name))
			$this->attributes['username'] = $info->screen_name;
		else
			$this->attributes['username'] = 'id'.$info->uid;
	}
}

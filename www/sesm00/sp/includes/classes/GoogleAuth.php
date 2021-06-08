<?php

class GoogleAuth {

	private static $instance;

	private $client;

	private function __construct() {
		$this->client = new Google\Client();
		$this->client->setAuthConfig('client_secret_492583998446-b20gc6tfg5tulrcfrg8ftlt56rvpad6i.apps.googleusercontent.com.json');
		$uri = getProtocol() . $_SERVER['HTTP_HOST'] . getCurrentUrl(false);
		$this->client->setRedirectUri($uri);
		$test = "testovaci-hodnota";
		$this->client->setState($test);
		$this->client->addScope([Google_Service_Oauth2::OPENID, Google_Service_Oauth2::USERINFO_EMAIL, Google_Service_Oauth2::USERINFO_PROFILE]);
        $this->client->setPrompt('select_account consent');
        if (!APP_SSL_VERIFY_PEER) {
            $this->client->setHttpClient(new GuzzleHttp\Client(["curl" => [
                CURLOPT_SSL_VERIFYPEER => false
            ]]));
        }
	}

	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new GoogleAuth();
		}
		return self::$instance;
	}

	public function authenticate($code) {
        $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function getAccessToken() {
	    return $this->client->getAccessToken();
    }

    public function setAccessToken($token) {
	    $this->client->setAccessToken($token);
	    if ($this->client->isAccessTokenExpired()) {
	        return false;
        }
	    return true;
    }

	public function redirectToGoogle() {
		header('Location: ' . filter_var($this->client->createAuthUrl(), FILTER_SANITIZE_URL));
		die();
	}

	public function getUserInfo() {
	    $oauthService = new Google_Service_Oauth2($this->client);
        $userInfo = $oauthService->userinfo->get();
        $fields = [];
        $fields['id'] = $userInfo->getId();
        $fields['email'] = $userInfo->getEmail();
        $fields['verified'] = $userInfo->getVerifiedEmail();
        $fields['firstname'] = $userInfo->getGivenName();
        $fields['lastname'] = $userInfo->getFamilyName();
        return $fields;
    }

}
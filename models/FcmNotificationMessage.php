<?php


namespace Models;


class FcmNotificationMessage
{

	public string $notificationToken;
	public array $notificationTokens;
	public string $title;
	public string $body;

	public array $payload;

	/**
	 * FcmNotificationMessage constructor.
	 * @param string $notificationToken
	 * @param string $titlex
	 * @param string $body
	 * @param array  $payload
	 */
	public function __construct( string|array $notificationToken, string $title, string $body, array $payload )
	{
		if(is_array($notificationToken))
			$this->notificationTokens = $notificationToken;
		else
			$this->notificationToken = $notificationToken;
		$this->title = $title;
		$this->body = $body;
		$this->payload = $payload;
	}
}
<?php


namespace IGHUB\Controllers;


final class InstaFeedHubController
{
    const SCOPES = 'user_profile,user_media';
    const FBAPI  = 'https://api.instagram.com/oauth/authorize/';
    public static $configInsta = [
            'clientId'     => 140642897910557,
            'clientSecret' => '8bdb356cf99792a6b82620d6df541f8c',
            'redirectUri'  => 'https://dfecea3b4c16.ngrok.io/wiloke/'
        ];
    private static $aDataUser;

    /**
     * @return string
     */
    public static function getURLAuthorization(): string
    {

        return add_query_arg(
            [
                [
                    'client_id'     => self::$configInsta['clientId'],
                    'redirect_uri'  => self::$configInsta['redirectUri'],
                    'scope'         => self::SCOPES,
                    'response_type' => 'code'
                ]
            ],
            self::FBAPI
        );
    }

    /**
     * @param string $fbResponseCode
     * @return array|mixed|string
     */
    public static function getAccessToken(string $fbResponseCode)
    {
        return self::_getAccessToken($fbResponseCode);
    }


    /**
     * @param string $fbResponseCode
     * @return mixed|string
     */
    private static function _getAccessToken(string $fbResponseCode)
    {
        $aResponse = wp_remote_post('https://api.instagram.com/oauth/access_token', [
            'method'      => 'POST',
            'timeout'     => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'body'        => [
                'client_id'     => client_id,
                'client_secret' => client_secret,
                'grant_type'    => 'authorization_code',
                'redirect_uri'  => redirect_uri,
                'code'          => $fbResponseCode
            ]
        ]);
        $bodyCode = wp_remote_retrieve_response_code($aResponse);
        if (empty($aResponse) || is_wp_error($aResponse) || $bodyCode !== 200) {
            return [
                'code' => $bodyCode,
                'msg'  => wp_remote_retrieve_response_message($aResponse)
            ];
        }

        self::$aDataUser = json_decode(wp_remote_retrieve_body($aResponse), true);
        return self::$aDataUser['access_token'];
    }

    /**
     * @param string $accessToken
     * @return array|string
     */
    public static function getRefreshToken(string $accessToken)
    {
        $aResponse = wp_remote_get(
            add_query_arg(
                [
                    [
                        'client_secret' => self::$configInsta['clientSecret'],
                        'grant_type'    => 'ig_exchange_token',
                        'access_token'  => $accessToken,
                    ]
                ],
                'https://graph.instagram.com/access_token'
            )
        );
        $bodyCode = wp_remote_retrieve_response_code($aResponse);
        if (empty($aResponse) || is_wp_error($aResponse) || $bodyCode !== 200) {
            return [
                'code' => $bodyCode,
                'msg'  => wp_remote_retrieve_response_message($aResponse)
            ];
        }
        self::$aDataUser = json_decode(wp_remote_retrieve_body($aResponse), true);
        return self::$aDataUser['access_token'];
    }
}
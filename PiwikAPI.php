<?php

namespace virtualwonders\piwikvw;


use Yii;
use yii\base\Component;
use yii\base\Exception;

/**
 * Piwik API
 * Lets the system talk to Piwik Analytics
 */
class PiwikAPI extends Component
{
    // Referrers Method
    const REFERRERS = 'Referrers';

    const GET_REFERRER_TYPE  = '.getReferrerType';
    const GET_ALL_REFERRER   = '.getAll';
    const GET_SEARCH_ENGINES = '.getSearchEngines';
    const GET_WEBSITES       = '.getWebsites';
    const GET_CAMPAIGNS      = '.getCampaigns';
    const GET_NUMBER_OF_DISTINCT_KEYWORDS = '.getNumberOfDistinctKeywords';
    const GET_NUMBER_OF_DISTINCT_WEBSITES = '.getNumberOfDistinctWebsites';
    const GET_NUMBER_OF_DISTINCT_CAMPAIGNS = '.getNumberOfDistinctCampaigns';
    const GET_NUMBER_OF_DISTINCT_SEARCH_ENGINES = '.getNumberOfDistinctSearchEngines';

    // Site Manager Method
    const SITES_MANAGER = 'SitesManager';

    const ADD_SITE         = '.addSite';
    const UPDATE_SITE      = '.updateSite';
    const DELETE_SITE      = '.deleteSite';
    const GET_ALL_SITES    = '.getAllSites';
    const GET_ALL_SITES_ID = '.getAllSitesId';
    const GET_SITE_FROM_ID = '.getSiteFromId';
    const GET_SITES_ID_FROM_SITE_URL = '.getSitesIdFromSiteUrl';
    const GET_SITES_WITH_VIEW_ACCESS = '.getSitesWithViewAccess';
    const GET_SITES_ID_WITH_VIEW_ACCESS = '.getSitesIdWithViewAccess';
    const GET_SITES_ID_WITH_ATLEAST_VIEW_ACCESS = '.getSitesIdWithAtLeastViewAccess';

    // User Manager Method
    const USERS_MANAGER = 'UsersManager';

    const ADD_USER          = '.addUser';
    const UPDATE_USER       = '.updateUser';
    const DELETE_USER       = '.deleteUser';
    const USER_EXISTS       = '.userExists';
    const USER_EMAIL_EXISTS = '.userEmailExists';
    const GET_USER          = '.getUser';
    const GET_USERS         = '.getUsers';
    const GET_TOKEN_AUTH    = '.getTokenAuth';
    const SET_USER_ACCESS   = '.setUserAccess';
    const GET_USERS_LOGIN   = '.getUsersLogin';
    const GET_USER_BY_EMAIL = '.getUserByEmail';
    const GET_USERS_WITH_SITE_ACCESS  = '.getUsersWithSiteAccess';
    const GET_SITES_ACCESS_FROM_USER  = '.getSitesAccessFromUser';
    const GET_USERS_ACCESS_FROM_SITE  = '.getUsersAccessFromSite';
    const GET_USERS_SITES_FROM_ACCESS = '.getUsersSitesFromAccess';

    // Visits Summary Method
    const VISITS_SUMMARY = 'VisitsSummary';

    const GET = '.get';
    const GET_VISITS = '.getVisits';
    const GET_UNIQUE_VISITORS = '.getUniqueVisitors';

    /**
     * Piwik API endpoint
     * @var string
     */
    private $piwik_endpoint;

    /**
     * THis variable will hold the authenticated token upon connection
     * @var string
     */
    private $token_auth;

    /**
     * This variable will hold the config needed in contructing this Class
     * @var string|null
     */
    public $user_token = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        // Use admin token when `token_auth` property is null
        $this->token_auth = is_null($this->user_token) ? Yii::$app->params['piwikApiKey'] : $this->user_token;
        $this->piwik_endpoint = Yii::$app->params['piwikUrl'];

        // Initialize parent construct
        parent::init();
    }

    /**
     * Use this setter to modify the current value of `user_token` property which current value is the admin token by default
     * @param $token
     */
    public function setUserToken($token)
    {
        $this->user_token = $token;
        // Reinitialize the component to forcibly apply the custom set token
        $this->init();
    }

    /**
     * Connects to Piwik API and returns a JSON string
     * @param $method
     * @param array $params
     * @param string $format
     * @return mixed
     * @throws Exception
     */
    protected function request($method, $params = [], $format = 'JSON')
    {
        // Default parameters for the API call
        $default_params = [
            'token_auth' => $this->token_auth,
            'module' => 'API',
            'method' => $method,
            'format' => $format
        ];

        // Merge default parameters to the custom parameters passed to $params variable
        $_params = array_merge($default_params, $params);

        // Initialize Curl Connection
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->piwik_endpoint . '/?' . http_build_query($_params));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        if ($result === false)
        {
            throw new Exception('Curl error: ' . curl_error($ch));
        }
        else
        {
            return $result;
        }
    }

    /**
     * @NOTE Call this functions only when you manually define the value of the `user_token` property
     * `user_token` by default will use the value from the Yii::$app->params['piwikUrl'] which contains
     *  the administrator token. In case you intend to set the token for an specific user see example
     * php--
     * -- Initialize PiwikAPI
     * $piwik = Yii::$app->piwik;
     * -- Get the client piwik token using this function
     * $token = Yii::$app->settings->getUserPiwikToken(USER ID OF A CLIENT);
     * -- Set the new token for the PiwikAPI Class Object
     * $piwik->setUserToken($token);
     *
     * After this process you can now call the following methods to initialize sub classes of the PiwikAPI class
     *
     * $piwik->referrer()->functionName() @see \virtualwonders\piwikvw\PiwikReferrers
     * $piwik->siteManager()->functionName()  @see \virtualwonders\piwikvw\PiwikSitesManager
     * $piwik->userManager()->functionName()  @see \virtualwonders\piwikvw\PiwikUsersManager
     * $piwik->visitSummary()->functionName()  @see \virtualwonders\piwikvw\PiwikVisitsSummary
     */

    /**
     * @return PiwikReferrers
     */
    public function referrer()
    {
        return new PiwikReferrers([
            'user_token' => $this->user_token
        ]);
    }

    /**
     * @return PiwikSitesManager
     */
    public function siteManager()
    {
        return new PiwikSitesManager([
            'user_token' => $this->user_token
        ]);
    }

    /**
     * @return PiwikUsersManager
     */
    public function userManager()
    {
        return new PiwikUsersManager([
            'user_token' => $this->user_token
        ]);
    }

    /**
     * @return PiwikVisitsSummary
     */
    public function visitSummary()
    {
        return new PiwikVisitsSummary([
            'user_token' => $this->user_token
        ]);
    }
}

<?php

namespace virtualwonders\piwikvw;


class PiwikSitesManager extends PiwikAPI
{
    /**
     * @return mixed
     */
    public function getAllSites()
    {
        return $this->request(parent::SITES_MANAGER . parent::GET_ALL_SITES);
    }

    /**
     * @return mixed
     */
    public function getAllSitesId()
    {
        return $this->request(parent::SITES_MANAGER . parent::GET_ALL_SITES_ID);
    }

    /**
     * @return mixed
     */
    public function getSitesWithViewAccess()
    {
        return $this->request(parent::SITES_MANAGER . parent::GET_SITES_WITH_VIEW_ACCESS);
    }

    /**
     * @return mixed
     */
    public function getSitesIdWithViewAccess()
    {
        return $this->request(parent::SITES_MANAGER . parent::GET_SITES_ID_WITH_VIEW_ACCESS);
    }

    /**
     * @return mixed
     */
    public function getSitesIdWithAtLeastViewAccess()
    {
        return $this->request(parent::SITES_MANAGER . parent::GET_SITES_ID_WITH_ATLEAST_VIEW_ACCESS);
    }

    /**
     * @param $siteId
     * @return mixed
     */
    public function getSiteFromId($siteId)
    {
        $params = [
            'idSite' => $siteId,
        ];

        return $this->request(parent::SITES_MANAGER . parent::GET_SITE_FROM_ID, $params);
    }

    /**
     * @param $url
     * @return mixed
     */
    public function getSitesIdFromSiteUrl($url)
    {
        $params = [
            'url' => $url,
        ];

        return $this->request(parent::SITES_MANAGER . parent::GET_SITES_ID_FROM_SITE_URL , $params);
    }

    /**
     * @param $siteName
     * @param $urls
     * @param array $options
     * @return mixed
     */
    public function addSite($siteName, $urls, $options = [])
    {
        $params = [
            'siteName' => $siteName,
            'urls'	   => $urls,
        ];

        $params = array_merge($params, $options);

        return $this->request(parent::SITES_MANAGER . parent::ADD_SITE, $params);
    }

    /**
     * @param $siteId
     * @param $siteName
     * @param $urls
     * @param array $options
     * @return mixed
     */
    public function updateSite($siteId, $siteName, $urls, $options = [])
    {
        $params = [
            'idSite'   => $siteId,
            'siteName' => $siteName,
            'urls'	   => $urls,
        ];

        $params = array_merge($params, $options);

        return $this->request(parent::SITES_MANAGER . parent::UPDATE_SITE, $params);
    }

    /**
     * @param $siteId
     * @return mixed
     */
    public function deleteSite($siteId)
    {
        $params = [
            'idSite' => $siteId,
        ];

        return $this->request(parent::SITES_MANAGER . parent::DELETE_SITE, $params);
    }
}
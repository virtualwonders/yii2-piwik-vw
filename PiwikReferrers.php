<?php

namespace virtualwonders\piwikvw;


class PiwikReferrers extends PiwikAPI 
{
    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getReferrerType($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_REFERRER_TYPE, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getAllReferrer($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_ALL_REFERRER , $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getSearchEngines($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_SEARCH_ENGINES, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getDistinctSearchEngines($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_NUMBER_OF_DISTINCT_SEARCH_ENGINES, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getDistinctKeywords($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_NUMBER_OF_DISTINCT_KEYWORDS, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getWebsites($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_WEBSITES, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getCampaigns($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_CAMPAIGNS, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getDistinctWebsites($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_NUMBER_OF_DISTINCT_WEBSITES, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getDistinctCampaigns($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::REFERRERS . parent::GET_NUMBER_OF_DISTINCT_CAMPAIGNS, $params);
	}
}
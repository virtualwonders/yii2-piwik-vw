<?php

namespace virtualwonders\piwikvw;


class PiwikVisitsSummary extends PiwikAPI 
{
    /**
     * @param $idSite
     * @return mixed
     */
	public function getVisitsSummary($idSite)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	'month',
			'date'	 =>	'today',
			'limit'	 => '10',
        ];

		return $this->request(parent::VISITS_SUMMARY . parent::GET, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getVisits($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::VISITS_SUMMARY . parent::GET_VISITS, $params);
	}

    /**
     * @param $idSite
     * @param $period
     * @param $date
     * @return mixed
     */
	public function getVisitors($idSite, $period, $date)
	{
		$params = [
			'idSite' => $idSite,
			'period' =>	$period,
			'date'	 =>	$date,
        ];

		return $this->request(parent::VISITS_SUMMARY . parent::GET_UNIQUE_VISITORS, $params);
	}
}
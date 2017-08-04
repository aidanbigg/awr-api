<?php

namespace AWR\Entities;

class Project {

	private $id;

	private $last_updated;

	private $timestamp;

	/**
	 * @var
	 */
	private $project_name;

	/**
	 * @var
	 */
	private $country;

	/**
	 * @var
	 */
	private $depth;

	/**
	 * @var
	 */
	private $frequency;

	/**
	 * @var
	 */
	private $keywords;

	/**
	 * @var
	 */
	private $search_engines;

	/**
	 * @var
	 */
	private $websites;

	/**
	 * @var
	 */
	private $awr_id;

	/**
	 * @var
	 */
	private $prefs;

	/**
	 * @var
	 */
	private $locations;

	/**
	 * TODO: Implement error handling
	 *
	 * @param bool $attributes
	 */
	public function __construct( $attributes = false ) {

		if ( $attributes ) {
			$this->setId( $attributes->project_details->id );
			$this->setAwrId( $attributes->project_details->id );
			$this->setProjectName( $attributes->project_details->name );
			$this->setFrequency( $attributes->project_details->frequency );
			$this->setDepth( $attributes->project_details->depth );
			$this->setLastUpdated( $attributes->project_details->last_updated );
			$this->setTimestamp( $attributes->project_details->timestamp );
			$this->setWebsites( $attributes->websites );
			$this->setKeywords( $attributes->keywords );
			$this->setPrefs( $attributes->prefs );
			$this->setSearchEngines( $attributes->searchengines );
			$this->setLocations( $attributes->locations );
		}
	}

	/**
	 * @return mixed
	 */
	public function getProjectName() {
		return $this->project_name;
	}

	/**
	 * @param mixed $project_name
	 */
	public function setProjectName( $project_name ) {
		$this->project_name = $project_name;
	}

	/**
	 * @return mixed
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param mixed $country
	 */
	public function setCountry( $country ) {
		$this->country = $country;
	}

	/**
	 * @return mixed
	 */
	public function getDepth() {
		return $this->depth;
	}

	/**
	 * @param mixed $depth
	 */
	public function setDepth( $depth ) {
		$this->depth = $depth;
	}

	/**
	 * @return mixed
	 */
	public function getFrequency() {
		return $this->frequency;
	}

	/**
	 * @param mixed $frequency
	 */
	public function setFrequency( $frequency ) {
		$this->frequency = $frequency;
	}

	/**
	 * @return mixed
	 */
	public function getKeywords() {
		return $this->keywords;
	}

	/**
	 * @param mixed $keywords
	 */
	public function setKeywords( $keywords ) {

		foreach ( $keywords as $keyword ) {
			$this->keywords[ $keyword->name ] = $keyword;
		}
	}

	public function editKeyword( $key, $operation, $data = false ) {

		$this->keywords[ $key ]->operation = $operation;

		foreach ( $data as $d_key => $d_value ) {
			if ( $d_key == 'kw_groups' ) {
				$this->keywords[ $key ]->$d_key = array_merge( $this->keywords[ $key ]->kw_groups, $d_value );
			} else {
				$this->keywords[ $key ]->$d_key = $d_value;
			}
		}
	}

	/**
	 * @param $keywords
	 */
	public function addKeyword( $keyword ) {
		$this->keywords[] = $keyword;
	}

	/**
	 * @return mixed
	 */
	public function getSearchEngines() {
		return $this->search_engines;
	}

	/**
	 * @param mixed $search_engines
	 */
	public function setSearchEngines( $search_engines ) {
		$this->search_engines = $search_engines;
	}

	/**
	 * @param $search_engine
	 */
	public function addSearchEngine( $search_engine ) {
		$this->search_engines[] = $search_engine;
	}

	/**
	 * @return mixed
	 */
	public function getWebsites() {
		return $this->websites;
	}

	/**
	 * @param mixed $websites
	 */
	public function setWebsites( $websites ) {

		foreach ( $websites as $website ) {
			$this->websites[ $website->name ] = $website;
		}
	}

	/**
	 * @param $website
	 */
	public function addWebsite( $website ) {
		$this->websites[] = $website;
	}
	
	/**
	 * @return mixed
	 */
	public function getAwrId() {
		return $this->awr_id;
	}

	/**
	 * @param mixed $awr_id
	 */
	public function setAwrId( $awr_id ) {
		$this->awr_id = $awr_id;
	}

	/**
	 * @return mixed
	 */
	public function getPrefs() {
		return $this->prefs;
	}

	/**
	 * @param mixed $prefs
	 */
	public function setPrefs( $prefs ) {
		$this->prefs = $prefs;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getLastUpdated() {
		return $this->last_updated;
	}

	/**
	 * @param mixed $last_updated
	 */
	public function setLastUpdated( $last_updated ) {
		$this->last_updated = $last_updated;
	}

	/**
	 * @return mixed
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * @param mixed $timestamp
	 */
	public function setTimestamp( $timestamp ) {
		$this->timestamp = $timestamp;
	}

	/**
	 * @return mixed
	 */
	public function getLocations() {
		return $this->locations;
	}

	/**
	 * @param mixed $locations
	 */
	public function setLocations( $locations ) {
		$this->locations = $locations;
	}
}
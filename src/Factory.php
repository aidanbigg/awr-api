<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 04/08/2017
 * Time: 10:53
 */

namespace AWR;

use AWR\Entities\Project;

class Factory {

	private $client;

	public function __construct( Client $client ) {
		$this->client = $client;
	}


	public function retrieveProject( $project_name ) {

		$parameters = array(
			'action'       => 'details',
			'project_name' => $project_name
		);

		$response = $this->client->request(
			$parameters,
			null,
			'GET'
		);

		return new Project( $response );
	}

	public function createProject( Project $project ) {

		$parameters = array(
			'action'       => 'create',
			'project_name' => $project->getProjectName(),
			'country'      => $project->getCountry(),
			'frequency'    => $project->getFrequency(),
			'depth'        => $project->getDepth()
		);

		$inputs = array(
			'keywords'      => $project->getKeywords(),
			'websites'      => $project->getWebsites(),
			'searchengines' => $project->getSearchEngines()
		);

		$response = $this->client->request(
			$parameters,
			$inputs,
			'POST'
		);

		if ( $response ) {
			// return project object
			return new Project( $this->retrieveProject( $project->getProjectName() ) );
		} else {
			// TODO: Handle some error. Currently just die();
			return $response;
		}
	}

	public function updateProject( Project $project ) {

		$parameters = array(
			'action'       => 'update',
			'project_name' => $project->getProjectName(),
			'country'      => $project->getCountry(),
			'frequency'    => $project->getFrequency(),
			'depth'        => $project->getDepth()
		);

		$inputs = array(
			'keywords'      => $project->getKeywords(),
			'websites'      => $project->getWebsites(),
			'searchengines' => $project->getSearchEngines()
		);

		$response = $this->client->request(
			$parameters,
			$inputs,
			'POST'
		);

		if ( $response ) {
			// return project object
			return new Project( $this->retrieveProject( $project->getProjectName() ) );
		} else {
			// TODO: Handle some error. Currently just die();
			return $response;
		}
	}

	public function retrieveProjects() {

		$parameters = array(
			'action' => 'projects'
		);

		$response = $this->client->request(
			$parameters,
			null,
			'GET'
		);

		$projects = array();

		foreach ( $response->projects as $project ) {
			$projects[] = new Project( $this->retrieveProject( $project->name ) );
		}

		return $projects;
	}
}
# awr-api
API wrapper for the Advanced Web Ranking API

# Install
Add the repository to your composer.json file
```
"repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/aidanbigg/awr-api.git"
    }
],
```

Require the package
```
"bigg/awr": "dev-master"
```

Run
```
composer update "bigg/awr"
```

You may need to run "composer dump-autoload -o" if any classes are not found.

# Usage

Most operations are carried out from the Factory class. This classes handles CRUD operations on projects/rankings ect.

Initialise the Factory class as follows:
```
// Create an instance of the AWR Client (Handles http requests & responses to the API)
$awr_client = new AWR\Client( 'api_key' );

// Create an instance of the AWR Factory
$awr_factory = new AWR\Factory( $awr_client );
```

## Retrieve all projects
```
// Retrieve all projects
$projects = $awr_factory->retrieveProjects();
```

## Get Project
```
$project = $awr_factory->retrieveProject( 'Project Name' );
```

## Create Project
```
// Initialise a Project entity
$project = new \AWR\Entities\Project();

// Set the project attributes
$project->setProjectName( 'Bigg' );

// Keywords
$keyword_one = array(
	"name"      => "My keyword",
	"index"     => 1,
	"color_r"   => 0,
	"color_g"   => 0,
	"color_b"   => 0,
	"kw_groups" => array(
		"group_one",
		"group_two"
	)
);

// Add keyword to project
$project->addKeyword( $keyword_one );

$project->addSearchEngine( array(
	"awr_id" => 64990
) );

// Add location/custom search engine
$project->addSearchEngine( array(
	"name"     => "google",
	"country"  => "US",
	"location" => "San Francisco, CA",
	"language" => "en"
) );

$project->addWebsite(
	array(
		"name"    => "mysite.com",
		"aliases" => array(
			"*.mysite.com"
		),
		"color_r" => 0,
		"color_g" => 0,
		"color_b" => 0,
		"index"   => 1
	)
);

$project->setDepth( 5 );
$project->setCountry( "US" );
$project->setFrequency( "daily" );

$awr_factory->createProject( $project );
```

## Update Project/Keywords
```
$project = $awr_factory->retrieveProject( 'Project Name' );

	$project->editKeyword( 'Keyword Name', \AWR\Operations::$_UPDATE, array(
		'priority'  => 1,
        'color_r'   => 101,
        'color_g'   => 101,
		'color_b'   => 101,
		'kw_groups' => array( 'ok' )
	) );

	$project = $awr_factory->updateProject( $project );
```

### Possible operations
```
\AWR\Operations::$_ADD
\AWR\Operations::$_UPDATE
\AWR\Operations::$_DELETE
```

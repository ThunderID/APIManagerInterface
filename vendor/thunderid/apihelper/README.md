# Thunder API Helper

Package contain engine to help basic API Post & Request.

# Require
Guzzlehttp/guzzle": "~5.3"

# Installation

composer.json:
```
	"thunderid/APIHelper": "dev-master"
```

run
```
	composer update
```

```
	composer dump-autoload
```

# Usage

## ENV setting
1. Domain 
API_domain="YOUR DOMAIN"
2. Port (if your domain use port. if you don't, you dont need to configure it on your env)
API_port="YOUR PORT"
3. Timeout (set custom waiting timout. Don't configure if you want use default value)
API_timeout="time interval"

service provider
```
'ThunderID\APIHelper\ThunderAPIHelperServiceProvider::class'
```

Aliases

1. API connector
desc : to comunicate (post/get) data (to/from) api
```
'API' => ThunderID\APIHelper\API\APIData::class,
```

2. JSEND
desc : to transfer data as jsend format
```
'JSEND' => ThunderID\APIHelper\Data\Jsend::class,
```
## Requirements

| Name    | Version                  |
| :------ |:--------------------------|
| PHP     | 8.1  |
| Laravel | 10.13.1 |

## Installation

Clone this repository from github :
```bash
git clone https://github.com/tfevan/spacenus.git
```

cd into your project :
```bash
cd spacenus
```

Install all composer dependencies :
```bash
composer install
```

Create a copy of your .env file :
```bash
cp .env.example .env
```

Generate an app encryption key :
```bash
php artisan key:generate
```

Add your database credentails on .env file :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Add your TomTom API Key on .env file :
```
TOMTOM_API_KEY=
```

Migrate the database :
```bash
php artisan migrate
```

Started the Artisan development server :
```bash
php artisan serve
```


## API Endpoint
```
http://localhost:8000
```

This API only accept `application/json` as header  :
```
Accept: application/json
```


## Create a User Registration :

```http
POST /api/register
```



| Parameter | Type | Description |
| :--- | :--- | :--- |
| `name` | `string` | **Required**.  |
| `email` | `string` | **Required**.  |
| `password` | `string` | **Required**.  |
| `confirm_password` | `string` | **Required**. Same as `password`  |


### Responses

#### ![#c5f015](https://placehold.co/18x18/c5f015/c5f015.png) Success (200) 

Successful operation will return a `200` status code with below JSON response : 

```javascript
{
    "success": bool,
    "data": {
        "token": string,
        "name": string
    },
    "message": string
}
```

Note : This `token` will use authenticate the client (user).

Postman Example :

![Register](https://i.stack.imgur.com/WxLLT.png)


#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Unprocessable entity (422) 
This will return a `422` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": "Registration failed.",
    "errors": {
        "key1": [
            string
        ],
        "key2": [
            string
        ]
    }
}
```

Postman Example :

![Register-error1](https://i.stack.imgur.com/UO5td.png)



#### ![#1589F0](https://placehold.co/15x15/1589F0/1589F0.png) Too Many Requests (429)

429  status code indicates the client has sent too many requests in a given amount of time. This will return a HTML page.





## User Login :

```http
POST /api/login
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `email` | `string` | **Required**.  |
| `password` | `string` | **Required**.  |


### Responses

#### ![#c5f015](https://placehold.co/18x18/c5f015/c5f015.png) Success (200) 

Successful operation will return a `200` status code with below JSON response : 

```javascript
{
    "success": bool,
    "data": {
        "token": string,
        "name": string
    },
    "message": string
}
```

Note : This `token` will use authenticate the user.

Postman Example :

![Login](https://i.stack.imgur.com/bNrSe.png)



#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Unprocessable entity (422) 
This will return a `422` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": string,
    "errors": {
        "key": [
            string
        ]
    }
}
```

Postman Example :

![Login-error-422](https://i.stack.imgur.com/v97UO.png)




#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Unauthorized (401) 
This will retuen a `401` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": string
}
```

Postman Example :

![Login-error1](https://i.stack.imgur.com/oCRLw.png)


#### ![#1589F0](https://placehold.co/15x15/1589F0/1589F0.png) Too Many Requests (429)

429  status code indicates the client has sent too many requests in a given amount of time. This will return a HTML page.



## Nearby Places Search :

```http
GET /api/places?lat={latitude}&long={longitude}
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `lat` | `decimal` | **Required**.  |
| `long` | `decimal` | **Required**.  |


You will use the `token` in your request's **Authorization** header. Here is an example :

```
'headers' => [
    'Authorization' => Bearer {token},
]
```
Please pass the **header** key = `"Accept"`, value = `"application/json"` :

```
'headers' => [
    'Accept' => application/json,
]
```

### Responses

#### ![#c5f015](https://placehold.co/18x18/c5f015/c5f015.png) Success (200) 

Successful operation will return a `200` status code. Here is an example below : 

```javascript
{
    "success": true,
    "data": {
        "summary": {
            "queryType": "NEARBY",
            "queryTime": 22,
            "numResults": 5,
            "offset": 0,
            "totalResults": 5,
            "fuzzyLevel": 1,
            "geoBias": {
                "lat": 23.8105745,
                "lon": 90.414838
            },
            "geobiasCountry": "BD"
        },
        "results": [
            {
                "type": "POI",
                "id": "QNTZLLdgqwGOLVq7l0EUQQ",
                "score": 106.7591011299,
                "dist": 2946.280796,
                "info": "search:geonames:1196550",
                "poi": {
                    "name": "Kurmitola",
                    "categorySet": [
                        {
                            "id": 7380004
                        }
                    ],
                    "categories": [
                        "railroad station"
                    ],
                    "classifications": [
                        {
                            "code": "PUBLIC_TRANSPORT_STOP",
                            "names": [
                                {
                                    "nameLocale": "en-US",
                                    "name": "railroad station"
                                }
                            ]
                        }
                    ]
                },
                "address": {
                    "municipality": "Dhaka",
                    "countrySubdivision": "Dhaka",
                    "countryCode": "BD",
                    "country": "Bangladesh",
                    "countryCodeISO3": "BGD",
                    "freeformAddress": "Dhaka, Dhaka"
                },
                "position": {
                    "lat": 23.83333,
                    "lon": 90.4
                },
                "viewport": {
                    "topLeftPoint": {
                        "lat": 23.83423,
                        "lon": 90.39902
                    },
                    "btmRightPoint": {
                        "lat": 23.83243,
                        "lon": 90.40098
                    }
                }
            },
            {
                "type": "POI",
                "id": "_bJ-XC9OiQWIY3rJ5X6vmA",
                "score": 105.5621360771,
                "dist": 4034.423131,
                "info": "search:geonames:6301871",
                "poi": {
                    "name": "Kurmitola, Dia",
                    "categorySet": [
                        {
                            "id": 7383
                        }
                    ],
                    "categories": [
                        "airport"
                    ],
                    "classifications": [
                        {
                            "code": "AIRPORT",
                            "names": [
                                {
                                    "nameLocale": "en-US",
                                    "name": "airport"
                                }
                            ]
                        }
                    ]
                },
                "address": {
                    "municipality": "Dhaka",
                    "countrySubdivision": "Dhaka",
                    "countryCode": "BD",
                    "country": "Bangladesh",
                    "countryCodeISO3": "BGD",
                    "freeformAddress": "Dhaka, Dhaka"
                },
                "position": {
                    "lat": 23.84333,
                    "lon": 90.39778
                },
                "viewport": {
                    "topLeftPoint": {
                        "lat": 23.84423,
                        "lon": 90.3968
                    },
                    "btmRightPoint": {
                        "lat": 23.84243,
                        "lon": 90.39876
                    }
                }
            },
            {
                "type": "POI",
                "id": "X_pqIoWHzUxsck1N0nZrrA",
                "score": 105.5616661063,
                "dist": 4034.850821,
                "info": "search:ta:050019005009447-BD",
                "poi": {
                    "name": "Zia International",
                    "categorySet": [
                        {
                            "id": 7383
                        }
                    ],
                    "categories": [
                        "airport"
                    ],
                    "classifications": [
                        {
                            "code": "AIRPORT",
                            "names": [
                                {
                                    "nameLocale": "en-US",
                                    "name": "airport"
                                }
                            ]
                        }
                    ]
                },
                "address": {
                    "municipality": "Dhaka",
                    "countrySubdivision": "Dhaka",
                    "countryCode": "BD",
                    "country": "Bangladesh",
                    "countryCodeISO3": "BGD",
                    "freeformAddress": "Dhaka, Dhaka",
                    "localName": "Dhaka"
                },
                "position": {
                    "lat": 23.843333,
                    "lon": 90.397778
                },
                "viewport": {
                    "topLeftPoint": {
                        "lat": 23.84615,
                        "lon": 90.3947
                    },
                    "btmRightPoint": {
                        "lat": 23.84052,
                        "lon": 90.40086
                    }
                },
                "entryPoints": [
                    {
                        "type": "main",
                        "position": {
                            "lat": 23.84114,
                            "lon": 90.39971
                        }
                    }
                ]
            },
            {
                "type": "POI",
                "id": "-wx7-97Am-kpPmwTamyYDA",
                "score": 104.701997356,
                "dist": 4816.371011,
                "info": "search:geonames:6301087",
                "poi": {
                    "name": "Dhaka",
                    "categorySet": [
                        {
                            "id": 7383
                        }
                    ],
                    "categories": [
                        "airport"
                    ],
                    "classifications": [
                        {
                            "code": "AIRPORT",
                            "names": [
                                {
                                    "nameLocale": "en-US",
                                    "name": "airport"
                                }
                            ]
                        }
                    ]
                },
                "address": {
                    "municipality": "Dhaka",
                    "countrySubdivision": "Dhaka",
                    "countryCode": "BD",
                    "country": "Bangladesh",
                    "countryCodeISO3": "BGD",
                    "freeformAddress": "Dhaka, Dhaka"
                },
                "position": {
                    "lat": 23.77878,
                    "lon": 90.38269
                },
                "viewport": {
                    "topLeftPoint": {
                        "lat": 23.77968,
                        "lon": 90.38171
                    },
                    "btmRightPoint": {
                        "lat": 23.77788,
                        "lon": 90.38367
                    }
                }
            },
            {
                "type": "POI",
                "id": "j2EOeQfNh4_EksBXpK0bxA",
                "score": 104.6474052223,
                "dist": 4866.004638,
                "info": "search:ta:050019005009451-BD",
                "poi": {
                    "name": "Khademul Bashar Airbase",
                    "categorySet": [
                        {
                            "id": 7383004
                        }
                    ],
                    "categories": [
                        "airport",
                        "military authority"
                    ],
                    "classifications": [
                        {
                            "code": "AIRPORT",
                            "names": [
                                {
                                    "nameLocale": "en-US",
                                    "name": "military authority"
                                },
                                {
                                    "nameLocale": "en-US",
                                    "name": "airport"
                                }
                            ]
                        }
                    ]
                },
                "address": {
                    "municipality": "Dhaka",
                    "countrySubdivision": "Dhaka",
                    "countryCode": "BD",
                    "country": "Bangladesh",
                    "countryCodeISO3": "BGD",
                    "freeformAddress": "Dhaka, Dhaka",
                    "localName": "Dhaka"
                },
                "position": {
                    "lat": 23.778333,
                    "lon": 90.3825
                },
                "viewport": {
                    "topLeftPoint": {
                        "lat": 23.78055,
                        "lon": 90.38008
                    },
                    "btmRightPoint": {
                        "lat": 23.77612,
                        "lon": 90.38492
                    }
                },
                "entryPoints": [
                    {
                        "type": "main",
                        "position": {
                            "lat": 23.77887,
                            "lon": 90.38015
                        }
                    }
                ]
            }
        ]
    }
}
```


#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Unprocessable Content (422) 
This will retuen a `422` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": string,
    "errors": {
        "key": [
            string
        ]
    }
}
```

Postman Example :

![422-error](https://i.stack.imgur.com/7kaQn.png)



#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Bad Request (400) 
This will return a `400` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": string,
}
```

Postman Example :

![400-error](https://i.stack.imgur.com/E3Fu0.png)


#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Forbidden (403) 
This will return a `403` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": string,
}
```



#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Method Not Allowed (405) 
This will return a `405` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": string,
}
```


#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Too Many Requests (429) 
This will return a `429` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": string,
}
```


#### ![#f03c15](https://placehold.co/15x15/f03c15/f03c15.png) Server Error (500) 
This will return a `500` status code with below JSON response : 

```javascript
{
    "success": bool,
    "message": string,
}
```

#### ![#1589F0](https://placehold.co/15x15/1589F0/1589F0.png) Too Many Requests (429)

429  status code indicates the client has sent too many requests in a given amount of time. This will return a HTML page.


# Bootstrap data grid

## Required config options
Next config params are required to create data grid

* ```container: jQuery``` jQuery selector pointing to container element where
  data grid will be rendered (```.container | .container-fluid```) are suggested
* ```url: string``` The url from where to fetch grid data. Two query params 
  will be appended:
  - ```page: int``` The number of page to fetch
  - ```size: int``` The number of items per page
* ```columns: object[]``` Columns to render on each row, each column should be 
  like:
  - ...

## Optional config options
Next config params are available but are optional

* ```pageSize: int``` (Default: 20) Number of items to render per page
  
## Remote JSON response
When using a remote url to fetch grid data your server should respond with a JSON
object with this properties:

- ```page: int``` Index of page being returned (Starting at 0)
- ```size: int``` Number of items per page
- ```count: int``` Total number of items (Across all pages)
- ```data: object[]``` Page contents

For example:
```json
{
  "page": 4,
  "size": 2,
  "count": 50,
  "data": [
    { "id": 7, "full_name": "A pretty name", "email": "user@example.com" },
    { "id": 8, "full_name": "Strange name", "email": "strange@example.com" }
  ]
}
```

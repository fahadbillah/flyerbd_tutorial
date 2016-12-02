# FLYERBD TUTORIAL

Angular (v-1.x) and Codeigniter (v-3.x) [Youtube Tutorial](https://www.youtube.com/watch?v=mHc-q0WjTQQ&list=PLmnDE5FTOQtkpGVC6mRs8bkzWYHTWmX2c)


## Getting Started

`bower install`

## Angular Codeigniter Facebook Registration | Part 3

Change git branch accordingly to tutorial.

`git checkout angular-codeigniter-facebook-registration-part-3`

[Video Link: Angular Codeigniter Facebook Registration | Part 3](https://www.youtube.com/watch?v=N0rjnMfajhc&feature=youtu.be)


# ROUTING

We have to make sure there are only 3 type of CI route called

- AJAX call for JSON data
- Load partial view from template url
- Any other CI route redirect to `main/index`

### AJAX call for JSON data

Let ajax call route starts with 'api'

`api/controller_name/method_name` 

and redirect it to 

`controller_name/method_name` (CI's default uri_protocol=REQUEST_URI)

in routes.php add following line

`$route['api/(:any)/(:any)'] = '$1/$2';`

### Load partial view from template url

Let partial view route starts with 'view'

`view/controller_name/index` (as we load partial view only in index method)

and redirect it to 

`controller_name/index`

in routes.php add following line

`$route['view/(:any)/index'] = '$1/index';`

### Any other CI route redirect to `main/index`

For rest of the CI route redirect to load `main/index`

in routes.php add following lines

`$route['(:any)/(:any)/(:any)'] = 'main/index';` for controller_name/method_name/parameter_name
`$route['(:any)/(:any)'] = 'main/index';` for controller_name/method_name/
`$route['(:any)'] = 'main/index';` for controller_name/
`$route['404_override'] = 'main/index';` for any route that not found







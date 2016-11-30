# FLYERBD TUTORIAL

Angular (v-1.x) and Codeigniter (v-3.x) [Youtube Tutorial](https://www.youtube.com/watch?v=mHc-q0WjTQQ&list=PLmnDE5FTOQtkpGVC6mRs8bkzWYHTWmX2c)


## Getting Started

`bower install`

## Angular Codeigniter Facebook Registration | Part 3

Change git branch accordingly to tutorial.

`git checkout angular-codeigniter-facebook-registration-part-3`

[Video Link: Angular Codeigniter Facebook Registration | Part 3](https://www.youtube.com/watch?v=N0rjnMfajhc&feature=youtu.be)


# ROUTING

In this app 2 types of routing system works

1. Codeigniter routing system
2. Angular routing system

Besides from Angular app AJAX call made to Codeigniter routing system for 2 reason

1. For loading view
2. For loading JSON data

### WE NEED TO SEPARATE CODEIGNITER ROUTE FROM ANGULAR ROUTE

Otherwise for some route Angular app will show broken partial view which is basically Codeigniter route

### Our strategy to trigger different routing system

#### Trigger CI route in 2 occasion

1. First loading of the app
2. When app refreshed

in both of these cases redirect CI route to our default view route (main/index)


THATS WHY WE ARE DEFINING CODEIGNITER ROUTING INTO 4 PATTERN
	
	1. VIEW/ANY_CONTROLLER/INDEX_METHOD		->	REDIRECTS TO ANY_CONTROLLER/INDEX_METHOD
	2. API/ANY_CONTROLLER/ANY_METHOD		->	REDIRECTS TO ANY_CONTROLLER/ANY_METHOD
	3. ANY_CONTROLLER/ANY_METHOD			->	REDIRECTS TO MAIN_CONTROLLER/INDEX_METHOD
	3. ANY OTHER NON-VALID ROUTE			->	REDIRECTS TO MAIN_CONTROLLER/INDEX_METHOD
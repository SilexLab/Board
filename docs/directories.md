Silex Bulletin Board directory scheme
=====================================

```
[root]							Root directory of your installation

    * docs						Documentation on the software
	* Draft						
	* js						Globally used JavaScript (libraries, functions, etc.)
	* lib						PHP functions and classes and initialise code

		- ajax					Scripts for AJAX implementation (JS)
		- core					Core functions

			+ config			Configuration management
			+ data				
			+ exception			Core exceptions
			+ interface			Globally used interfaces
			+ language			Language handling
			+ notification		Notifications
			+ template 			Template handling (Smarty wrapper, Style)
			+ user				User, Group and Permissions handling

		- data					Classes for data management and handling

			+ board 			Core classes of Board, Post and Thread
			+ cache				Caching
			+ database			Database handler
			+ database_old		Old database wrapper
			+ github			GitHub related functions
			+ mail				Mail sender
			+ page				Page management
			+ pages				Classes for each page
			+ session			Session variable management
			+ template 			Variable template aspects (Breadcrumbs, etc.)
			+ transfer			Transfer-related functions (HTTP, URI)

		- language				Language installations
		- smarty				Smarty template engine
		- util					Utility classes

	* style						Different styles (CSS, JS, etc.)
	* template					Template files
```
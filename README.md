The application consists of :

1) Backend : Laravel 
2) Frontend: Vue js

Its a frontend rendered and backend routed application

Laravel controller "UrlController"  @index method returns vue component name "CreateUrl"
@url method receives post request in json from vuejs frontend and performs token generation and database manipulations.
finally returns newly created or existing short url in json format to vuejs frontend.

Frontend design done with Vuetify plugin

Public demo link is given here : 

http://url-generatorr.herokuapp.com/


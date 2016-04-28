
var app = angular.module('ABMangularPHP', ['ui.router', 'angularFileUpload'])
.config(
function($stateProvider,$urlRouterProvider){
  
  $stateProvider
  .state('menu',{
    url:'/menu',
    templateUrl:'menu.html',
    controller:'controlMenu'
  })
  .state('alta',{
    url:'/alta',
    templateUrl:'formAlta.html',
    controller:'controlAlta'
  })
  .state('grilla',{
    url:'/grilla',
    templateUrl:'formGrilla.html',
    controller:'controlGrilla'
  })
  .state('modificar',{
    url:'/modificar/{nombre}?:apellido:dni',
    templateUrl:'formAlta.html',
    controller:'controlMod'
  });


  $urlRouterProvider.otherwise('/menu');
});


app.controller('controlMenu', function($scope, $http) {
  $scope.DatoTest="**Menu**";
});

app.controller('controlMod', function($scope, $http, $stateParams) {
  $scope.DatoTest="**Menu**";
  console.log($stateParams);
  $scope.persona = {};
  $scope.persona.nombre = $stateParams.nombre;
  $scope.persona.apellido = $stateParams.apellido;
  $scope.persona.dni = $stateParams.dni;


});
app.controller('controlAlta',  function($scope, $http, FileUploader) {
  $scope.DatoTest="**alta**";

//inicio las variables
  $scope.persona={};
  $scope.persona.nombre= "natalia" ;
  $scope.persona.dni= "12312312" ;
  $scope.persona.apellido= "natalia" ;
  $scope.persona.foto="pordefecto.png";
  $scope.uploader = new FileUploader({url: 'PHP/upload.php'})

  $scope.Guardar=function(){
    console.log($scope.uploader.queue[0]);

    var name = $scope.uploader.queue[0].file.name;
    var ext = name.slice(name.lastIndexOf(".") ,name.length);
    console.log(ext);
    $scope.uploader.queue[0].file.name = $scope.persona.dni + ext;
    //$scope.uploader.queue[0].file.name = "lalala.jpeg";
    //console.log($scope.uploader.queue[0].file.name);
    $scope.persona.foto = $scope.uploader.queue[0].file.name;
    console.log($scope.persona.foto);
    console.log($scope.uploader.queue[0]);


    dato = $scope.uploader.uploadAll();
    console.log(dato);
  	console.log("persona a guardar:");
    console.log($scope.persona);
    $http.post('PHP/nexo.php', { datos: {accion :"insertar",persona:$scope.persona}})
 	  .then(function(respuesta) {     	
 		     //aca se ejetuca si retorno sin errores      	
      	 console.log(respuesta.data);

    },function errorCallback(response) {     		
     		//aca se ejecuta cuando hay errores
     		console.log( response);     			
 	  });

  

  }
});


app.controller('controlGrilla', function($scope, $http) {
  	$scope.DatoTest="**grilla**";
 	
 	$http.get('PHP/nexo.php', { params: {accion :"traer"}})
 	.then(function(respuesta) {     	

      	 $scope.ListadoPersonas = respuesta.data.listado;
      	 console.log(respuesta.data);

    },function errorCallback(response) {
     		 $scope.ListadoPersonas= [];
     		console.log( response);
       });    
     			/*

					https://docs.angularjs.org/api/ng/service/$http

     			the response object has these properties:

				data – {string|Object} – The response body transformed with the transform functions.
				status – {number} – HTTP status code of the response.
				headers – {function([headerName])} – Header getter function.
				config – {Object} – The configuration object that was used to generate the request.
				statusText – {string} – HTTP status text of the response.
						A response status code between 200 and 299 is considered a success
						 status and will result in the success callback being called. 
						 Note that if the response is a redirect, XMLHttpRequest will 
						 transparently follow it, meaning that 
						 the error callback will not be called for such responses.
 	 */


 	$scope.Borrar=function(persona){
    
		console.log("borrar " + persona.nombre);

    $http.post("PHP/nexo.php",{datos:{accion :"borrar",persona: persona}})
    .then(function(respuesta) {       
         //aca se ejetuca si retorno sin errores        
         console.log(respuesta.data);
    },function errorCallback(response) {        
        //aca se ejecuta cuando hay errores
        console.log( response);           
    });

    $http.get('PHP/nexo.php', { params: {accion :"traer"}})
  .then(function(respuesta) {       

         $scope.ListadoPersonas = respuesta.data.listado;
         console.log(respuesta.data);

    },function errorCallback(response) {
         $scope.ListadoPersonas= [];
        console.log( response);
       });
  };
/*
     $http.post('PHP/nexo.php', 
      headers: 'Content-Type': 'application/x-www-form-urlencoded',
      params: {accion :"borrar",persona:persona})
    .then(function(respuesta) {       
         //aca se ejetuca si retorno sin errores        
         console.log(respuesta.data);

    },function errorCallback(response) {        
        //aca se ejecuta cuando hay errores
        console.log( response);           
    });

*/
 	




 	$scope.Modificar=function(persona){
 		
 		console.log(persona.nombre);
 	};





});

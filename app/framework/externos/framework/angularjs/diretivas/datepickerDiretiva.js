app.directive('bsdatepickerValida', function() {
  return {
      restrict: 'AE',
      require: 'ngModel',
      link: function(scope,element,attrs,ctrl){
      	
      	  element.datetimepicker({locale: 'pt-br', format: 'DD/MM/YYYY HH:mm'}).on("dp.change", function (e) {

      		  var data= $('#'+attrs.id).val();
			
			      ctrl.$setViewValue(data);
			

          });

      }
  };
  
});;
app.directive("phoneDir", PhoneDir);

function PhoneDir() {
  return {
    link : function(scope, element, attrs) {
        var options = {
            onKeyPress: function(val, e, field, options) {
                putMask();
            }
        }
 
        $(element).mask('(00) 00000-0000', options);
 
        function putMask() {
            var mask;
            var cleanVal = element[0].value.replace(/\D/g, '');//pega o valor sem mascara
            if(cleanVal.length > 10) {//verifica a quantidade de digitos.
                mask = "(00) 00000-0000";
            } else {
                mask = "(00) 0000-00009";
            }
            $(element).mask(mask, options);//aplica a mascara novamente
        }
    }
  }
}



function SoloNumeroPunto(evt){
    // Manejo de caracteres a traves del Codigo ASCII
    var code = (evt.which) ? evt.which : evt.keyCode;
    
    if(code==8) { // Espacio.
      return true;
    } else if(code>=48 && code<=57) { // Grupo de Codigo ASCII para los numeros.
      return true;
    } else if(code==46) { // is a .
        return true;
    } else{ // Otras letras o caracteres.
      return false;
    }
}
function SoloNumero(evt){
    // Manejo de caracteres a traves del Codigo ASCII
    var code = (evt.which) ? evt.which : evt.keyCode;
    
    if(code==8) { // Espacio.
      return true;
    } else if(code>=48 && code<=57) { // Grupo de Codigo ASCII para los numeros.
      return true;
    } else{ // Otras letras o caracteres.
      return false;
    }
}
function SoloLetras(evt){
    // Manejo de caracteres a traves del Codigo ASCII
    var code = (evt.which) ? evt.which : evt.keyCode;
    
    if(code==8) { // retroceso.
      return true;
    } 
    else if(code==32) { // Espacio.
      return true;
    }
    else if(code>=65 && code<=90) { // Grupo de Codigo ASCII para las letras mayusculas.
      return true;
    } else if(code>=97 && code<=122) { // Grupo de Codigo ASCII para las letras minusculas.
        return true;
    } 
    else if(code>=164 && code<=165) { // ñ y Ñ.
      return true;
    }
    else{ // Otras letras o caracteres.
      return false;
    }
}
function validarTelefono(tel) {
  // Check if the string length is not 12
  if (tel.length !== 12) {
    return false;
  }

  // Check if the string matches the regular expression
  if (!/^\d{4}-\d{7}$/.test(tel)) {
    return false;
  }

  // If the string passes both checks, return true
  return true;
}
function validarEmail(email) {
  // Regular expression to validate the email format
  const expresion = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

  // Check if the email matches the regular expression
  if (expresion.test(email)) {
    return true;
  } else {
    return false;
  }
}
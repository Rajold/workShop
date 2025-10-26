// public/js/main.js
function validateLogin(f){
  if(!f.usuario.value || !f.password.value) { alert('Completa el usuario y la contraseña'); return false; }
  return true;
}
function validateSetup(f){ if(!f.nombre.value||!f.usuario.value||!f.password.value){alert('Completa todos los campos');return false;}return true; }
function validateUserForm(f){ return validateSetup(f); }
function validateVehicleForm(f){ if(!f.placa.value){alert('Placa requerida');return false;}return true; }

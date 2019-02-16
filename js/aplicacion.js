function validarUsuario()
{
	var passwdOperaciones = document.getElementById('tPasswordOperaciones'),
		passwdVerificador = document.getElementById('tPasswordVerificador'),
		btnGuardar = document.getElementById('btnGuardar'),
		btnValidar = document.getElementById('btnValidar');
	
	if(passwdOperaciones.value == passwdVerificador.value)
		{
			btnGuardar.disabled = false;
            passwdOperaciones.style.display = 'none';
            btnValidar.style.display = 'none';
		}
}

function fnRedireccionar(seccion)
{
	window.location = seccion;
}

function cerrarSesion()
{
	if(confirm("Realmente deseas salir?"))
		{
			window.location="logout.php";
		}
}

function guardar(cierre)
{
	var formulario = document.getElementById('datos'),
		eAccion = document.getElementById('eAccion');
	
	eAccion.value = 1;
	if(confirm((cierre ? "Tu sesión se cerrará al guardar los cambios\n" : "") + "Deseas guardar la información?"))
		{
			formulario.submit();
		}
}

function activarValidacion()
{
    document.getElementById('tPasswordOperaciones').style.display = 'inline';
    
    document.getElementById('tPasswordOperaciones').focus();
}
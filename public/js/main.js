// public/js/main.js
function validateLogin(f){
  if(!f.usuario.value || !f.password.value) { alert('Completa el usuario y la contraseña'); return false; }
  return true;
}
function validateSetup(f){ if(!f.nombre.value||!f.usuario.value||!f.password.value){alert('Completa todos los campos');return false;}return true; }
function validateUserForm(f){ return validateSetup(f); }
function validateVehicleForm(f){ if(!f.placa.value){alert('Placa requerida');return false;}return true; }

document.addEventListener('DOMContentLoaded', function () {

    const duration = document.querySelector('[data-case-duration]');

    if (!duration) {
        return;
    }

    let seconds = parseInt(
        duration.dataset.seconds || '0',
        10
    );

    const active = duration.dataset.active === '1';

    const valueElement = duration.querySelector(
        '[data-case-duration-value]'
    );

    const statusElement = duration.querySelector(
        '[data-case-duration-status]'
    );


    function formatDuration(totalSeconds) {

        const days = Math.floor(totalSeconds / 86400);

        const hours = Math.floor(
            (totalSeconds % 86400) / 3600
        );

        const minutes = Math.floor(
            (totalSeconds % 3600) / 60
        );

        const seconds = totalSeconds % 60;


        if (days > 0) {

            return `${days} día${days !== 1 ? 's' : ''}, `
                + `${hours} h ${minutes} min`;

        }

        if (hours > 0) {

            return `${hours} h ${minutes} min`;

        }

        return `${minutes} min ${seconds} s`;
    }


    function updateDuration() {

        valueElement.textContent =
            formatDuration(seconds);


        duration.classList.remove(
            'case-duration-normal',
            'case-duration-warning',
            'case-duration-danger',
            'case-duration-closed'
        );


        if (!active) {

            duration.classList.add(
                'case-duration-closed'
            );

            statusElement.textContent =
                'Caso cerrado';

            return;
        }


        const days =
            seconds / 86400;


        if (days < 1) {

            duration.classList.add(
                'case-duration-normal'
            );

            statusElement.textContent =
                'En tiempo';

        } else if (days < 3) {

            duration.classList.add(
                'case-duration-warning'
            );

            statusElement.textContent =
                'Atención';

        } else {

            duration.classList.add(
                'case-duration-danger'
            );

            statusElement.textContent =
                'Demorado';
        }
    }


    updateDuration();


    if (active) {

        setInterval(function () {

            seconds++;

            updateDuration();

        }, 1000);
    }

});

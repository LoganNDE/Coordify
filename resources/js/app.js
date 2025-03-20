import './bootstrap';
import Swal from 'sweetalert2';

window.onload = () =>{
    const mylocalStorage = window.localStorage;
    let error = mylocalStorage.getItem('laravelError');
    let success = mylocalStorage.getItem('successLaravel')


    //Elementos DOM
    const deleteEventBtn = document.querySelectorAll('.btnRemove');
    const btnLogout = document.getElementById('logout');
    const btnImportEvent = document.getElementById('btnImportEvent');

    if (error) {
      const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "error",
        title: error
      });
      mylocalStorage.removeItem('laravelError')
    }

    if (success) {
      const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "success",
        title: success
      });
      mylocalStorage.removeItem('successLaravel')
    }

    const deleteEvent = (event) =>{
        event.preventDefault();

        Swal.fire({
            title: "¿Deseas eliminar este evento?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Si, quiero eliminarlo!",
            cancelButtonText: "Cancelar",
            heightAuto: false
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success",
                heightAuto: false,
              }).then(() =>{
                window.location.href = event.target.parentElement.href;
              });
            ;
            }
          });
    }

    deleteEventBtn.forEach(element => {
        element.addEventListener('click', deleteEvent);
        console.log(element)
    });


    const confirmLogout = (event) => {
      event.preventDefault();
      Swal.fire({
        title: "¿Seguro que quieres cerrar sesión?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Si, confirmar!",
        cancelButtonText: "Cancelar",
        heightAuto: false
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.parentElement.href;
        }
      });
    }

    const importEvent =  async () => {
      const { value: file } = await Swal.fire({
        title: "Importar eventos",
        text: "La importación debe realizarse utilizando la plantilla proporcionada",
        input: "file",
        html: `
        <a href="/files/template_events.csv" download>Descargar Plantilla</a>
      `,
        confirmButtonText: "Importar",
        heightAuto: false,
        inputAttributes: {
          "accept": ".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel",
          "aria-label": "Upload your profile picture"
        }
      });
      if (file) {
          Swal.fire({
            icon: "success",
            heightAuto: false,
            title: "Your uploaded picture",
          }).then((result) => {
            if (result.isConfirmed) {
              if (mylocalStorage.getItem('csrf_token')){
                let csrf_token = mylocalStorage.getItem('csrf_token')
                const formData = new FormData();
                formData.append('file', file);
                fetch('http://127.0.0.1:8000/event/import', {
                  headers: {
                    "X-CSRF-Token": csrf_token,
                  },
                  method: 'POST',
                  body: formData
                }).then(response => response.json())
                .then(result => {
                  console.log('Success:', result);
                })
                .catch(error => {
                  console.error('Error:', error);
                });
              }
            }
          });
      }
    }


    if (btnLogout){
      btnLogout.addEventListener('click', confirmLogout);
    }

    if (btnImportEvent){
      btnImportEvent.addEventListener('click', importEvent)
    }

}

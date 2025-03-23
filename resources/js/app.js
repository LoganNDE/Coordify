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
    const viewTime = document.querySelectorAll('.viewTime');
    const viewDate = document.querySelectorAll('.viewDate');
    const paidRadio = document.getElementById('paidRadio');
    const freeRadio = document.getElementById('freeRadio');
    const inputCategories = document.getElementById('inputCategories');

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

    const priceCase = (event) =>{
      if (event.target.checked){
        console.log(event.target)
        let priceCase = document.querySelector('.inputPrice');
          if (priceCase && event.target.id == 'paidRadio'){
            priceCase.classList.remove('hidden');
          }else if (priceCase && event.target.id == 'freeRadio'){
            priceCase.classList.add('hidden')
          }
      }
    }

    if (inputCategories){
        let request = fetch('/data/api/getcategories')
        request.then((response)=>{
          if (!response.ok){
            console.log('Ha surgido un error')
          }

          let data = response.json();
          data.then((response)=>{
            console.log(response.data)
            response.data.forEach(category => {
              let option = document.createElement( 'option' );
              option.value = option.text = category['name'];
              option.style.textTransform = 'capitalize';
              inputCategories.style.textTransform = 'capitalize';
              inputCategories.add(option);
            });
          })

        })
        
    }


    if (btnLogout){
      btnLogout.addEventListener('click', confirmLogout);
    }

    if (btnImportEvent){
      btnImportEvent.addEventListener('click', importEvent)
    }

    if (paidRadio){
      //let priceCase = document.querySelector('.inputPrice');
      paidRadio.addEventListener('change', priceCase)
      freeRadio.addEventListener('change', priceCase)
      /*if (paidRadio.checked){
        priceCase.classList.remove('hidden')
      }
      */
    }


    if (viewTime){
      let maxLength = 6;
      viewTime.forEach(time => {
        time.textContent = time.textContent.substring(0, maxLength)
      });
    }

    if (viewDate){
      viewDate.forEach(date => {
        let arrDate = date.textContent.split('-')
        date.textContent = arrDate[2]+'/'+arrDate[1]+'/'+arrDate[0];
      });
    }
}

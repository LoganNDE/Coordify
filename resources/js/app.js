import './free_events';
import './menu-mobile';
import Swal from 'sweetalert2';
import Splide from '@splidejs/splide';
import '@splidejs/splide/css';
// To use Html5QrcodeScanner (more info below)
import {Html5QrcodeScanner} from "html5-qrcode";


window.onload = () =>{
    const mylocalStorage = window.localStorage;
    let error = mylocalStorage.getItem('laravelError');
    let success = mylocalStorage.getItem('successLaravel')


    if (document.querySelector('.splide')){
      let splide = new Splide( '.splide', {
        perPage: 10,
        breakpoints: {
          640: {
            perPage: 4,
          },
          768:{
            perPage: 5,
          },
          1200:{
            perPage: 6,
          },
          1400:{
            perPage: 7,
          },
          1600:{
            perPage: 8,
          }
        }
      });
      splide.mount();
    }

    if (document.querySelector('#splideQR')){
      new Splide('#splideQR', {
        type: 'loop',
        perPage: 1,
        pagination: false,
        arrows: true,
      }).mount();
    }
  

    //Elementos DOM
    const deleteEventBtn = document.querySelectorAll('.btnRemove');
    const btnLogout = document.getElementById('logout');
    const btnImportEvent = document.getElementById('btnImportEvent');
    const paidRadio = document.getElementById('paidRadio');
    const freeRadio = document.getElementById('freeRadio');
    const communityList = document.getElementById('communityList');
    const inputCategories = document.getElementById('inputCategories');
    const QRContainerReader = document.querySelector('.QRContainerReader');

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
            confirmButtonText: "¡Si, quiero eliminarlo!",
            cancelButtonText: "Cancelar",
            customClass: {
              confirmButton: 'swal2-confirm-custom',
              cancelButton: 'swal2-cancel-custom'
            },
            heightAuto: false
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Borrado!",
                text: "Se ha eliminado el evento correctamente.",
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
        confirmButtonText: "¡Si, confirmar!",
        cancelButtonText: "Cancelar",
        customClass: {
          confirmButton: 'swal2-confirm-custom',
          cancelButton: 'swal2-cancel-custom'
        },
        heightAuto: false
      }).then((result) => {
        if (result.isConfirmed) {
            console.log(event.target.href);
            if (event.target.parentElement.href != undefined){
                window.location.href = event.target.parentElement.href;
            }else if(event.target.href != undefined){
              window.location.href = event.target.href;
            }
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
            title: "Evento/s importados correctamente",
          }).then((result) => {
            if (result.isConfirmed) {
              if (mylocalStorage.getItem('csrf_token')){
                let csrf_token = mylocalStorage.getItem('csrf_token')
                const formData = new FormData();
                formData.append('file', file);
                fetch('/event/import', {
                  headers: {
                    "X-CSRF-Token": csrf_token,
                  },
                  method: 'POST',
                  body: formData
                }).then(response => response.json())
                .then(result => {
                  mylocalStorage.setItem('successLaravel', 'Evento/s importados correctamente');
                  window.location.href = '/events';
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

    if (inputCategories) {
      const selectedCategory = document.getElementById('selectedCategory');
    
      fetch('/data/api/getcategories')
        .then((response) => {
          if (!response.ok) {
            console.log('Ha surgido un error');
          }
          return response.json();
        })
        .then((response) => {
          console.log(response.data);
          response.data.forEach((category) => {
            const option = document.createElement('option');
            option.value = option.text = category['name'];
            option.style.textTransform = 'capitalize';
            inputCategories.style.textTransform = 'capitalize';
            inputCategories.add(option);
          });
    
          if (selectedCategory) {
            inputCategories.value = selectedCategory.value;
          }
        })
        .catch((error) => console.error(error));
    }
    

    const updateQueryParam = (key, value) => {
      const url = new URL(window.location.href);
      url.searchParams.set(key, value);
      window.location.href = url.toString();
    }


    const filterForCommunity = (event) => {
      console.log(event.target);
      updateQueryParam('community', event.target.value);
    }
    
    //CCAA = COMUNIDAD AUTONOMA
    const getAllCCAA = async () =>{
      const selectedCommunity = document.getElementById('selectedCommunity');
      
        // Esperamos a que las opciones se hayan cargado
        fetch('https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/georef-spain-comunidad-autonoma/records?limit=30')
          .then(response => response.json())
          .then(data => {
            data.results.forEach(ccaa => {
              if (ccaa.acom_name !== 'Territorio no asociado a ninguna autonomía') {
                let option = document.createElement('option');
                option.value = option.text = ccaa.acom_name;
                option.style.textTransform = 'capitalize';
                communityList.appendChild(option);
              }
            });

            if (communityList.getAttribute('data-input') == 'IndexInputCommunity'){
              communityList.addEventListener('change', filterForCommunity);
            }
            
            if (selectedCommunity && selectedCommunity.value != '') {
              const valueToSelect = selectedCommunity.value;
              communityList.value = valueToSelect;
            }
            
          })
          .catch(error => console.log(error));
    }

    if (communityList){
      getAllCCAA();
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

    if(QRContainerReader){
      let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
      html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    
      async function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        //console.log(`Code matched = ${decodedText}`, decodedResult);
        if (document.querySelector('meta[name="csrf-token"]').getAttribute('content')){
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          let response = await fetch('/reader',{
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
              'hash': decodedText
            })
          })
    
          let result = await response.json();
          console.log(result);
          if (result.status == "ok"){
            html5QrcodeScanner.pause()
            Swal.fire({
              title: "Entrada validada",
              icon: "success",
              draggable: true,
              heightAuto: false
            })
            .then((result) => {
              if (result.isConfirmed) {
                html5QrcodeScanner.resume()
              }
            });;
          }else if (result.status == "error" && result.data == "scanned"){
            html5QrcodeScanner.pause()
            Swal.fire({
              title: "Entrada inválida",
              icon: "error",
              html: `Este QR ya ha sido <b>escaneado</b>.`,
              draggable: true,
              heightAuto: false
            })
            .then((result) => {
              if (result.isConfirmed) {
                html5QrcodeScanner.resume()
              }
            });;
          }else{
            html5QrcodeScanner.pause()
            Swal.fire({
              title: "Entrada inválida",
              icon: "error",
              html: `La participación de este usuario no se tiene registrada, verifique el origen del QR.`,
              draggable: true,
              heightAuto: false
            })
            .then((result) => {
              if (result.isConfirmed) {
                html5QrcodeScanner.resume()
              }
            });;
          }
  
        }else{
          console.error("Fallo al obtener el token")
        }
      }
      
      function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
      }
    }

    
}

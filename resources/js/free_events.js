import Swal from 'sweetalert2';

const buyButton = document.querySelector('.eventCkeckout');

const showName = (event) => {
    event.preventDefault();
    let userName = event.target.dataset.userName;
    const baseUrl = event.currentTarget.href;

    Swal.fire({
        title: "Indique su nombre",
        input: "text",
        inputAttributes: {
            autocapitalize: "off"
        },
        inputValue: userName,
        showCancelButton: true,
        confirmButtonText: "Continuar",
        showLoaderOnConfirm: true,
        preConfirm: async (name) => {
            if (!name) {
                Swal.showValidationMessage('Debes indicar tu nombre');
            }
            return name;
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            const newUrl = `${baseUrl}?name=${encodeURIComponent(result.value)}`;
            window.location = newUrl;
        }
    });
}


if (buyButton){
    console.log('Si hay un evento gratuito');
    buyButton.addEventListener('click', showName)
}


 
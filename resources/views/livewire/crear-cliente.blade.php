<!-- component -->
<style>
    .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    .animated.faster {
        -webkit-animation-duration: 500ms;
        animation-duration: 500ms;
    }

    .fadeIn {
        -webkit-animation-name: fadeIn;
        animation-name: fadeIn;
    }

    .fadeOut {
        -webkit-animation-name: fadeOut;
        animation-name: fadeOut;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>

<div class="main-modal fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="border border-blue-500 shadow-lg modal-container bg-white w-4/12 md:max-w-11/12 mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6 w-4/5">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Agregar Cliente</p>
                <div class="modal-close cursor-pointer z-50" onclick="modalClose('main-modal')">
                    <svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <form  method="POST" id="add_caretaker_form"  class="w-full">
                    <div class="">
                        <div class="">
                            <label for="names" class="text-md text-gray-600">Nombre</label>
                        </div>
                        <div class="">
                            <input type="text" id="names" autocomplete="off" name="names" class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" placeholder="Example. STRACON S.A.">
                        </div>
                        <div class="">
                            <label for="dni_ruc" class="text-md text-gray-600">DNI_RUC</label>
                        </div>
                        <div class="">
                            <input type="text" id="dni_ruc" autocomplete="off" name="dni_ruc" class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" placeholder="Example. 0729400426">
                        </div>
                        <div class="">
                            <label for="direccion" class="text-md text-gray-600">Direccion</label>
                        </div>
                        <div class="">
                            <input type="text" id="direccion" autocomplete="off" name="direccion" class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" placeholder="Caretaker's ID number">
                        </div>
                        <div class="">
                            <label for="pagina_web" class="text-md text-gray-600">Pagina Web</label>
                        </div>
                        <div class="">
                            <input type="text" id="pagina_web" autocomplete="off" name="pagina_web" class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" placeholder="Caretaker's ID number">
                        </div>
                        
                    </div>
                </form>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2 space-x-14">
                <button
                    class="px-4 bg-gray-200 p-3 rounded text-black hover:bg-gray-300 font-semibold" wire:click="cerrarModal()">Cancel</button>
                <button
                    class="px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400" onclick="validate_form(document.getElementById('add_caretaker_form'))">Confirm</button>
            </div>
        </div>
    </div>
</div>


{{-- <script>
    all_modals = ['main-modal', 'another-modal']
    all_modals.forEach((modal)=>{
        const modalSelected = document.querySelector('.'+modal);
        modalSelected.classList.remove('fadeIn');
        modalSelected.classList.add('fadeOut');
        modalSelected.style.display = 'none';
    })
    const modalClose = (modal) => {
        const modalToClose = document.querySelector('.'+modal);
        modalToClose.classList.remove('fadeIn');
        modalToClose.classList.add('fadeOut');
        setTimeout(() => {
            modalToClose.style.display = 'none';
        }, 500);
    }

    const openModal = (modal) => {
        const modalToOpen = document.querySelector('.'+modal);
        modalToOpen.classList.remove('fadeOut');
        modalToOpen.classList.add('fadeIn');
        modalToOpen.style.display = 'flex';
    }

</script> --}}
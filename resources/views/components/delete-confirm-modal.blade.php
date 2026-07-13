<!-- Reusable Delete Confirmation Modal Component -->
<div id="global-delete-modal" class="hidden fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeGlobalDeleteModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal Card -->
        <div class="inline-block align-middle bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
            <div class="bg-white px-8 pt-8 pb-6">
                <div class="sm:flex sm:items-start gap-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-2xl bg-red-50 border border-red-100 text-red-600 sm:mx-0 sm:h-10 sm:w-10 text-lg">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-xl font-bold text-gray-900" id="global-delete-title">
                            Konfirmasi Hapus
                        </h3>
                        <p class="text-sm text-gray-500 mt-2" id="global-delete-message">
                            Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-8 py-4 sm:flex sm:flex-row-reverse gap-3 rounded-b-3xl">
                <button type="button" id="global-delete-confirm-btn"
                    class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-2xl transition font-semibold shadow-lg shadow-red-100 text-sm">
                    Ya, Hapus
                </button>
                <button type="button" onclick="closeGlobalDeleteModal()"
                    class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition font-semibold text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let formToSubmit = null;

    function openGlobalDeleteModal(formElement, title = 'Konfirmasi Hapus', message = 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.') {
        formToSubmit = formElement;
        document.getElementById('global-delete-title').innerText = title;
        document.getElementById('global-delete-message').innerText = message;
        document.getElementById('global-delete-modal').classList.remove('hidden');
    }

    function closeGlobalDeleteModal() {
        document.getElementById('global-delete-modal').classList.add('hidden');
        formToSubmit = null;
    }

    document.getElementById('global-delete-confirm-btn').addEventListener('click', function() {
        if (formToSubmit) {
            formToSubmit.submit();
        }
    });

    // Intercept all submit events for forms with delete-form class
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.classList.contains('delete-form')) {
            e.preventDefault();
            const title = form.getAttribute('data-title') || 'Konfirmasi Hapus';
            const message = form.getAttribute('data-message') || 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';
            openGlobalDeleteModal(form, title, message);
        }
    });
</script>

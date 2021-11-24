<x-admin-layout>

    <div class="container py-12">
        @livewire('admin.create-category')
    </div>

    @push('script')
        <script>
            Livewire.on('deleteCategory', categorySlug => {
                Swal.fire({
                    title: '¿Estás Seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, borrar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.create-category', 'delete', categorySlug)

                        Swal.fire(
                            '¡Eliminado!',
                            'La categoria ha sido eliminada.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush

</x-admin-layout>

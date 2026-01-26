<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            const Toast = Swal.mixin({
                //toast: true,
                position: 'top-end',
                showConfirmButton: false,
                //showCancelButton: true,
                //cancelButtonClass: "swal2-close",
                //cancelButtonText:'<span aria-hidden="true">×</span>',
                //cancelButtonColor: 'rgb(222 53 53)',
                //cancelButtonColor: "#ff3d60",
                timer: 3000
            });

            @foreach (['error', 'warning', 'success', 'info', 'question'] as $msg)
                @if(session()->has('alert-' . $msg))
                    Toast.fire({
                    icon: '{!! $msg !!}',
                    type: '{!! $msg !!}',
                    title: '{!! $msg !!}',
                    text: '{{ session()->get('alert-' . $msg) }}'
                    });
                @endif
            @endforeach
        });
    });
</script>
    <!-- plugins:js -->
    <script src="{{asset('template/vendors/js/vendor.bundle.base.js')}}"></script>

    <!-- Plugin js for this page -->
    <script src="{{asset('template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- inject:js -->
    <script src="{{asset('template/js/off-canvas.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('template/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('template/js/template.js')}}"></script>
    <script src="{{asset('template/js/settings.js')}}"></script>
    <script src="{{asset('template/js/todolist.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showconfirmButton: false,
            timer: 3000,
        })

        @if(Session::has('message'))
            var type = "{{Session::get('alert-type')}}";

            switch (type) {
                case 'info':
                    Toast.fire({
                        type: 'info',
                        title: '{{Session::get('message')}}'
                    })
                break;
                case 'success':
                    Toast.fire({
                        type: 'succses',
                        title: '{{Session::get('message')}}'
                    })
                break;
                case 'warning':
                    Toast.fire({
                        type: 'warning',
                        title: '{{Session::get('message')}}'
                    })
                break;
                case 'error':
                    Toast.fire({
                        type: 'error',
                        title: '{{Session::get('message')}}'
                    })
                break;
                case 'dialog_error':
                    Toast.fire({
                        type: 'succses',
                        title: "Ooops",
                        title: '{{Session::get('message')}}'
                    })
                break;
            }
        @endif

        @if ($errors->any())
            @foreach($errors->all() as $error)
                Swal.fire({
                    type: 'error',
                    title: "Ooops",
                    text: "{{ $error }}",
                })
            @endforeach
        @endif

        $('#table-data').DataTable();

        let baseurl = "<?=url('/')?>";
        let fullURL = "<?=url()->full()?>";
    </script>
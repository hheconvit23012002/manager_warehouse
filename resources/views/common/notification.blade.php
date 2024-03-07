<script>
    $(document).ready(function(){
        @if(session('success'))
            $.toast({
                heading: 'Success',
                text: 'Success!',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
                hideAfter: 3000
            })
        @elseif(session('error'))
            $.toast({
                heading: 'Error',
                text: "{{ session('error') }}",
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
                hideAfter: 3000
            })
        @endif
    })

</script>



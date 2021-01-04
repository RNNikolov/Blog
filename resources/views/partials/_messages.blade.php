@if (Session::has('postSuccess'))
    <script>
        Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: 'Your post has been published',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        })
    </script>
@elseif (Session::has('postUpdateSuccess'))
    <script>
        Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: 'Your post has been updated successfully',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        })
    </script>
@elseif (Session::has('postDeleteSuccess'))
    <script>
        Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: 'The post has been deleted successfully',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        })
    </script>
@elseif (Session::has('profileUpdateSuccess'))
    <script>
        Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: 'Your profile has been updated successfully',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        })
    </script>
@elseif (Session::has('userRoleUpdateSuccess'))
    <script>
        Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: 'The role of the user has been changed',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        })
    </script>
@elseif (Session::has('userDeleteSuccess'))
    <script>
        Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: 'The user has been deleted',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        })
    </script>
@endif

@if (count($errors) > 0)

    <div class="alert alert-danger" role="alert">
        <strong>Errors:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="alert alert-danger errors-section" style="display:none" role="alert">
    <strong>Errors:</strong>
    <ul class="errors-content">

    </ul>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Bohubrihi</title>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .admin-header{background:#fff;padding:12px 0;border-bottom:1px solid #eee}
        .admin-nav{display:flex;align-items:center;justify-content:space-between}
        .admin-container{max-width:1100px;margin:18px auto;padding:0 16px}
        .btn{display:inline-block;padding:8px 12px;background:#2980b9;color:#fff;text-decoration:none;border-radius:4px}
        .pagination{margin-top:18px}
        /* simple form styles */
        .form-group{margin-bottom:12px}
        .form-group label{display:block;margin-bottom:6px;font-weight:600}
        .form-control{width:100%;padding:8px;border:1px solid #ccc;border-radius:4px}
        .form-row{display:flex;gap:12px;flex-wrap:wrap}
        .col-4{width:calc(25% - 12px);box-sizing:border-box;margin-bottom:16px}
        @media(max-width:800px){.col-4{width:calc(50% - 12px)}}
        @media(max-width:480px){.col-4{width:100%}}
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="admin-container admin-nav">
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="logo" width="125"></a>
            </div>
            <nav>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ url('/account') }}" style="margin-left:12px;">Account</a>
            </nav>
        </div>
    </div>

    <main class="admin-container">
        @yield('content')
    </main>

    <footer style="margin-top:40px;padding:24px 0;border-top:1px solid #eee;text-align:center;">
        <div class="admin-container">&copy; {{ date('Y') }} Bohubrihi</div>
    </footer>

        <!-- Delete Confirm Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal (shown after create/update) -->
        @if(session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center py-4">
                        <div class="mb-2"><i class="fa fa-check-circle" style="font-size:28px;color:#28a745"></i></div>
                        <div>{{ session('success') }}</div>
                        <div class="mt-3"><button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">OK</button></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Bootstrap JS bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>
        <script>
                (function(){
                        var deleteFormToSubmit = null;
                        var confirmModalEl = document.getElementById('confirmDeleteModal');
                        var confirmModal = confirmModalEl ? new bootstrap.Modal(confirmModalEl) : null;
                        var confirmBtn = document.getElementById('confirmDeleteBtn');

                        document.addEventListener('click', function(e){
                                var target = e.target;
                                if(target && target.matches && target.matches('.btn-delete')){
                                        e.preventDefault();
                                        // find the enclosing form
                                        var form = target.closest('form');
                                        if(!form) return;
                                        deleteFormToSubmit = form;
                                        if(confirmModal) confirmModal.show();
                                }
                        });

                        if(confirmBtn){
                                confirmBtn.addEventListener('click', function(){
                                        if(deleteFormToSubmit){
                                                deleteFormToSubmit.submit();
                                        }
                                });
                        }

                        // show success modal if present
                        var successModalEl = document.getElementById('successModal');
                        if(successModalEl){
                                var successModal = new bootstrap.Modal(successModalEl);
                                successModal.show();
                        }
                })();
        </script>

</body>
</html>

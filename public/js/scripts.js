/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    document.getElementById('navbarDropdown').addEventListener('click', function () {
        this.blur();
    });
    
});

document.addEventListener('DOMContentLoaded', function () {
    const tabContainer = document.querySelector('.card');
    if (!tabContainer) return;

    const pageIdentifier = tabContainer.dataset.pageId;
    const tabs = tabContainer.querySelectorAll('[data-bs-toggle="tab"]');

    // Load last active tab from localStorage
    const lastTab = localStorage.getItem(`activeTab-${pageIdentifier}`);                                                                        
    if (lastTab) {
        const lastTabElement = document.querySelector(`[data-bs-target="${lastTab}"]`);
        if (lastTabElement) {
            const tab = new bootstrap.Tab(lastTabElement);
            tab.show();
        }
    }

    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (e) {
            localStorage.setItem(`activeTab-${pageIdentifier}`, e.target.getAttribute('data-bs-target'));
        });
    });
});
    
document.addEventListener('DOMContentLoaded', function() {
    if (window.sessionSuccessMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: window.sessionSuccessMessage,
            confirmButtonText: 'OK'
        });
    }
});

function confirmDelete(Id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${Id}`).submit();
        }
    });
}

function confirmDeleteUser(userId, deleteUrl) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Masukkan password Anda untuk menghapus pengguna ini",
        icon: 'warning',
        input: 'password',
        inputPlaceholder: 'Masukkan password Anda',
        inputAttributes: {
            autocapitalize: 'off',
            autocorrect: 'off'
        },
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: (password) => {
            if (!password) {
                Swal.showValidationMessage('Password harus diisi!')
                return false;
            }
            
            return fetch('/verify-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    throw new Error('Password salah!')
                }
                return data;
            })
            .catch(error => {
                Swal.showValidationMessage(error.message)
                return false;
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById(`delete-form-${userId}`);
            form.action = deleteUrl;
            form.submit();
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Toggle untuk password
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    
    togglePassword.addEventListener('click', function() {
        // Toggle tipe input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Toggle untuk konfirmasi password
    const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
    const passwordConfirmation = document.querySelector('#password_confirmation');
    
    togglePasswordConfirmation.addEventListener('click', function() {
        // Toggle tipe input
        const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmation.setAttribute('type', type);
        
        // Toggle icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});

// document.getElementById('showPassword').addEventListener('change', function() {
//     var passwordInput = document.getElementById('password');
//     passwordInput.type = this.checked ? 'text' : 'password';
// });


// JavaScript untuk memuat permissions dan menampilkan elemen secara dinamis
document.addEventListener('DOMContentLoaded', function () {
    // Fetch permissions dari endpoint Laravel
    fetch('/api/user-roles-permissions')
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch roles and permissions');
            }
            return response.json();
        })
        .then(data => {
            const userRoles = data.roles; // Roles pengguna
            // const userPermissions = data.permissions; // Permissions pengguna

            // Tampilkan elemen berdasarkan roles
            document.querySelectorAll('[data-role]').forEach(element => {
                const requiredRole = element.getAttribute('data-role');
                // if (userRoles.includes(requiredRole) || userRoles.includes('admin')) {
                if (userRoles.includes(requiredRole)) {
                    // Tampilkan elemen jika role cocok atau user adalah admin
                    element.style.display = 'flex';
                }
            });
        })
        .catch(error => {
            console.error('Error loading permissions:', error);
        });
});
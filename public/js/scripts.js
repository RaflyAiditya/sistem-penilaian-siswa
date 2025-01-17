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
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
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
    if (window.sessionInfoMessage) {
        Swal.fire({
                icon: 'info',
                title: 'Informasi!',
                text: window.sessionInfoMessage,
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
    // Mendapatkan data dari meta tag
    const unauthorizedMessage = document.querySelector('meta[name="unauthorized-message"]')?.content;
    
    if (unauthorizedMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak!',
            text: unauthorizedMessage,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
});

document.querySelectorAll('.delete-role').forEach(button => {
    button.addEventListener('click', function() {
        const roleId = this.dataset.roleId;
        const roleName = this.dataset.roleName;
        
        Swal.fire({
            title: 'Hapus Role?',
            text: `Anda yakin ingin menghapus role "${roleName}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Buat form untuk delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/users/roles/${roleId}`;
                
                // Ambil CSRF token dari meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Tambahkan CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                
                // Tambahkan method spoofing untuk DELETE
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                // Append semua input ke form
                form.appendChild(csrfInput);
                form.appendChild(methodField);
                
                // Append form ke document dan submit
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Data permission yang sudah ter-assign ke setiap role
    const rolePermissions = window.rolePermissions;
    
    const roleSelect = document.getElementById('roleSelect');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    
    roleSelect.addEventListener('change', function() {
        const roleId = this.value;
        
        // Reset semua checkbox
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Jika role dipilih, check permission yang sesuai
        if (roleId && rolePermissions[roleId]) {
            permissionCheckboxes.forEach(checkbox => {
                if (rolePermissions[roleId].includes(checkbox.value)) {
                    checkbox.checked = true;
                }
            });
        }
    });
});

document.getElementById('class').addEventListener('change', function() {
    const className = this.value;
    const container = document.getElementById('students-subjects-container');
    container.innerHTML = '';

    if (className) {
        // Ambil data siswa dan pelajaran dari server
        fetch(`/api/students-subjects?class=${className}`)
        .then(response => response.json())
        .then(data => {
            data.students.forEach(student => {
                data.subjects.forEach(subject => {
                    const inputGroup = document.createElement('div');
                    inputGroup.className = 'form-group';
                    inputGroup.innerHTML = `
                        <label>${student.name} - ${subject.name}</label>
                        <input type="number" name="grade_${student.id}_${subject.id}" class="form-control" min="0" max="100" value="0">
                    `;
                    container.appendChild(inputGroup);
                });
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk modal create
    const createCategoryType = document.getElementById('create_category_type');
    if (createCategoryType) {
        const createClassSelection = document.getElementById('create_class_selection');
        const createStudentSelection = document.getElementById('create_student_selection');
        // const createSubjectSelection = document.getElementById('create_subject_selection');
        const createClassSelect = createClassSelection.querySelector('select');
        const createStudentSelect = createStudentSelection.querySelector('select');
        // const createSubjectSelect = createSubjectSelection.querySelector('select');

        createCategoryType.addEventListener('change', function() {
            if (this.value === 'class') {
                createClassSelection.style.display = 'block';
                createStudentSelection.style.display = 'none';
                // createSubjectSelection.style.display = 'none';
                createStudentSelect.value = '';
                // createSubjectSelect.value = '';
                createClassSelect.required = true;
                createStudentSelect.required = false;
                // createSubjectSelect.required = false;

            } else if (this.value === 'student') {
                createClassSelection.style.display = 'none';
                createStudentSelection.style.display = 'block';
                // createSubjectSelection.style.display = 'none';
                createClassSelect.value = '';
                // createSubjectSelect.value = '';
                createClassSelect.required = false;
                createStudentSelect.required = true;
                // createSubjectSelect.required = false;

            // } else if (this.value === 'subject') {
            //     createClassSelection.style.display = 'none';
            //     createStudentSelection.style.display = 'none';
            //     createSubjectSelection.style.display = 'block';
            //     createClassSelect.value = '';
            //     createStudentSelect.value = '';
            //     createClassSelect.required = false;
            //     createStudentSelect.required = false;
            //     createSubjectSelect.required = true;

            } else {
                createClassSelection.style.display = 'none';
                createStudentSelection.style.display = 'none';
                // createSubjectSelection.style.display = 'none';
                createClassSelect.value = '';
                createStudentSelect.value = '';
                // createSubjectSelect.value = '';
                createClassSelect.required = false;
                createStudentSelect.required = false;
                // createSubjectSelect.required = false;
            }
        });

        createStudentSelect.addEventListener('change', function() {
            if (this.value !== '') {
                createClassSelect.value = '';
            }
        });

        createClassSelect.addEventListener('change', function() {
            if (this.value !== '') {
                createStudentSelect.value = '';
            }
        });

        // createSubjectSelect.addEventListener('change', function() {
        //     if (this.value !== '') {
        //         createSubjectSelect.value = '';
        //     }
        // });
    }

    // Fungsi untuk modal delete
    const deleteCategoryType = document.getElementById('delete_category_type');
    if (deleteCategoryType) {
        const deleteClassSelection = document.getElementById('delete_class_selection');
        const deleteStudentSelection = document.getElementById('delete_student_selection');
        const deleteClassSelect = deleteClassSelection.querySelector('select');
        const deleteStudentSelect = deleteStudentSelection.querySelector('select');

        deleteCategoryType.addEventListener('change', function() {
            if (this.value === 'class') {
                deleteClassSelection.style.display = 'block';
                deleteStudentSelection.style.display = 'none';
                deleteStudentSelect.value = '';
                deleteStudentSelect.required = false;
                deleteClassSelect.required = true;
            } else if (this.value === 'student') {
                deleteClassSelection.style.display = 'none';
                deleteStudentSelection.style.display = 'block';
                deleteClassSelect.value = '';
                deleteClassSelect.required = false;
                deleteStudentSelect.required = true;
            } else {
                deleteClassSelection.style.display = 'none';
                deleteStudentSelection.style.display = 'none';
                deleteClassSelect.value = '';
                deleteStudentSelect.value = '';
                deleteClassSelect.required = false;
                deleteStudentSelect.required = false;
            }
        });

        deleteStudentSelect.addEventListener('change', function() {
            if (this.value !== '') {
                deleteClassSelect.value = '';
            }
        });

        deleteClassSelect.addEventListener('change', function() {
            if (this.value !== '') {
                deleteStudentSelect.value = '';
            }
        });
    }
});

function sanitizeInput(input) {
    const value = input.value;
    const cursorPosition = input.selectionStart;

    // Replace non-numeric characters except for comma and dot
    const sanitizedValue = value.replace(/[^0-9.,]/g, '');

    // Replace comma with dot
    const newValue = sanitizedValue.replace(',', '.');

    // Update the input value
    input.value = newValue;

    // Restore the cursor position
    if (value !== newValue) {
        input.setSelectionRange(cursorPosition, cursorPosition);
    }
}
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

document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');

        // Load last active tab from localStorage
        const lastTab = localStorage.getItem('activeTab');
        if (lastTab) {
            const lastTabElement = document.querySelector(`[data-bs-target="${lastTab}"]`);
            if (lastTabElement) {
                const tab = new bootstrap.Tab(lastTabElement);
                tab.show();
            }
        }
    
        // Save the currently active tab to localStorage
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', e.target.getAttribute('data-bs-target'));
            });
        });
    
    
    // const tabs3 = document.querySelectorAll('[data-bs-toggle="tab3"]');

    //     // Load last active tab from localStorage
    //     const lastTab3 = localStorage.getItem('activeTab');
    //     if (lastTab3) {
    //         const lastTabElement = document.querySelector(`[data-bs-target="${lastTab3}"]`);
    //         if (lastTabElement) {
    //             const tab = new bootstrap.Tab(lastTabElement);
    //             tab.show();
    //         }
    //     }
    
    //     // Save the currently active tab to localStorage
    //     tabs3.forEach(tab => {
    //         tab.addEventListener('shown.bs.tab', function (e) {
    //             localStorage.setItem('activeTab', e.target.getAttribute('data-bs-target'));
    //         });
    //     })


    });
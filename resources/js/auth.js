document.addEventListener("DOMContentLoaded", function() {
    const authToken = localStorage.getItem('auth_token');
    const userName = localStorage.getItem('user_name');

    const authDivs = document.querySelectorAll('.auth');
    const notAuthDivs = document.querySelectorAll('.not_show');

    if (authToken) {
        authDivs.forEach(div => div.style.display = 'block');
        notAuthDivs.forEach(div => div.style.display = 'none');
    } else {
        authDivs.forEach(div => div.style.display = 'none');
        notAuthDivs.forEach(div => div.style.display = 'block');
    }

    const listUsersContainer = document.getElementById('listUsers');

    if (listUsersContainer) {
        listUsers();
        showHome();
    }

    function showLoading() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').style.display = 'none';
    }

    async function postData(url = '', data = {}) {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${authToken}`
            },
            body: JSON.stringify(data)
        });

        return response.json();
    }

    function handleResponse(data) {
        const alertPlaceholder = document.getElementById('alertPlaceholder');

        hideLoading()

        if (data.error) {
            showAlert('danger', data.error);
        }else if (data.errors) {
            showAlert('danger', data.message);
        }else if (data.message) {
            showAlert('success', data.message);
            if (data.access_token) {
                localStorage.setItem('auth_token', data.access_token);
                localStorage.setItem('user_name', data.user_name);
            }

            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 2000);
            }
        }

        function showAlert(type, message) {
            const alertHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;

            alertPlaceholder.innerHTML = alertHTML;
            window.scrollTo(0, 0);

            setTimeout(() => {
                const alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('hide');
                    setTimeout(() => alert.remove(), 500);
                }
            }, 10000);
        }

    }

    async function registerUser(formData) {
        showLoading();
        try {
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                password: formData.get('password'),
                password_confirmation: formData.get('password_confirmation'),
                street: formData.get('street'),
                district: formData.get('neighborhood'),
                street_number: formData.get('number'),
                city: formData.get('city'),
                state: formData.get('state'),
                zip_code: formData.get('cep')
            };

            const response = await postData('/api/register', data);
            handleResponse(response);
        } finally {
            hideLoading()
        }
    }

    async function lookupCep(cep) {
        try {
            if (cep.length !== 8) {
                return;
            }

            showLoading();
            const response = await postData(`/api/search-cep`, { zip_code: cep });

            if (response.error) {
                handleResponse(response);
            } else {
                document.getElementById('street').value = response.logradouro;
                document.getElementById('neighborhood').value = response.bairro;
                document.getElementById('city').value = response.localidade;
                document.getElementById('state').value = response.uf;
            }
        } finally {
            hideLoading()
        }
    }

    async function logoutUser() {
        const response = await postData('/api/logout', {});
        handleResponse(response);
    }

    async function loginUser(formData) {
        showLoading();
        try {
            const data = {
                email: formData.get('email'),
                password: formData.get('password')
            };

            const response = await postData('/api/login', data);
            handleResponse(response);
        } finally {
            hideLoading()
        }
    }

    async function requestPasswordReset(formData) {
        showLoading();
        const data = {
            email: formData.get('email')
        };

        const response = await postData('/api/password/email', data);
        handleResponse(response);
    }

    async function resetPassword(formData) {
        showLoading();
        const data = {
            token: formData.get('token'),
            email: formData.get('email'),
            password: formData.get('password'),
            password_confirmation: formData.get('password_confirmation')
        };

        const response = await postData('/api/password/reset', data);
        handleResponse(response);
    }

    async function listUsers() {
        showLoading();
        try {
            const response = await fetch('/api/list-users', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${authToken}`
                }
            });
            listUsersContainer.innerHTML = '';

            const data = await response.json();

            if (data.users) {
                let usersList = '';
                data.users.forEach(user => {
                    usersList += `<div class="col-md-3"><div class="card"><div class="card-body">
                        <h5 class="card-title">${user.name}</h5>
                        <p class="card-text">${user.city}, ${user.state}</p>
                        </div><ul class="list-group list-group-flush">
                        <li class="list-group-item">${user.email}</li>
                        <li class="list-group-item">${user.created}</li>
                        </ul>
                        <div class="card-body"><a href="#" class="btn btn-danger btn-sm">Remover</a>
                        <a href="#" class="btn btn-info btn-sm">Editar</a>
                    </div></div></div></li>`;
                });
                listUsersContainer.innerHTML = usersList;
            } else {
                handleResponse(data);
            }
        } finally {
            hideLoading()
        }
    }

    function showHome() {
        if (userName && authToken) {
            document.querySelector('.display-name').textContent = `Bem-vindo, ${userName}`;
        }else{
            setTimeout(() => {
                window.location.href = '/login';
            }, 1000);
        }
    }

    if (document.getElementById('registerForm')) {
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            registerUser(new FormData(this));
        });
    }

    if (document.getElementById('loginForm')) {
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            loginUser(new FormData(this));
        });
    }

    if (document.getElementById('logoutBtn')) {
        document.getElementById('logoutBtn').addEventListener('click', function(e) {
            e.preventDefault();
            logoutUser();
        });
    }

    if (document.getElementById('cep')) {
        document.getElementById('cep').addEventListener('blur', function(e) {
            const cep = e.target.value.replace(/\D/g, '');
            lookupCep(cep);
        });
    }

    if (document.getElementById('forgotPasswordForm')) {
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            requestPasswordReset(new FormData(this));
        });
    }

    if (document.getElementById('resetPasswordForm')) {
        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            resetPassword(new FormData(this));
        });
    }
});

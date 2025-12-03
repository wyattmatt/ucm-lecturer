@extends('admin.layout')

@section('title', 'User Management')
@section('page-title', 'User Management')
@section('page-description', 'Create, edit, and manage admin users')

@section('content')
<!-- Header with Add Button -->
<div class="mb-8 flex justify-between items-center">
    <button onclick="openModal()" class="bg-[#1c3a6b] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#16325c] transition duration-200 shadow-lg">
        <i class="bi bi-plus-circle mr-2"></i>
        Add New User
    </button>
</div>

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table id="usersTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody id="usersTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Users will be loaded here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Empty State -->
<div id="emptyState" class="text-center py-12 hidden">
    <i class="bi bi-people text-gray-400" style="font-size: 6rem;"></i>
    <h3 class="mt-4 text-xl font-semibold text-gray-900">No Users Yet</h3>
    <p class="text-gray-600 mt-2">Get started by adding your first admin user</p>
</div>

<!-- User Modal -->
<div id="userModal" class="modal fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto m-4">
        <div class="bg-[#1c3a6b] p-6 text-white">
            <h3 id="modalTitle" class="text-2xl font-bold">Add New User</h3>
        </div>

        <form id="userForm" class="p-6 space-y-4">
            <input type="hidden" id="userId" name="user_id">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Name *</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Password <span id="passwordRequired">*</span>
                </label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1" id="passwordHelp">Minimum 8 characters</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role *</label>
                <select id="role" name="role" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super Admin</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <button type="submit" id="submitBtn" class="px-6 py-2 bg-[#1c3a6b] text-white rounded-lg hover:bg-[#16325c] transition duration-200">
                    Save User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let users = [];
    const currentUserId = {{ auth()->id() }};

    document.addEventListener('DOMContentLoaded', function() {
        loadUsers();
    });

    async function loadUsers() {
        try {
            const response = await fetch('/api/users', {
                credentials: 'same-origin'
            });
            const data = await response.json();
            users = data.data || data;
            renderUsers();
        } catch (error) {
            console.error('Error loading users:', error);
        }
    }

    function renderUsers() {
        const tableBody = document.getElementById('usersTableBody');
        const emptyState = document.getElementById('emptyState');
        const table = document.getElementById('usersTable').closest('.bg-white');

        if (users.length === 0) {
            table.classList.add('hidden');
            emptyState.classList.remove('hidden');
            return;
        }

        table.classList.remove('hidden');
        emptyState.classList.add('hidden');

        tableBody.innerHTML = users.map(user => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-400 to-purple-400 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold">${user.name.charAt(0).toUpperCase()}</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">${user.name}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${user.email}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${user.role === 'superadmin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800'}">
                        ${user.role === 'superadmin' ? 'Super Admin' : 'Admin'}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${formatDate(user.created_at)}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button onclick="editUser(${user.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    ${user.id !== currentUserId ? `
                        <button onclick="deleteUser(${user.id})" class="text-red-600 hover:text-red-900">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    ` : `
                        <span class="text-gray-400 cursor-not-allowed" title="Cannot delete yourself">
                            <i class="bi bi-trash"></i> Delete
                        </span>
                    `}
                </td>
            </tr>
        `).join('');
    }

    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }

    function openModal(userId = null) {
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');
        const modalTitle = document.getElementById('modalTitle');
        const passwordField = document.getElementById('password');
        const passwordRequired = document.getElementById('passwordRequired');
        const passwordHelp = document.getElementById('passwordHelp');
        const bottomNav = document.querySelector('.lg\\:hidden.fixed.bottom-0');

        if (bottomNav) bottomNav.style.display = 'none';

        form.reset();

        if (userId) {
            const user = users.find(u => u.id === userId);
            if (user) {
                modalTitle.textContent = 'Edit User';
                document.getElementById('userId').value = user.id;
                document.getElementById('name').value = user.name;
                document.getElementById('email').value = user.email;
                document.getElementById('role').value = user.role;

                // Password not required for edit
                passwordField.removeAttribute('required');
                passwordRequired.textContent = '(optional)';
                passwordHelp.textContent = 'Leave empty to keep current password';
            }
        } else {
            modalTitle.textContent = 'Add New User';
            document.getElementById('userId').value = '';

            // Password required for new user
            passwordField.setAttribute('required', 'required');
            passwordRequired.textContent = '*';
            passwordHelp.textContent = 'Minimum 8 characters';
        }

        modal.style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('userModal').style.display = 'none';
        const bottomNav = document.querySelector('.lg\\:hidden.fixed.bottom-0');
        if (bottomNav) bottomNav.style.display = '';
    }

    function editUser(id) {
        openModal(id);
    }

    async function deleteUser(id) {
        if (id === currentUserId) {
            Swal.fire('Error!', 'You cannot delete yourself.', 'error');
            return;
        }

        const result = await Swal.fire({
            title: 'Are you sure?',
            text: "This user will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        });

        if (!result.isConfirmed) return;

        try {
            const response = await fetch(`/api/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire('Deleted!', 'User has been deleted.', 'success');
                loadUsers();
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            Swal.fire('Error!', 'Failed to delete user.', 'error');
        }
    }

    document.getElementById('userForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-arrow-repeat animate-spin"></i>';
        submitBtn.disabled = true;

        const formData = new FormData(this);
        const userId = document.getElementById('userId').value;
        const url = userId ? `/api/users/${userId}` : '/api/users';
        const method = 'POST';

        if (userId) {
            formData.append('_method', 'PUT');
        }

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                closeModal();
                loadUsers();
            } else {
                throw new Error(data.message || 'Something went wrong');
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message || 'Failed to save user'
            });
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
</script>
@endsection

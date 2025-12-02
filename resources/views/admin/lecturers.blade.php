@extends('admin.layout')

@section('title', 'Lecturer Management')
@section('page-title', 'Lecturer Management')
@section('page-description', 'Create, edit, and manage all lecturers')

@section('content')
<!-- Header with Add Button -->
<div class="mb-8 flex justify-between items-center">
    <button onclick="openModal()" class="bg-[#1c3a6b] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#16325c] transition duration-200 shadow-lg">
        <i class="bi bi-plus-circle mr-2"></i>
        Add New Lecturer
    </button>
</div>

<!-- Lecturers Grid -->
<div id="lecturersGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Lecturers will be loaded here -->
</div>

<!-- Empty State -->
<div id="emptyState" class="text-center py-12 hidden">
    <i class="bi bi-person-badge text-gray-400" style="font-size: 6rem;"></i>
    <h3 class="mt-4 text-xl font-semibold text-gray-900">No Lecturers Yet</h3>
    <p class="text-gray-600 mt-2">Get started by adding your first lecturer</p>
</div>

<!-- Lecturer Modal -->
<div id="lecturerModal" class="modal fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto m-4">
        <div class="bg-[#1c3a6b] p-6 text-white">
            <h3 id="modalTitle" class="text-2xl font-bold">Add New Lecturer</h3>
        </div>

        <form id="lecturerForm" class="p-6 space-y-4">
            <input type="hidden" id="lecturerId" name="lecturer_id">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Name *</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                <input type="text" id="title" name="title" required placeholder="e.g., Dr., Prof., M.Kom., etc."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Room</label>
                <input type="text" id="room" name="room" placeholder="e.g., 301, 402, etc."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Departments *</label>
                <div class="space-y-2 p-4 border border-gray-300 rounded-lg">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="departments[]" value="Management" class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm">Management</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="departments[]" value="Visual Communication Design" class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm">Visual Communication Design</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="departments[]" value="Informatics" class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm">Informatics</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="departments[]" value="Magister Management" class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm">Magister Management</span>
                    </label>
                </div>
                <p class="text-xs text-gray-500 mt-1">Select at least one department</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Profile Image</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Max 2MB, JPG/PNG</p>
                <div id="imagePreview" class="mt-2 hidden">
                    <img id="previewImg" class="h-32 w-32 rounded-full object-cover">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <button type="submit" id="submitBtn" class="px-6 py-2 bg-[#1c3a6b] text-white rounded-lg hover:bg-[#16325c] transition duration-200">
                    Save Lecturer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let lecturers = [];

    document.addEventListener('DOMContentLoaded', function() {
        loadLecturers();

        // Image preview
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                // Clear preview if no file selected
                document.getElementById('imagePreview').classList.add('hidden');
            }
        });
    });

    async function loadLecturers() {
        try {
            const response = await fetch('/api/public/lecturers', {
                credentials: 'same-origin'
            });
            const data = await response.json();
            lecturers = data.data || data;
            renderLecturers();
        } catch (error) {
            console.error('Error loading lecturers:', error);
        }
    }

    function renderLecturers() {
        const grid = document.getElementById('lecturersGrid');
        const emptyState = document.getElementById('emptyState');

        if (lecturers.length === 0) {
            grid.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }

        emptyState.classList.add('hidden');
        grid.innerHTML = lecturers.map(lecturer => `
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <div class="p-6">
                    <div class="flex justify-center mb-4">
                        <img src="${lecturer.image_url || '{{ asset('images/placeholder.png') }}'}"
                             alt="${lecturer.name}"
                             class="w-32 h-32 rounded-full object-cover"
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1 text-center">${lecturer.name}</h3>
                    <p class="text-gray-600 text-sm mb-2 text-center">${lecturer.title}</p>
                    ${lecturer.room ? `
                        <div class="flex items-center justify-center text-sm text-gray-600 mb-3">
                            <i class="bi bi-door-open mr-2"></i>
                            <span>Room ${lecturer.room}</span>
                        </div>
                    ` : ''}

                    <div class="mb-4">
                        <p class="text-xs font-semibold text-gray-500 mb-2">Departments:</p>
                        <div class="flex flex-wrap gap-1">
                            ${Array.isArray(lecturer.departments) ? lecturer.departments.map(dept => `
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">${dept}</span>
                            `).join('') : ''}
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <button onclick="editLecturer(${lecturer.id})" class="flex-1 bg-[#1c3a6b] text-white px-4 py-2 rounded-lg hover:bg-[#16325c] transition duration-200 text-sm font-semibold">
                            <i class="bi bi-pencil-square mr-1"></i> Edit
                        </button>
                        <button onclick="deleteLecturer(${lecturer.id})" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm font-semibold">
                            <i class="bi bi-trash mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function openModal(lecturerId = null) {
        const modal = document.getElementById('lecturerModal');
        const form = document.getElementById('lecturerForm');
        const modalTitle = document.getElementById('modalTitle');
        const bottomNav = document.querySelector('.lg\\:hidden.fixed.bottom-0');

        if (bottomNav) bottomNav.style.display = 'none';

        form.reset();
        document.getElementById('imagePreview').classList.add('hidden');

        // Clear file input completely
        const imageInput = document.getElementById('image');
        imageInput.value = '';

        // Uncheck all departments
        document.querySelectorAll('input[name="departments[]"]').forEach(cb => cb.checked = false);

        if (lecturerId) {
            const lecturer = lecturers.find(l => l.id === lecturerId);
            if (lecturer) {
                modalTitle.textContent = 'Edit Lecturer';
                document.getElementById('lecturerId').value = lecturer.id;
                document.getElementById('name').value = lecturer.name;
                document.getElementById('title').value = lecturer.title;
                document.getElementById('room').value = lecturer.room || '';

                // Check departments - map full names to checkbox values
                if (Array.isArray(lecturer.departments)) {
                    const deptMapping = {
                        'Management': 'Management',
                        'Visual Communication Design': 'Visual Communication Design',
                        'Informatics': 'Informatics',
                        'Magister Management': 'Magister Management'
                    };

                    lecturer.departments.forEach(dept => {
                        const mappedValue = deptMapping[dept] || dept;
                        const checkbox = document.querySelector(`input[name="departments[]"][value="${mappedValue}"]`);
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });
                }

                if (lecturer.image_url) {
                    document.getElementById('previewImg').src = lecturer.image_url;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
            }
        } else {
            modalTitle.textContent = 'Add New Lecturer';
            document.getElementById('lecturerId').value = '';
        }

        modal.style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('lecturerModal').style.display = 'none';
        const bottomNav = document.querySelector('.lg\\:hidden.fixed.bottom-0');
        if (bottomNav) bottomNav.style.display = '';
    }

    function editLecturer(id) {
        openModal(id);
    }

    async function deleteLecturer(id) {
        const result = await Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        });

        if (!result.isConfirmed) return;

        try {
            const response = await fetch(`/api/lecturers/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire('Deleted!', 'Lecturer has been deleted.', 'success');
                loadLecturers();
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            Swal.fire('Error!', 'Failed to delete lecturer.', 'error');
        }
    }

    document.getElementById('lecturerForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validate at least one department is selected
        const checkedDepartments = document.querySelectorAll('input[name="departments[]"]:checked');
        if (checkedDepartments.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please select at least one department'
            });
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        submitBtn.disabled = true;

        const formData = new FormData();
        const lecturerId = document.getElementById('lecturerId').value;

        // Add form fields
        formData.append('name', document.getElementById('name').value);
        formData.append('title', document.getElementById('title').value);
        formData.append('room', document.getElementById('room').value);

        // Add departments
        const checkedDepts = document.querySelectorAll('input[name="departments[]"]:checked');
        checkedDepts.forEach(cb => formData.append('departments[]', cb.value));

        // Only add image if a new file is actually selected
        const imageInput = document.getElementById('image');
        const hasValidFile = imageInput.files &&
                            imageInput.files.length > 0 &&
                            imageInput.files[0] &&
                            imageInput.files[0].size > 0 &&
                            imageInput.files[0].name !== '';

        if (hasValidFile) {
            formData.append('image', imageInput.files[0]);
        }

        const url = lecturerId ? `/api/lecturers/${lecturerId}` : '/api/lecturers';
        const method = 'POST';

        if (lecturerId) {
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
                loadLecturers();
            } else {
                const error = new Error(data.message || 'Something went wrong');
                error.response = data;
                throw error;
            }
        } catch (error) {
            let errorMessage = error.message || 'Failed to save lecturer';

            // Check if response has validation errors
            if (error.response && error.response.errors) {
                const errors = Object.values(error.response.errors).flat();
                errorMessage = errors.join('\n');
            }

            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage
            });
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
</script>
@endsection

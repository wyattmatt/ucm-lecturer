@extends('admin.layout')

@section('title', 'Event Management')
@section('page-title', 'Event Management')
@section('page-description', 'Create, edit, and manage all events')

@section('content')
<!-- Header with Add Button -->
<div class="mb-8 flex justify-between items-center">
    <button onclick="openModal()" class="bg-[#1c3a6b] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#16325c] transition duration-200 shadow-lg">
        <i class="bi bi-plus-circle mr-2"></i>
        Add New Event
    </button>
</div>

<!-- Events Grid -->
<div id="eventsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Events will be loaded here -->
</div>

<!-- Empty State -->
<div id="emptyState" class="text-center py-12 hidden">
    <i class="bi bi-calendar-event text-gray-400" style="font-size: 6rem;"></i>
    <h3 class="mt-4 text-xl font-semibold text-gray-900">No Events Yet</h3>
    <p class="text-gray-600 mt-2">Get started by creating your first event</p>
</div>

<!-- Event Modal -->
<div id="eventModal" class="modal fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto m-4">
        <div class="bg-[#1c3a6b] p-6 text-white">
            <h3 id="modalTitle" class="text-2xl font-bold">Add New Event</h3>
        </div>

        <form id="eventForm" class="p-6 space-y-4">
            <input type="hidden" id="eventId" name="event_id">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                <input type="text" id="title" name="title" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Event Image</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Max 2MB, JPG/PNG/GIF</p>
                <div id="imagePreview" class="mt-2 hidden">
                    <img id="previewImg" class="h-32 rounded-lg object-cover">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="4" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date *</label>
                    <input type="date" id="start_date" name="start_date" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Start Time *</label>
                    <input type="time" id="start_time" name="start_time" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">End Date *</label>
                    <input type="date" id="end_date" name="end_date" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">End Time *</label>
                    <input type="time" id="end_time" name="end_time" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <button type="submit" id="submitBtn" class="px-6 py-2 bg-[#1c3a6b] text-white rounded-lg hover:bg-[#16325c] transition duration-200">
                    Save Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let events = [];

    // Load events on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadEvents();

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
            }
        });
    });

    async function loadEvents() {
        try {
            const response = await fetch('/api/public/events', {
                credentials: 'same-origin'
            });
            const data = await response.json();
            events = data.data || data;
            renderEvents();
        } catch (error) {
            console.error('Error loading events:', error);
        }
    }

    function renderEvents() {
        const grid = document.getElementById('eventsGrid');
        const emptyState = document.getElementById('emptyState');

        if (events.length === 0) {
            grid.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }

        emptyState.classList.add('hidden');
        grid.innerHTML = events.map(event => `
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                ${event.image_url ? `
                    <img src="${event.image_url}" alt="${event.title}" class="w-full h-48 object-cover">
                ` : `
                    <div class="w-full h-48 bg-gradient-to-br from-[#1c3a6b] to-[#0c7c5d] text-white flex items-center justify-center">
                        <i class="bi bi-calendar-event text-white" style="font-size: 5rem;"></i>
                    </div>
                `}
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">${event.title}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">${event.description}</p>

                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                        <div class="flex items-center">
                            <i class="bi bi-calendar-date mr-2"></i>
                            <span>${formatDate(event.start_date)} - ${formatDate(event.end_date)}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-clock mr-2"></i>
                            <span>${event.start_time} - ${event.end_time}</span>
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <button onclick="editEvent(${event.id})" class="flex-1 bg-[#1c3a6b] text-white px-4 py-2 rounded-lg hover:bg-[#16325c] transition duration-200 text-sm font-semibold">
                            <i class="bi bi-pencil-square mr-1"></i> Edit
                        </button>
                        <button onclick="deleteEvent(${event.id})" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm font-semibold">
                            <i class="bi bi-trash mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }

    function openModal(eventId = null) {
        const modal = document.getElementById('eventModal');
        const form = document.getElementById('eventForm');
        const modalTitle = document.getElementById('modalTitle');
        const bottomNav = document.querySelector('.lg\\:hidden.fixed.bottom-0');

        if (bottomNav) bottomNav.style.display = 'none';

        form.reset();
        document.getElementById('imagePreview').classList.add('hidden');

        if (eventId) {
            const event = events.find(e => e.id === eventId);
            if (event) {
                modalTitle.textContent = 'Edit Event';
                document.getElementById('eventId').value = event.id;
                document.getElementById('title').value = event.title;
                document.getElementById('description').value = event.description;
                document.getElementById('start_date').value = event.start_date;
                document.getElementById('start_time').value = event.start_time;
                document.getElementById('end_date').value = event.end_date;
                document.getElementById('end_time').value = event.end_time;

                if (event.image_url) {
                    document.getElementById('previewImg').src = event.image_url;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
            }
        } else {
            modalTitle.textContent = 'Add New Event';
            document.getElementById('eventId').value = '';
        }

        modal.style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('eventModal').style.display = 'none';
        const bottomNav = document.querySelector('.lg\\:hidden.fixed.bottom-0');
        if (bottomNav) bottomNav.style.display = '';
    }

    function editEvent(id) {
        openModal(id);
    }

    async function deleteEvent(id) {
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
            const response = await fetch(`/api/events/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire('Deleted!', 'Event has been deleted.', 'success');
                loadEvents();
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            Swal.fire('Error!', 'Failed to delete event.', 'error');
        }
    }

    document.getElementById('eventForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-arrow-repeat animate-spin"></i>';
        submitBtn.disabled = true;

        const formData = new FormData(this);
        const eventId = document.getElementById('eventId').value;
        const url = eventId ? `/api/events/${eventId}` : '/api/events';
        const method = 'POST';

        if (eventId) {
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
                loadEvents();
            } else {
                throw new Error(data.message || 'Something went wrong');
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message || 'Failed to save event'
            });
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
</script>
@endsection

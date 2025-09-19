<x-layout>
    @php
        $adminRole = \App\UserRoles::Admin->value;
        $userRole = \App\UserRoles::User->value;
        $activeStatus = \App\UserStatus::Active;
        $disabledStatus = \App\UserStatus::Disabled;
        $currentUser = Auth::user();
    @endphp
    <div class="container">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-start gap-6">
              <a href="{{route('user.show')}}" class="badge badge-soft hover:underline">Your Profile</a>
              <p class="badge badge-soft badge-info">Total Users: {{ $users->total() }}</p>
        </div>
        <!-- Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-bold">Users</h1>

            <!-- Search + Filter -->
            <form method="GET" action="{{ route('user.index') }}" class="mt-4 flex flex-wrap gap-2 sm:mt-0">
                <!-- Search -->
                <input type="text" name="search_key" placeholder="Search by name or email"
                    value="{{ request('search_key') }}" class="input input-bordered w-full sm:w-64" />

                <!-- Role Filter -->
                <select name="role" class="select select-bordered w-full sm:w-40">
                    <option value="">All Roles</option>
                    <option value="{{ $adminRole }}" {{ request('role') == $adminRole ? 'selected' : '' }}>Admin
                    </option>
                    <option value="{{ $userRole }}" {{ request('role') == $userRole ? 'selected' : '' }}>User
                    </option>
                </select>

                <!-- Status Filter -->
                <select name="status" class="select select-bordered w-full sm:w-40">
                    <option value="">Status</option>
                    <option value="{{ $activeStatus->value }}"
                        {{ request('status') === $activeStatus->value ? 'selected' : '' }}>{{ $activeStatus->name }}
                    </option>
                    <option value="{{ $disabledStatus->value }}"
                        {{ request('status') === $disabledStatus->value ? 'selected' : '' }}>
                        {{ $disabledStatus->name }}
                    </option>
                </select>

                <!-- Sort -->
                <select name="sort" class="select select-bordered w-full sm:w-40">
                    <option value="">Sort By</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="role" {{ request('sort') == 'role' ? 'selected' : '' }}>Role</option>
                </select>

                <x-button class="btn-primary" type="submit">Apply</x-button>
            </form>
        </div>
        <!-- Users Table -->
        <div class="rounded-box border-base-content/5 overflow-x-auto border">
            <table class="table-zebra table w-full">
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Role</th>
                        <th class="text-left">Status</th>
                        @canany(['delete', 'disable'], $currentUser)
                            <th class="text-center">Actions</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="font-medium">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span
                                    class="badge badge-soft {{ $user->role == $adminRole ? 'badge-accent' : 'badge-info' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <span
                                    class="status-badge badge badge-soft {{ $user->isActive ? 'badge-primary' : 'badge-warning' }}">
                                    {{ ucfirst($user->isActive ? 'Active' : 'Disabled') }}
                                </span>
                            </td>
                            <td class="flex justify-end gap-2">
                                @if ($user->isActive)
                                    <!-- Deactivate -->
                                    @can('disable', $currentUser)
                                        <x-button
                                            class="btn-warning"
                                            onclick="toggleActivationUser(this, '{{ route('user.deactivate', ['id' => $user->id]) }}')">
                                            Deactivate
                                        </x-button>
                                    @endcan
                                @else
                                    <!-- Activate -->
                                    @can('activate', $currentUser)
                                        <x-button
                                            class="btn-primary"
                                            onclick="toggleActivationUser(this, '{{ route('user.activate', ['id' => $user->id]) }}')">
                                            Activate
                                        </x-button>
                                    @endcan
                                @endif
                                @can('delete', $currentUser)
                                    <!-- Delete -->
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-button class="btn-error">Delete</x-button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>

    </div>

    @include('components.toastify')
    <script>
    async function toggleActivationUser(buttonElement, url) {
        const spinner = buttonElement.querySelector('.loading-spinner');
        const btnText = buttonElement.querySelector('.button-text')
        showSpinner(spinner);
        buttonElement.disabled = true;

        // Find the badge element in the same row
        const row = buttonElement.closest('tr');
        const badge = row.querySelector('.status-badge');

        try {
            const response = await axios.patch(url);
            const data = response.data;
            if (data.success) {
                showSuccessToast(response.data.message);

                // Toggle button text and class
                if (buttonElement.textContent.trim() === 'Deactivate') {
                    // Update badge text and class
                    badge.textContent = 'Disabled';
                    badge.classList.remove('badge-primary');
                    badge.classList.add('badge-warning');

                    // Check if user has privilage to do alternate action
                    if(data.canActivate){
                        const newUrl  = data.url;
                        btnText.textContent = 'Activate';
                        buttonElement.classList.remove('btn-warning');
                        buttonElement.classList.add('btn-primary');
                        buttonElement.setAttribute('onclick', `toggleActivationUser(this, '${newUrl}')`);
                        buttonElement.disabled = false;
                    }
                } else {
                    // Update badge text and class
                    badge.textContent = 'Active';
                    badge.classList.remove('badge-warning');
                    badge.classList.add('badge-primary');

                    // Check if user has privilage to do alternate action
                    if(data.canDisable){
                        const newUrl  = data.url;
                        btnText.textContent = 'Deactivate';
                        buttonElement.classList.remove('btn-primary');
                        buttonElement.classList.add('btn-warning');
                        buttonElement.setAttribute('onclick', `toggleActivationUser(this, '${newUrl}')`);
                        buttonElement.disabled = false;
                    }
                }
            } else {
                showErrorToast(response.data.message);
            }
        } catch (error) {
            console.error(error);
            showErrorToast('Unknown error occurred');
        } finally {
            hideSpinner(spinner);
        }
    }




        function showSpinner(spinnerElement) {
            spinnerElement.classList.remove('hidden');
        }

        function hideSpinner(spinnerElement) {
            spinnerElement.classList.add('hidden');
        }
    </script>
</x-layout>

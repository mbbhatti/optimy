<div id="profile-information" class="content-section">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Profile Information</h5>
            <button id="editProfileBtn" class="btn btn-primary">Edit</button>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> <span id="profileName">{{ Auth::user()->name }}</span></p>
            <p><strong>Email:</strong> <span id="profileEmail">{{ Auth::user()->email }}</span></p>
        </div>
    </div>

    <div id="editProfileForm" style="display: none;">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Edit Profile</h5>
                <button id="cancelEditBtn" class="btn btn-secondary">Cancel</button>
            </div>
            <div class="card-body">
                <form id="updateProfileForm" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="editName" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control" value="{{ Auth::user()->email }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editProfileBtn = document.getElementById('editProfileBtn');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const profileInfo = document.getElementById('profile-information');
        const viewSection = profileInfo.querySelector('.card-body');
        const editSection = document.getElementById('editProfileForm');

        editProfileBtn.addEventListener('click', function () {
            viewSection.style.display = 'none';
            editSection.style.display = 'block';
        });

        cancelEditBtn.addEventListener('click', function () {
            viewSection.style.display = 'block';
            editSection.style.display = 'none';
        });
    });
</script>

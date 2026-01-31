@extends('layouts.blogger')

@section('blogcontent')
<div class="container py-5">
    <div class="row justify-content-center">
        {{-- ACCOUNT SETTINGS --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Account Settings</h4>

                    <form method="POST"
                          action="{{ auth()->user()->role === 'admin'
                                ? route('blogger.profile.account')
                                : route('blogger.profile.account') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text"
                                   class="form-control"
                                   name="name"
                                   value="{{ auth()->user()->name }}"
                                   required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ auth()->user()->email }}"
                                   required>
                        </div>

                        {{-- Focus (read-only) --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Focus</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ ucwords(str_replace('-', ' ', auth()->user()->focus ?? 'Not selected')) }}"
                                   readonly>
                        </div>

                        {{-- Bio --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Bio <span class="text-muted">(min 150 chars)</span></label>
                            <textarea
                                class="form-control"
                                name="bio"
                                rows="4"
                                placeholder="Tell people who you are...">{{ auth()->user()->bio }}</textarea>
                            <small class="" style="color: red"  id="bioInfo"></small>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                New Password <span class="text-muted">(optional)</span>
                            </label>
                            <input type="password"
                                   class="form-control"
                                   name="password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password"
                                   class="form-control"
                                   name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary px-4">
                            Update Account
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Bio character counter & warning --}}
<script>
    const bioField = document.querySelector('textarea[name="bio"]');
    const bioInfo = document.getElementById('bioInfo');
    const minChars = 150;

    function updateBioInfo() {
        const len = bioField.value.length;

        if(len < minChars) {
            bioInfo.textContent = `${minChars - len} more characters needed`;
            bioInfo.classList.remove('text-success');
            bioInfo.classList.add('text-danger');
        } else {
            bioInfo.textContent = `Bio is good!`;
            bioInfo.classList.remove('text-danger');
            bioInfo.classList.add('text-success');
        }
    }

    // Initial check on page load
    updateBioInfo();

    // Update in real-time
    bioField.addEventListener('input', updateBioInfo);

    // Optional: prevent form submission if bio < 150
    const form = bioField.closest('form');
    // form.addEventListener('submit', function(e) {
    //     if(bioField.value.length < minChars) {
    //         e.preventDefault();
    //         alert(`Your bio must be at least ${minChars} characters`);
    //         bioField.focus();
    //     }
    // });
    form.addEventListener('submit', function(e) {
    if(bioField.value.length < minChars) {
        e.preventDefault();
        bioInfo.textContent = `Your bio must be at least ${minChars} characters`;
        bioInfo.classList.remove('text-success');
        bioInfo.classList.add('text-danger');
        bioField.focus();
    }
});

</script>

@endsection

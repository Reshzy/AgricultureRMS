@extends('layouts.admin')

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('header', 'Dashboard')

@section('content')

<!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> -->

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        @livewire('profile.update-profile-information-form')

        <x-section-border />
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-password-form')
        </div>

        <x-section-border />
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="mt-10 sm:mt-0">
            @livewire('profile.two-factor-authentication-form')
        </div>

        <x-section-border />
        @endif

        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <x-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('profile.delete-user-form')
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Wait for Livewire to be ready
        const initCameraForProfile = () => {
            const cameraBtn = document.getElementById('camera-btn-profile');
            const photoInput = document.getElementById('photo');
            
            if (!cameraBtn || !photoInput) {
                // Retry if Livewire hasn't loaded the component yet
                setTimeout(initCameraForProfile, 100);
                return;
            }
            
            cameraBtn.addEventListener('click', async () => {
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    alert('Camera is not supported in this browser. Please use the file upload option.');
                    return;
                }
                
                try {
                    // Create modal for camera
                    const modal = document.createElement('div');
                    modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75';
                    modal.id = 'camera-capture-modal-profile';
                    
                    modal.innerHTML = `
                        <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Take Profile Photo</h3>
                                <button type="button" class="text-gray-400 hover:text-gray-600" id="camera-close-btn-profile">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="relative bg-black rounded-lg overflow-hidden mb-4" style="aspect-ratio: 1;">
                                <video id="camera-preview-profile" autoplay playsinline class="w-full h-full object-cover"></video>
                                <div id="camera-error-profile" class="hidden absolute inset-0 flex items-center justify-center bg-gray-900 text-white p-4">
                                    <p class="text-center">Camera access denied or not available</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-3 justify-center">
                                <button type="button" id="camera-capture-btn-profile" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md font-medium">
                                    Capture
                                </button>
                                <button type="button" id="camera-switch-btn-profile" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md font-medium hidden">
                                    Switch Camera
                                </button>
                                <button type="button" id="camera-cancel-btn-profile" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md font-medium">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    `;
                    
                    document.body.appendChild(modal);
                    
                    const video = document.getElementById('camera-preview-profile');
                    const captureBtn = document.getElementById('camera-capture-btn-profile');
                    const cancelBtn = document.getElementById('camera-cancel-btn-profile');
                    const closeBtn = document.getElementById('camera-close-btn-profile');
                    const switchBtn = document.getElementById('camera-switch-btn-profile');
                    const errorDiv = document.getElementById('camera-error-profile');
                    
                    let stream = null;
                    let facingMode = 'user';
                    
                    // Check for multiple cameras
                    navigator.mediaDevices.enumerateDevices().then(devices => {
                        const videoDevices = devices.filter(device => device.kind === 'videoinput');
                        if (videoDevices.length > 1) {
                            switchBtn.classList.remove('hidden');
                        }
                    });
                    
                    // Start camera
                    try {
                        stream = await navigator.mediaDevices.getUserMedia({
                            video: {
                                facingMode: facingMode,
                                width: { ideal: 1280 },
                                height: { ideal: 1280 }
                            }
                        });
                        video.srcObject = stream;
                    } catch (error) {
                        console.error('Camera error:', error);
                        errorDiv.classList.remove('hidden');
                        video.classList.add('hidden');
                        captureBtn.disabled = true;
                        if (switchBtn) switchBtn.disabled = true;
                    }
                    
                    // Capture function
                    const capture = () => {
                        const canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth || 1280;
                        canvas.height = video.videoHeight || 1280;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(video, 0, 0);
                        
                        canvas.toBlob((blob) => {
                            if (blob) {
                                const file = new File([blob], `camera-capture-${Date.now()}.jpg`, {
                                    type: 'image/jpeg',
                                    lastModified: Date.now()
                                });
                                
                                // Create a DataTransfer object to set the file
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                photoInput.files = dataTransfer.files;
                                
                                // Trigger change event for Livewire
                                photoInput.dispatchEvent(new Event('change', { bubbles: true }));
                                
                                // Also trigger input event for Alpine.js
                                photoInput.dispatchEvent(new Event('input', { bubbles: true }));
                                
                                // Cleanup
                                if (stream) {
                                    stream.getTracks().forEach(track => track.stop());
                                }
                                modal.remove();
                            }
                        }, 'image/jpeg', 0.9);
                    };
                    
                    // Switch camera function
                    const switchCamera = async () => {
                        if (stream) {
                            stream.getTracks().forEach(track => track.stop());
                        }
                        facingMode = facingMode === 'user' ? 'environment' : 'user';
                        try {
                            stream = await navigator.mediaDevices.getUserMedia({
                                video: {
                                    facingMode: facingMode,
                                    width: { ideal: 1280 },
                                    height: { ideal: 1280 }
                                }
                            });
                            video.srcObject = stream;
                        } catch (error) {
                            console.error('Failed to switch camera:', error);
                        }
                    };
                    
                    // Event listeners
                    captureBtn.addEventListener('click', capture);
                    switchBtn.addEventListener('click', switchCamera);
                    
                    const cleanup = () => {
                        if (stream) {
                            stream.getTracks().forEach(track => track.stop());
                        }
                        modal.remove();
                    };
                    
                    cancelBtn.addEventListener('click', cleanup);
                    closeBtn.addEventListener('click', cleanup);
                    
                    // Close on escape
                    const escapeHandler = (e) => {
                        if (e.key === 'Escape' && document.getElementById('camera-capture-modal-profile')) {
                            cleanup();
                            document.removeEventListener('keydown', escapeHandler);
                        }
                    };
                    document.addEventListener('keydown', escapeHandler);
                    
                } catch (error) {
                    console.error('Camera initialization error:', error);
                    alert('Failed to access camera. Please use the file upload option.');
                }
            });
        };
        
        // Initialize when DOM is ready
        initCameraForProfile();
        
        // Also listen for Livewire updates
        if (window.Livewire) {
            window.Livewire.hook('morph.updated', () => {
                setTimeout(initCameraForProfile, 100);
            });
        }
    });
</script>
@endpush

@endsection
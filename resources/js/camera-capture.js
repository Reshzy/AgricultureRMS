/**
 * Camera Capture Utility
 * Provides camera access and image capture functionality for 2x2 picture uploads
 */

class CameraCapture {
    constructor(options = {}) {
        this.video = null;
        this.stream = null;
        this.canvas = null;
        this.onCapture = options.onCapture || null;
        this.onError = options.onError || null;
        this.facingMode = options.facingMode || 'user'; // 'user' for front, 'environment' for back
    }

    /**
     * Check if camera is supported
     */
    isSupported() {
        return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
    }

    /**
     * Request camera access and start preview
     */
    async startPreview(videoElement) {
        if (!this.isSupported()) {
            throw new Error('Camera is not supported in this browser');
        }

        try {
            this.video = videoElement;
            const constraints = {
                video: {
                    facingMode: this.facingMode,
                    width: { ideal: 1280 },
                    height: { ideal: 1280 }
                }
            };

            this.stream = await navigator.mediaDevices.getUserMedia(constraints);
            this.video.srcObject = this.stream;
            this.video.play();

            return true;
        } catch (error) {
            if (this.onError) {
                this.onError(error);
            }
            throw error;
        }
    }

    /**
     * Capture image from video stream
     */
    captureImage(options = {}) {
        if (!this.video || !this.stream) {
            throw new Error('Camera preview not started');
        }

        const width = options.width || this.video.videoWidth || 1280;
        const height = options.height || this.video.videoHeight || 1280;
        const quality = options.quality || 0.9;
        const format = options.format || 'image/jpeg';

        // Create canvas
        if (!this.canvas) {
            this.canvas = document.createElement('canvas');
        }
        this.canvas.width = width;
        this.canvas.height = height;

        const ctx = this.canvas.getContext('2d');
        ctx.drawImage(this.video, 0, 0, width, height);

        // Convert to blob
        return new Promise((resolve, reject) => {
            this.canvas.toBlob(
                (blob) => {
                    if (blob) {
                        // Convert blob to File object
                        const file = new File([blob], `camera-capture-${Date.now()}.${format.split('/')[1]}`, {
                            type: format,
                            lastModified: Date.now()
                        });
                        resolve(file);
                    } else {
                        reject(new Error('Failed to capture image'));
                    }
                },
                format,
                quality
            );
        });
    }

    /**
     * Stop camera stream
     */
    stop() {
        if (this.stream) {
            this.stream.getTracks().forEach(track => track.stop());
            this.stream = null;
        }
        if (this.video) {
            this.video.srcObject = null;
        }
        if (this.canvas) {
            const ctx = this.canvas.getContext('2d');
            ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        }
    }

    /**
     * Switch camera (front/back)
     */
    async switchCamera() {
        if (!this.stream) {
            throw new Error('Camera preview not started');
        }

        this.facingMode = this.facingMode === 'user' ? 'environment' : 'user';
        this.stop();
        
        // Restart with new facing mode
        await this.startPreview(this.video);
    }
}

/**
 * Initialize camera capture modal
 * @param {Object} options - Configuration options
 * @returns {Promise<File>} - Captured image file
 */
window.initCameraCapture = async function(options = {}) {
    return new Promise((resolve, reject) => {
        // Create modal overlay
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75';
        modal.id = 'camera-capture-modal';
        
        modal.innerHTML = `
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Take Photo</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-600" id="camera-close-btn">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div class="relative bg-black rounded-lg overflow-hidden mb-4" style="aspect-ratio: 1;">
                    <video id="camera-preview" autoplay playsinline class="w-full h-full object-cover"></video>
                    <div id="camera-error" class="hidden absolute inset-0 flex items-center justify-center bg-gray-900 text-white p-4">
                        <p class="text-center">Camera access denied or not available</p>
                    </div>
                </div>
                
                <div class="flex gap-3 justify-center">
                    <button type="button" id="camera-capture-btn" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md font-medium">
                        Capture
                    </button>
                    <button type="button" id="camera-switch-btn" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md font-medium hidden">
                        Switch Camera
                    </button>
                    <button type="button" id="camera-cancel-btn" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md font-medium">
                        Cancel
                    </button>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        const video = document.getElementById('camera-preview');
        const captureBtn = document.getElementById('camera-capture-btn');
        const cancelBtn = document.getElementById('camera-cancel-btn');
        const closeBtn = document.getElementById('camera-close-btn');
        const switchBtn = document.getElementById('camera-switch-btn');
        const errorDiv = document.getElementById('camera-error');
        
        const camera = new CameraCapture({
            facingMode: options.facingMode || 'user',
            onError: (error) => {
                console.error('Camera error:', error);
                errorDiv.classList.remove('hidden');
                video.classList.add('hidden');
                captureBtn.disabled = true;
                if (switchBtn) switchBtn.disabled = true;
            }
        });
        
        // Show switch button if device supports multiple cameras
        if (camera.isSupported()) {
            navigator.mediaDevices.enumerateDevices().then(devices => {
                const videoDevices = devices.filter(device => device.kind === 'videoinput');
                if (videoDevices.length > 1) {
                    switchBtn.classList.remove('hidden');
                }
            });
        }
        
        // Start camera preview
        camera.startPreview(video).catch(error => {
            reject(error);
            cleanup();
        });
        
        // Capture button
        captureBtn.addEventListener('click', async () => {
            try {
                captureBtn.disabled = true;
                captureBtn.textContent = 'Processing...';
                const file = await camera.captureImage({
                    width: options.width || 1280,
                    height: options.height || 1280,
                    quality: options.quality || 0.9,
                    format: options.format || 'image/jpeg'
                });
                resolve(file);
                cleanup();
            } catch (error) {
                reject(error);
                cleanup();
            }
        });
        
        // Switch camera button
        switchBtn.addEventListener('click', async () => {
            try {
                switchBtn.disabled = true;
                await camera.switchCamera();
                switchBtn.disabled = false;
            } catch (error) {
                console.error('Failed to switch camera:', error);
            }
        });
        
        // Cancel/Close buttons
        const cleanup = () => {
            camera.stop();
            modal.remove();
        };
        
        cancelBtn.addEventListener('click', () => {
            reject(new Error('User cancelled'));
            cleanup();
        });
        
        closeBtn.addEventListener('click', () => {
            reject(new Error('User cancelled'));
            cleanup();
        });
        
        // Close on escape key
        document.addEventListener('keydown', function escapeHandler(e) {
            if (e.key === 'Escape' && document.getElementById('camera-capture-modal')) {
                reject(new Error('User cancelled'));
                cleanup();
                document.removeEventListener('keydown', escapeHandler);
            }
        });
    });
};

export default CameraCapture;

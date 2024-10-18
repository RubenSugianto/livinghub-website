@extends('master')

@section('title', 'Tambah Properti')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="alert alert-danger fade" id="form-alert" style="display:none;">
    <i class="fa fa-exclamation-triangle alert-icon" aria-hidden="true"></i>
    <span class="alert-content">
        <strong>Harap isi semua informasi sebelum lanjut ke halaman selanjutnya.</strong>
    </span>
    <button type="button" class="btn-close close-btn" aria-label="Close" onclick="this.parentElement.style.display='none';">✖</button>
</div>

<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <form id="propertyForm" action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="formbold-steps">
            <ul>
                <li class="formbold-step-menu1 active">
                    <span>1</span>
                    Detail Properti
                </li>
                <li class="formbold-step-menu2">
                    <span>2</span>
                    Lokasi
                </li>
                <li class="formbold-step-menu3">
                    <span>3</span>
                    Deskripsi
                </li>
                <li class="formbold-step-menu4">
                    <span>4</span>
                    Informasi Tambahan
                </li>
                <li class="formbold-step-menu5">
                    <span>5</span>
                    Gambar
                </li>
            </ul>
        </div>

        <div class="formbold-form-step-1 active">
            <div class="formbold-input-flex">
                <div>
                    <label for="name" class="formbold-form-label">Nama Properti</label>
                    <input type="text" class="formbold-form-input" id="name" name="name" required>
                </div>
                <div>
                    <label for="price" class="formbold-form-label">Harga</label>
                    <input type="number" class="formbold-form-input" id="price" name="price" required>
                </div>
            </div>
        </div>

        <div class="formbold-form-step-2">
            <div class="formgroup">
                <label for="location" class="formbold-form-label">Provinsi</label>
                <select class="formbold-form-input" id="location" name="province" required>
                    <option value="" disabled selected>Pilih Lokasi</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bogor">Bogor</option>
                    <option value="Depok">Depok</option>
                    <option value="Tangerang">Tangerang</option>
                    <option value="Bekasi">Bekasi</option>
                </select>
            </div>
            <div class="formgroup" id="detailed-location-group" style="display: none;">
                <label for="detailed-location" class="formbold-form-label">Kota</label>
                <select class="formbold-form-input" id="detailed-location" name="location" required>
                </select>
            </div>
            <div class="formgroup">
                <label for="full_location" class="formbold-form-label">Alamat Lengkap</label>
                <textarea class="formbold-form-input" id="full_location" name="full_location" required></textarea>
                <p class="helper-text">Alamat lengkap hanya bisa diisi dengan maksimum 255 karakter.</p>
            </div>
        </div>

        <div class="formbold-form-step-3">
            <div class="formgroup">
                <label for="description" class="formbold-form-label">Deskripsi Properti</label>
                <textarea class="formbold-form-input" id="description" name="description" required style="width: 100%; height: 150px;"></textarea>
                <p class="helper-text">Deskripsi hanya bisa diisi dengan maksimum 1000 karakter.</p>
            </div>
        </div>

        <div class="formbold-form-step-4">
            <div class="formbold-input-flex">
                <div>
                    <label for="bedroom" class="formbold-form-label">Kamar Tidur</label>
                    <input type="number" class="formbold-form-input" id="bedroom" name="bedroom" required>
                </div>
                <div>
                    <label for="bathroom" class="formbold-form-label">Kamar Mandi</label>
                    <input type="number" class="formbold-form-input" id="bathroom" name="bathroom" required>
                </div>
            </div>
            <div class="formbold-input-flex">
                <div>
                    <label for="electricity" class="formbold-form-label">Listrik(Watt)</label>
                    <input type="number" class="formbold-form-input" id="electricity" name="electricity" required>
                </div>
                <div>
                    <label for="surfaceArea" class="formbold-form-label">Luas Tanah(m²)</label>
                    <input type="number" class="formbold-form-input" id="surfaceArea" name="surfaceArea" required>
                </div>
            </div>
            <div class="formbold-input-flex">
                <div>
                    <label for="buildingArea" class="formbold-form-label">Luas Bangunan(m²)</label>
                    <input type="number" class="formbold-form-input" id="buildingArea" name="buildingArea" required>
                </div>
                <div>
                    <label for="status" class="formbold-form-label">Status</label>
                    <select class="formbold-form-input" id="status" name="status" required>
                        <option value="Dijual">Dijual</option>
                        <option value="Disewa">Disewa</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="typeProperty" class="formbold-form-label">Tipe Properti</label>
                <select class="formbold-form-input" id="typeProperty" name="typeProperty" required>
                    <option value="Rumah">Rumah</option>
                    <option value="Apartemen">Apartemen</option>
                </select>
            </div>
            <div>
                <label for="typeDocument" class="formbold-form-label">Tipe Dokumen</label>
                <select class="formbold-form-input" id="typeDocument" name="typeDocument" required>
                    <option value="SHM">SHM</option>
                    <option value="SHGB">SHGB</option>
                    <option value="SHGU">SHGU</option>
                    <option value="Hak Pakai">Hak Pakai</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <input type="text" class="formbold-form-input" id="customType" name="customType" placeholder="Isi tipe dokumen lainnya" style="display: none; margin-top: 10px;">
            </div>

        </div>

        <div class="formbold-form-step-5">
            <div class="formgroup">
                <label for="images" class="formbold-form-label">Upload Gambar (Maksimal 10 Gambar)</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple required onchange="previewImages(event)">
                <p class="helper-text">Format foto harus .jpg, .jpeg, .png, .webp dan ukuran maksimal 2 MB. Maksimal 10 foto yang berbeda satu sama lain untuk menarik perhatian calon pembeli.</p>
            </div>
        </div>

        <div id="imagePreview" class="formbold-image-preview"></div>

        <div class="formbold-form-btn-wrapper">
            <button type="button" class="formbold-back-btn" id="back" style="display: none;">Sebelumnya</button>
            <button type="button" class="formbold-btn" id="next">Selanjutnya</button>
            <button type="submit" class="formbold-btn" id="submit" style="display: none;">Submit</button>
        </div>
    </form>
    <div id="form-alert" style="display:none;">Please fill all required fields.</div>
     </div> 
         </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const nextBtn = document.getElementById('next');
        const backBtn = document.getElementById('back');
        const submitBtn = document.getElementById('submit');
        const steps = document.querySelectorAll('.formbold-form-step-1, .formbold-form-step-2, .formbold-form-step-3, .formbold-form-step-4, .formbold-form-step-5');
        const stepMenus = document.querySelectorAll('.formbold-step-menu1, .formbold-step-menu2, .formbold-step-menu3, .formbold-step-menu4, .formbold-step-menu5');
        let currentStep = 0;

        const detailedLocations = {
            "Jakarta": ["Jakarta Pusat", "Jakarta Utara", "Jakarta Barat", "Jakarta Selatan", "Jakarta Timur"],
            "Bogor": ["Kota Bogor"],
            "Depok": ["Kota Depok"],
            "Tangerang": ["Kota Tangerang", "Kota Tangerang Selatan"],
            "Bekasi": ["Kota Bekasi"]
        };

        const locationSelect = document.getElementById('location');
        const detailedLocationGroup = document.getElementById('detailed-location-group');
        const detailedLocationSelect = document.getElementById('detailed-location');

        function populateDetailedLocations(locations) {
            detailedLocationSelect.innerHTML = '<option value="" disabled selected>Pilih Kota</option>'; 
            locations.forEach(location => {
                const option = document.createElement('option');
                option.value = location;
                option.textContent = location;
                detailedLocationSelect.appendChild(option);
            });
        }

        locationSelect.addEventListener('change', function () {
            const selectedLocation = locationSelect.value;
            if (selectedLocation && detailedLocations[selectedLocation]) {
                detailedLocationGroup.style.display = 'block';
                populateDetailedLocations(detailedLocations[selectedLocation]);
            } else {
                detailedLocationGroup.style.display = 'none';
            }
        });

        function showStep(step) {
            steps.forEach((el, index) => {
                if (index === step) {
                    el.classList.add('active');
                    stepMenus[index].classList.add('active');
                } else {
                    el.classList.remove('active');
                    stepMenus[index].classList.remove('active');
                }
            });

            nextBtn.style.display = step === steps.length - 1 ? 'none' : 'block';
            backBtn.style.display = step === 0 ? 'none' : 'block';
            submitBtn.style.display = step === steps.length - 1 ? 'block' : 'none';
        }

        function validateStep(step) {
            const currentFields = steps[step].querySelectorAll('input[required], select[required], textarea[required]');
            return Array.from(currentFields).every(field => field.value.trim() !== '');
        }

        nextBtn.addEventListener('click', function () {
            if (validateStep(currentStep)) {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
                document.getElementById('form-alert').style.display = 'none'; 
            } else {
                document.getElementById('form-alert').style.display = 'block'; 
            }
        });

        backBtn.addEventListener('click', function () {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
                document.getElementById('form-alert').style.display = 'none';
            }
        });

        showStep(currentStep);

        const propertyForm = document.getElementById('propertyForm');
        propertyForm.addEventListener('submit', function (event) {
            const typeSelect = document.getElementById('typeDocument');
            const customTypeInput = document.getElementById('customType');

            if (typeSelect.value === 'Lainnya') {
                if (customTypeInput.value.trim() !== '') {
        
                    const newOption = document.createElement('option');
                    newOption.value = customTypeInput.value.trim();
                    newOption.textContent = customTypeInput.value.trim();
                    typeSelect.appendChild(newOption);
                    
                
                    typeSelect.value = customTypeInput.value.trim();
                } else {
                   
                    event.preventDefault();
                    alert('Please enter a custom document type.');
                    return;
                }
            }
            
            const allFieldsFilled = Array.from(document.querySelectorAll('input[required], select[required], textarea[required]')).every(field => field.value.trim() !== '');
            if (!allFieldsFilled) {
                event.preventDefault(); 
                document.getElementById('form-alert').style.display = 'block'; 
            }
        });

        const typeSelect = document.getElementById('typeDocument');
        const customTypeInput = document.getElementById('customType');

        typeSelect.addEventListener('change', function () {
            if (typeSelect.value === 'Lainnya') {
                customTypeInput.style.display = 'block';
                customTypeInput.required = true;
            } else {
                customTypeInput.style.display = 'none';
                customTypeInput.required = false;
                customTypeInput.value = ''; 
            }
        });

    });

    function previewImages(event) {
        const files = event.target.files;

        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = ''; 

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('formbold-preview-image');
                imagePreview.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }

    </script>
</div>

<style>
    .formbold-main-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    position: relative;
}

.formbold-form-wrapper {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 800px;
}

.formbold-steps ul {
    padding: 0;
    margin: 0;
    list-style: none;
    display: flex;
    justify-content: space-between;
    padding-bottom: 10px;
    border-bottom: 1px solid #DDE3EC;
    margin-bottom: 25px;
}

.formbold-steps li {
    font-size: 14px;
    color: #536387;
    display: flex;
    align-items: center;
    gap: 10px;
}

.formbold-steps li span {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #DDE3EC;
    color: #536387;
    font-size: 14px;
}

.formbold-steps li.active span {
    background-color: #6A64F1;
    color: #fff;
}

.formbold-form-input {
    width: 100%;
    padding: 10px 15px;
    border-radius: 5px;
    border: 1px solid #DDE3EC;
    background: #f9f9f9;
    font-weight: 500;
    font-size: 14px;
    color: #536387;
    margin-bottom: 15px;
    outline: none;
    transition: border-color 0.3s ease;
}

.formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
}

.formbold-input-flex {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
}

.formbold-input-flex > div {
    flex: 1;
}

.formbold-form-btn-wrapper {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.formbold-btn, 
.formbold-back-btn, 
.formbold-submit-btn {
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    background-color: #5E5DF0;
    color: #fff;
    transition: background-color 0.3s ease;
}

.formbold-back-btn {
    background-color: #ccc;
}

.formbold-btn:hover, 
.formbold-submit-btn:hover {
    background-color: #4A4AC4;
}

.formbold-form-step-1, 
.formbold-form-step-2, 
.formbold-form-step-3, 
.formbold-form-step-4, 
.formbold-form-step-5 {
    display: none;
}

.formbold-form-step-1.active, 
.formbold-form-step-2.active, 
.formbold-form-step-3.active, 
.formbold-form-step-4.active, 
.formbold-form-step-5.active {
    display: block;
}

.formbold-image-preview {
    display: flex;
    gap: 10px;
    margin-top: 10px;
    flex-wrap: wrap;
}

.formbold-preview-image {
    max-width: 150px;
    max-height: 150px;
    object-fit: cover;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.alert {
    padding: 15px;
    margin: 10px auto;
    border-radius: 10px;
    width: calc(100% - 40px);
    position: relative;
    top: -10px; 
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 1rem; 
}

.alert-success {
    background-color: #d4edda; 
    color: #155724; 
    border: 1px solid #c3e6cb; 
}

.alert-warning {
    background-color: #f8d7da; 
    color: #721c24; 
    border: 1px solid #f5c6cb; 
}

.alert .btn-close {
    background: transparent;
    border: none;
    font-size: 1.5rem; 
    color: #721c24; 
    cursor: pointer;
    margin-left: auto;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    right: 15px; 
    top: 50%;
    transform: translateY(-50%); 
}

.alert .btn-close:hover {
    color: #5a3b02; 
}

.alert .btn-close:active {
    transform: translateY(-50%) scale(1.1);
}


.alert .alert-icon {
    font-size: 2rem;
    margin-right: 15px;
    vertical-align: middle;
}

.alert.fade {
    opacity: 1;
    transform: translateY(0);
}

.alert.fade.hide {
    opacity: 0;
    transform: translateY(-15px);
}

.formgroup .formbold-form-input ~ .helper-text {
    margin-top: -20px; /* Reduce space between the input and helper text */
}

.helper-text {
    font-size: 0.875rem; /* Small, but readable size */
    color: #6c757d; /* Muted gray color */
    margin-top: 5px; /* Space between the input and helper text */
}


@media (max-width: 768px) {
    .formbold-input-flex {
        flex-direction: column;
    }

    .formbold-back-btn,
    .formbold-btn,
    .formbold-submit-btn {
        width: 100%;
        margin-top: 10px;
    }

    .formbold-steps ul {
        flex-direction: column;
    }
}

</style>

@endsection
    
@extends('index')

@section('content')
<style>
    .btn-gradient-purple {
        background: linear-gradient(45deg, #78296D, #D058B9);
        color: white;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Adds subtle shadow */
        transition: background 0.3s ease, box-shadow 0.3s ease;
        /* Smooth transition */
    }

    .btn-gradient-purple:hover {
        background: linear-gradient(45deg, #6c2563, #a1448f);
        /* Darker gradient on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        /* Stronger shadow on hover */
        color: white;
    }

    .btn-action {
        background: none;
        border: none;
        /* Remove border */
        padding: 10px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .btn-action:hover {
        transform: scale(1.1);
        /* Slightly enlarge icon on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Add shadow on hover */
    }

    .iconify {
        font-size: 22px;
        color: #6c2563;
    }

    .iconify:hover {
        color: #D058B9;
        /* Change color on hover */
    }

    #notification {
            position: fixed;
            top: 10px;
            right: 10px;
            width: 300px;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
            display: none;
            text-align: center;
            justify-content: flex-start;
            /* Tetap di sebelah kiri */
            align-items: center;
            text-align: left;
            /* Teks tetap rata kiri */
            /* Hidden by default */
        }
</style>

    <!-- Bread crumb -->
    <div class="page-breadcrumb">

        {{-- <div id="notification" class="alert" style="display: none;">
            <strong id="notificationTitle"></strong>
            <span id="notificationMessage"></span>
        </div> --}}

        <div class="row">
            <div class="col-7 align-self-center">
                <h4 style="font-family: 'Kufam', sans-serif;"
                    class="page-title text-truncate text-dark font-weight-medium mb-1">Content System Management</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Apps</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Content System</li>
                        </ol>
                    </nav>
                </div>
            </div>
            {{-- <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addMerchantModal">
                        <button class="custom-select-set form-control btn-gradient-purple">
                            <span style="margin-left: 12px;">Add</span>
                        </button>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Container fluid -->
<div class="container-fluid">

    <div id="notification" class="alert" style="display: none;">
        <div id="notificationType" class="font-weight-bold"></div>
        <strong id="notificationTitle"></strong>
        <span id="notificationMessage"></span>
    </div>

    <!-- Basic Table -->
    <div class="row">
        <div class="col-12">
            {{-- <div class="card" style="max-width: 80%; justiify-content: center; margin: 0 auto;"> --}}
                    <!-- Edit Merchant Form (Converted from Modal to Normal Form) -->
                    <div class="card" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); max-width: 70%; justify-content: center; margin: 0 auto;">
                        <div class="card-header" style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                            <h5 class="card-title text-white" id="editMerchantFormLabel">Edit Merchant</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <!-- Edit Merchant Form -->
                            <form id="editMerchantForm">
                                <div id="cmsFieldsContainer"></div> <!-- Container to dynamically add CMS fields -->
                            </form>
                        </div>
                        <div class="card-footer text-center" style="border-top: none; padding-top: 0;">
                            <button type="button" id="updateMerchantBtn" class="btn btn-gradient-purple">Update Merchant</button>
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Function to load CMS data and create fields dynamically
function loadCmsData() {
    const url = `http://192.168.43.45/api/cms`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log('API Response:', data); // Log API response for debugging

            if (data.status && Array.isArray(data.data)) {
                const container = document.getElementById('cmsFieldsContainer');
                container.innerHTML = ''; // Clear any existing fields

                data.data.forEach(cms => {
                    console.log('Adding CMS:', cms); // Log each CMS item for verification

                    const rowDiv = document.createElement('div');
                    rowDiv.classList.add('row', 'mb-3');

                    const label = document.createElement('label');
                    label.classList.add('col-2', 'col-form-label', 'text-grey');
                    label.textContent = cms.cms_name;

                    const inputDiv = document.createElement('div');
                    inputDiv.classList.add('col-10');

                    const input = document.createElement('input');
                    input.type = 'text';
                    input.classList.add('form-control');
                    input.name = `cms_value_${cms.cms_code}`; // Ensure uniqueness using cms_code
                    input.value = cms.cms_value;
                    input.dataset.code = cms.cms_code; // Store cms_code in data attribute

                    inputDiv.appendChild(input);
                    rowDiv.appendChild(label);
                    rowDiv.appendChild(inputDiv);
                    container.appendChild(rowDiv);
                });
            } else {
                console.error('Invalid data format or data not found');
            }
        })
        .catch(error => console.error('Error fetching CMS data:', error));
}

function updateCmsValue(cmsCode, cmsValue) {
    const url = `http://192.168.43.45/api/cms/${cmsCode}`; // Update endpoint to use cms_code
    const requestOptions = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ cms_value: cmsValue })
    };

    fetch(url, requestOptions)
        .then(response => response.json())
        .then(result => {
            if (result.status && result.message) {
                // Check if the update was successful or failed based on the response message
                if (result.status) {
                    // Success: Show success notification
                    showNotification('Success!', 'CMS berhasil diperbarui', 'success');
                } else {
                    // Failure: Show failure notification
                    showNotification('Error', result.message, 'danger');
                }
            } else {
                // If the API response doesn't contain status or message, show an error
                showNotification('Error', 'Unknown error occurred while updating CMS', 'danger');
            }
            // Reload the page after showing the notification
            setTimeout(() => {
                location.reload(); // Reload the page after 2 seconds
            }, 2000);
        })
        .catch(error => {
            console.error(`Error updating CMS with code ${cmsCode}:`, error);
            // Show error notification if there's an error with the request
            showNotification('Error', `Error updating CMS: ${error.message}`, 'danger');
            // Reload the page after showing the error
            setTimeout(() => {
                location.reload();
            }, 2000);
        });
}

// Function to handle the update process for all CMS records individually
function updateAllCmsValues() {
    const inputs = document.querySelectorAll('#cmsFieldsContainer input');

    inputs.forEach(input => {
        const cmsCode = input.dataset.code; // Get cms_code from data attribute
        const cmsValue = input.value.trim();

        // Only send update if the value has changed
        if (cmsValue !== '') {
            console.log(`Updating CMS with code ${cmsCode} and value ${cmsValue}`);
            updateCmsValue(cmsCode, cmsValue); // Update only the changed CMS value
        } else {
            console.log(`Skipping CMS with code ${cmsCode} as value is empty or unchanged`);
        }
    });
}

document.getElementById('updateMerchantBtn').addEventListener('click', updateAllCmsValues);

// Load CMS data on page load
document.addEventListener('DOMContentLoaded', function () {
    loadCmsData();
});

// Function to show a notification
function showNotification(title, message, type = 'success') {
    $('#notificationTitle').text(title); // Set the notification title
    $('#notificationMessage').text(message); // Set the message (without HTML formatting)
    $('#notification')
        .removeClass()
        .addClass(`alert alert-${type}`) // Set alert type (success, danger, etc.)
        .show(); // Show the notification

    // Hide the notification after 3 seconds
    setTimeout(function() {
        $('#notification').fadeOut();
    }, 3000);
}


// function showNotification(message, type) {
//     const notification = document.createElement('div');
//     notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
//     notification.textContent = message;
//     notification.style.position = 'fixed';
//     notification.style.top = '10px';
//     notification.style.right = '10px';
//     notification.style.zIndex = '1000';
//     notification.style.width = '300px';

//     document.body.appendChild(notification);

//     // Remove notification after 2 seconds
//     setTimeout(() => {
//         notification.remove();
//     }, 2000);
// }

</script>
@endsection

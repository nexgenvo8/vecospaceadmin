@if (session()->has('admin'))
    <script>
        setTimeout(function() {
            window.location.href = "{{ route('loginform') }}";
        }, 30 * 60 * 1000); // 5 minutes
    </script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users-SDGvecospace</title>
    @include('layout.favicon')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/dropzone/min/dropzone.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layout.header')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content p-4">
                <div class="container-fluid px-0">
                    <div class="text-end mb-4">
                        <a href="attachment/userUploadFormat1.xls" class="btn btn-success" download>
                            📥 Download Template Format
                        </a>
                    </div>
                    <div class="upload-container card shadow rounded-lg p-5 mx-auto"
                        style="width: 100%; max-width: none;">
                        <h2 class="text-center mb-4 text-primary font-weight-bold">📤 Upload Excel or CSV File</h2>

                        <div class="instructions mb-4 bg-white p-4 rounded border">
                            <h5 class="font-weight-bold text-secondary">📋 Instructions:</h5>
                            <ul class="list-unstyled text-muted mb-0">
                                <li>✅ Upload an Excel file (.xlsx, .xls) or CSV file</li>
                                <li>✅ Columns required: First Name, Last Name, Date of Birth, Email, Gender, User Type,
                                    Department, Course, Passing Year</li>
                                <li>✅ First row will be treated as headers</li>
                            </ul>
                        </div>

                        <form id="excel-upload-form" action="{{ route('import.upload') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold text-secondary">📂 Select Excel or CSV File</label>

                                <div class="custom-file border rounded p-3 d-flex align-items-center justify-content-between bg-white"
                                    style="cursor: pointer;" onclick="document.getElementById('excel_file').click();">

                                    <input type="file" class="custom-file-input" id="excel_file" name="excel_file"
                                        required accept=".xlsx,.xls,.csv" style="display: none;"
                                        onchange="updateFileName(this)">

                                    <span id="file-name" class="text-muted">No file selected</span>
                                    <button type="button" class="btn btn-outline-primary btn-sm">Choose File</button>
                                </div>
                            </div>




                            <button type="submit" class="btn btn-primary btn-block font-weight-bold">🚀 Upload
                                File</button>
                        </form>

                        <div id="upload-result" class="mt-4"></div>

                        <div class="preview-container mt-5" id="preview-container" style="display: none;">
                            <h4 class="mb-3 text-secondary">Upload Summary</h4>
                            <div class="alert alert-info" role="alert" id="summary-alert">
                                Summary will appear here after upload.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="upload-response">
                                    <!-- Dynamic table will be injected here -->
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>


        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layout.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script
        src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}">
    </script>
    <!-- InputMask -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script
        src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script
        src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}">
    </script>
    <!-- BS-Stepper -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/demo.js') }}"></script>

    <script>
        function updateFileName(input) {
            const fileNameSpan = document.getElementById('file-name');
            if (input.files.length > 0) {
                fileNameSpan.textContent = input.files[0].name;
            } else {
                fileNameSpan.textContent = 'No file selected';
            }
        }

        document.getElementById('excel-upload-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let resultDiv = document.getElementById('upload-result');
            let summaryAlert = document.getElementById('summary-alert');
            let previewContainer = document.getElementById('preview-container');
            let uploadResponseTable = document.getElementById('upload-response');

            resultDiv.innerHTML = '<p class="text-info">Uploading file, please wait...</p>';
            previewContainer.style.display = 'none';
            uploadResponseTable.innerHTML = '';

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        resultDiv.innerHTML = `<p class="text-success">${data.message}</p>`;
                        summaryAlert.innerHTML = `Imported Users: <strong>${data.imported_count}</strong>`;

                        if (data.imported_users && data.imported_users.length) {
                            let tableHeader = Object.keys(data.imported_users[0]).map(key => `<th>${key}</th>`)
                                .join('');
                            let tableBody = data.imported_users.map(row => {
                                return `<tr>${Object.values(row).map(val => `<td>${val}</td>`).join('')}</tr>`;
                            }).join('');

                            uploadResponseTable.innerHTML = `
                            <thead class="thead-light"><tr>${tableHeader}</tr></thead>
                            <tbody>${tableBody}</tbody>
                        `;

                            previewContainer.style.display = 'block';
                        }

                        // Automatically hide messages after 5 seconds
                        setTimeout(() => {
                            resultDiv.innerHTML = '';
                            summaryAlert.innerHTML = '';
                            previewContainer.style.display = 'none';
                            uploadResponseTable.innerHTML = '';
                        }, 10000); // 5000ms = 5 seconds

                    } else {
                        resultDiv.innerHTML = `<p class="text-danger">${data.message}</p>`;
                        if (data.skipped_rows && data.skipped_rows.length) {
                            resultDiv.innerHTML +=
                                `<p><strong>Skipped Rows:</strong> ${JSON.stringify(data.skipped_rows)}</p>`;
                        }

                        setTimeout(() => {
                            resultDiv.innerHTML = '';
                        }, 5000); // hide error message after 5 seconds
                    }
                })
                .catch(err => {
                    resultDiv.innerHTML = `<p class="text-danger">Upload failed: ${err}</p>`;
                    setTimeout(() => {
                        resultDiv.innerHTML = '';
                    }, 5000);
                });
        });
    </script>


    <style>
        body {
            background: #f8f9fa;
        }

        .upload-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
        }

        #upload-result p {
            font-size: 1rem;
        }
    </style>



</body>

</html>

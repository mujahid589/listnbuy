@extends('frontend.postad.index')

@section('title', __('website.step2'))

@section('post-ad-content')
 <!-- Step 02 -->
 <div class="tab-pane fade show active" id="pills-post" role="tabpanel" aria-labelledby="pills-post-tab">
    <div class="dashboard-post__ads step-information">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ route('frontend.post.step2.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-sm-12">
                    <div class="upload-wrapper">
                        <h3>Upload Thumbnail</h3>
                        <div class="upload-area @error('thumbnail') border-danger @enderror">
                            <div class="uploaded-items"></div>
                            <div class="add-new">
                                <x-svg.image-select-icon />
                                <input name="thumbnail"  type="file" hidden id="addNew" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mt-5">
                    <div class="upload-wrapper2">
                        <h3>Upload Video</h3>
                        <div class="upload-area2 @error('video') border-danger @enderror">
                            <div class="uploaded-items2"></div>
                            <div class="add-new2">
                                <x-svg.image-select-icon />
                                <input name="video" type="file" hidden id="addNew2" accept="video/mp4,video/x-m4v,video/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mt-5" >
                    <div class="upload-wrapper3">
                        <h3>Upload Photos</h3>
                        <div class="upload-area3 @error('images') border-danger @enderror">
                            <div class="uploaded-items3"></div>
                            <div class="add-new3">
                                <x-svg.image-select-icon />
                                <input name="images[]" multiple type="file" hidden id="addNew3" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="dashboard-post__action-btns">
                <a href="{{ route('frontend.post.step1.back') }}" class="btn btn--lg btn--outline">
                    Previous
                </a>
                <button type="submit" class="btn btn--lg">
                    Next Step
                    <span class="icon--right">
                        <x-svg.right-arrow-icon />
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('frontend_style')
<style>
    .upload-wrapper2 .upload-area2 {
        padding: 20px;
        background: #ffffff;
        border: 1px dashed #ebeef7;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        border-radius: 8px;
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .upload-wrapper2 .uploaded-items2 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .upload-wrapper2 .add-new2 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background: #f5f7fa;
        cursor: pointer;
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }

    .upload-wrapper2 .uploaded-item2, .upload-wrapper2 .add-new2 {
        height: 120px;
        width: 120px;
        border-radius: 6px;
        position: relative;
        background: #f5f7fa;
        margin: 10px;
        -webkit-transition: background 0.3s linear;
        transition: background 0.3s linear;
    }

    .upload-wrapper2 .uploaded-item2 video,
    .upload-wrapper2 .add-new2 video {
        border-radius: 6px;
        /*height: 120px;*/
        /*width: 120px;*/
    }

    .upload-wrapper2 .uploaded-item2 .remove-icon {
        position: absolute;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background-color: #ff4f4f;
        color: white;
        right: 0;
        top: 0;
        -webkit-transform: rotate(45deg) translate(0%, -50%);
        transform: rotate(45deg) translate(0%, -50%);
        cursor: pointer;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .upload-wrapper2 .uploaded-item2 .remove-icon2 svg {
        height: 16px;
        width: 16px;
        pointer-events: none;
    }


    .upload-wrapper3 .upload-area3 {
        padding: 20px;
        background: #ffffff;
        border: 1px dashed #ebeef7;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        border-radius: 8px;
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .upload-wrapper3 .uploaded-items3 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .upload-wrapper3 .add-new3 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background: #f5f7fa;
        cursor: pointer;
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }

    .upload-wrapper3 .uploaded-item3, .upload-wrapper3 .add-new3 {
        height: 120px;
        width: 120px;
        border-radius: 6px;
        position: relative;
        background: #f5f7fa;
        margin: 10px;
        -webkit-transition: background 0.3s linear;
        transition: background 0.3s linear;
    }

    .upload-wrapper3 .uploaded-item3 img,
    .upload-wrapper3 .add-new3 img {
        border-radius: 6px;
    }

    .upload-wrapper3 .uploaded-item3 .remove-icon {
        position: absolute;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background-color: #ff4f4f;
        color: white;
        right: 0;
        top: 0;
        -webkit-transform: rotate(45deg) translate(0%, -50%);
        transform: rotate(45deg) translate(0%, -50%);
        cursor: pointer;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .upload-wrapper3 .uploaded-item3 .remove-icon svg {
        height: 16px;
        width: 16px;
        pointer-events: none;
    }
</style>

@endsection

@section('frontend_script')
    <script>
        function add_features_field() {
            $("#multiple_feature_part").append(`
            <div class="row">
                <div class="col-lg-10">
                        <div class="input-field">
                            <input name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                        </div>
                </div>
                <div class="col-lg-2 mt-10">
                    <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                </div>
            </div>
        `);
        }

        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent('div').remove();
        });
    </script>
    <script>
        // File Upload
        const uploadArea = document.querySelector('.upload-area');
        const uploadedItems = document.querySelector('.uploaded-items');
        const input = document.querySelector('#addNew');
        const inputButton = document.querySelector('.add-new');

        // add new file
        if (inputButton) {
            inputButton.addEventListener('click', (event) => {
                handleDragArea(true);
                input.click();
            });
        }

        // display file on file upload
        if (input) {
            input.addEventListener('change', (event) => {
                let files = event.target.files;

                for (let i = 0; i < files.length; i++) {
                    displayFile(files[i]);
                    handleDragArea(false);
                }
            });
        }

        // dragover event
        if (uploadArea) {
            uploadArea.addEventListener('dragover', (event) => {
                handleDragArea(true);
                event.preventDefault();
            });
        }

        // dragleave event
        if (uploadArea) {
            uploadArea.addEventListener('dragleave', (event) => {
                handleDragArea(false);
            });
        }

        // drop event
        if (uploadArea) {
            uploadArea.addEventListener('drop', (event) => {
                event.preventDefault();
                let file = event.dataTransfer.files[0];
                displayFile(file);
            });
        }

        // Handle drag over and drag leave effect
        function handleDragArea(param) {
            if (param == true) {
                uploadArea.classList.add('active');
            } else {
                uploadArea.classList.remove('active');
            }
        }

        // display uploadedFile
        function displayFile(file) {
            let fileType = file.type;
            let validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
            let fileURL;

            if (validExtensions.includes(fileType)) {
                let fileReader = new FileReader();

                fileReader.onload = () => {
                    fileURL = fileReader.result;
                    addNewfile(fileURL);
                };
                fileReader.readAsDataURL(file);
            } else {
                alert('File type not supported');
                handleDragArea(false);
            }
        }

        // Append New File in HTML
        function addNewfile(file) {
            let imgTag = `
    <div class="uploaded-item">
        <img src="${file}" alt="">
        <div class="remove-icon">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </div>
    </div>`;
            uploadedItems.insertAdjacentHTML('beforeend', imgTag);
        }

        $(document).on('click', '.remove-icon', function () {
            $(this).closest('.uploaded-item').remove()
        });
    </script>

    <script>
        // File Upload
        const uploadArea2 = document.querySelector('.upload-area2');
        const uploadedItems2 = document.querySelector('.uploaded-items2');
        const input2 = document.querySelector('#addNew2');
        const inputButton2 = document.querySelector('.add-new2');

        // add new file
        if (inputButton2) {
            inputButton2.addEventListener('click', (event) => {
                handleDragArea2(true);
                input2.click();
            });
        }

        // display file on file upload
        if (input2) {
            input2.addEventListener('change', (event) => {
                let files = event.target.files;

                for (let i = 0; i < files.length; i++) {
                    displayFile2(files[i]);
                    handleDragArea2(false);
                }
            });
        }

        // dragover event
        if (uploadArea2) {
            uploadArea2.addEventListener('dragover', (event) => {
                handleDragArea2(true);
                event.preventDefault();
            });
        }

        // dragleave event
        if (uploadArea2) {
            uploadArea2.addEventListener('dragleave', (event) => {
                handleDragArea2(false);
            });
        }

        // drop event
        if (uploadArea2) {
            uploadArea2.addEventListener('drop', (event) => {
                event.preventDefault();
                let file = event.dataTransfer.files[0];
                displayFile2(file);
            });
        }

        // Handle drag over and drag leave effect
        function handleDragArea2(param) {
            if (param == true) {
                uploadArea2.classList.add('active');
            } else {
                uploadArea2.classList.remove('active');
            }
        }

        // display uploadedFile
        function displayFile2(file) {
            let fileType = file.type;
            let validExtensions = ['video/mp4','video/x-m4v','video/*'];
            let fileURL;

            if (validExtensions.includes(fileType)) {
                let fileReader = new FileReader();

                fileReader.onload = () => {
                    fileURL = fileReader.result;
                    addNewfile2(fileURL);
                };
                fileReader.readAsDataURL(file);
            } else {
                alert('File type not supported');
                handleDragArea2(false);
            }
        }

        // Append New File in HTML
        function addNewfile2(file) {
            let imgTag = `
                <div class="uploaded-item2">
                    <video  width="120" height="120"  autoplay  >
                      <source src="${file}" >
                    </video>
                    <div class="remove-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </div>
                </div>`;
            uploadedItems2.insertAdjacentHTML('beforeend', imgTag);
        }

        $(document).on('click', '.remove-icon', function () {
            $(this).closest('.uploaded-item2').remove()
        });
    </script>

    <script>
        // File Upload
        const uploadArea3 = document.querySelector('.upload-area3');
        const uploadedItems3 = document.querySelector('.uploaded-items3');
        const input3 = document.querySelector('#addNew3');
        const inputButton3 = document.querySelector('.add-new3');

        // add new file
        if (inputButton3) {
            inputButton3.addEventListener('click', (event) => {
                handleDragArea3(true);
                input3.click();
            });
        }

        // display file on file upload
        if (input3) {
            input3.addEventListener('change', (event) => {
                let files = event.target.files;

                for (let i = 0; i < files.length; i++) {
                    displayFile3(files[i]);
                    handleDragArea3(false);
                }
            });
        }

        // dragover event
        if (uploadArea3) {
            uploadArea3.addEventListener('dragover', (event) => {
                handleDragArea3(true);
                event.preventDefault();
            });
        }

        // dragleave event
        if (uploadArea3) {
            uploadArea3.addEventListener('dragleave', (event) => {
                handleDragArea3(false);
            });
        }

        // drop event
        if (uploadArea3) {
            uploadArea3.addEventListener('drop', (event) => {
                event.preventDefault();
                let file = event.dataTransfer.files[0];
                displayFile3(file);
            });
        }

        // Handle drag over and drag leave effect
        function handleDragArea3(param) {
            if (param == true) {
                uploadArea3.classList.add('active');
            } else {
                uploadArea3.classList.remove('active');
            }
        }

        // display uploadedFile
        function displayFile3(file) {
            let fileType = file.type;
            let validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
            let fileURL;

            if (validExtensions.includes(fileType)) {
                let fileReader = new FileReader();

                fileReader.onload = () => {
                    fileURL = fileReader.result;
                    addNewfile3(fileURL);
                };
                fileReader.readAsDataURL(file);
            } else {
                alert('File type not supported');
                handleDragArea3(false);
            }
        }

        // Append New File in HTML
        function addNewfile3(file) {
            let imgTag = `
                <div class="uploaded-item3">
                    <img src="${file}" alt="">
                    <div class="remove-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </div>
                </div>`;
            uploadedItems3.insertAdjacentHTML('beforeend', imgTag);
        }

        $(document).on('click', '.remove-icon', function () {
            $(this).closest('.uploaded-item3').remove()
        });
    </script>
@endsection

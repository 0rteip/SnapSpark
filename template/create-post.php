<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div id="drop-area" class="border rounded d-flex justify-content-center align-items-center" style="height: 200px; cursor: pointer">
                <div class="text-center">
                    <i class="bi bi-cloud-arrow-up-fill text-primary" style="font-size: 48px"></i>
                    <p class="mt-3">
                        Drag and drop your image here or click to select a file.
                    </p>
                </div>
            </div>
            <input type="file" id="fileElem" multiple accept="image/*" class="d-none" />
            <div id="gallery"></div>
        </div>
    </div>
</div>

<script src="js/create-post.js"></script>

<div class="card">
    <div class="card-body">
        <div id="drop-area" class="border rounded d-flex justify-content-center align-items-center p-5">
            <div class="text-center">
                <em class="bi bi-cloud-arrow-up-fill text-primary" style="font-size: 48px"></em>
                <p class="mt-3">
                    Drag and drop your image here or click to select a file.
                </p>
            </div>
        </div>
        <label for="fileElem" class="visually-hidden">Load image</label>
        <input type="file" id="fileElem" accept="image/jpeg" class="d-none" />
    </div>
    <div id="gallery"></div>
</div>

<script src="js/create-post.js"></script>

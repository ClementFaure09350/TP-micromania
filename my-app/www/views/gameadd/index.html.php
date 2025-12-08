<?php
// Initialiser les variables si elles n'existent pas
$errors = $errors ?? [];
$old = $old ?? ['title' => '', 'description' => ''];
?>
<div class="bg-gradient-to-r from-black to-blue-900 min-h-screen py-12">
    <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-lg p-8 bg-gray-900 border-2 border-green-600 rounded-lg overflow-hidden">
        <h1 class="text-3xl font-bold text-green-500 mb-6 text-center">Créer un jeu</h1>

        <?php if (isset($errors['general'])): ?>
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-sm text-red-600"><?= htmlspecialchars($errors['general']) ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="/" enctype="multipart/form-data" class="space-y-6">
            

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-500 mb-2v">
                    Titre <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                    class="w-full px-4 py-2 bg-blue-600 text-white border border-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?= isset($errors['lastname']) ? 'border-red-500' : '' ?>"
                    required
                    maxlength="255">
                <?php if (isset($errors['title'])): ?>
                    <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['title']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Prix -->
             <div>
                <label for="price" class="block text-sm font-medium text-gray-500 mb-2v">
                    Prix <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    id="price"
                    name="price"
                    value="<?= htmlspecialchars($old['price'] ?? '') ?>"
                    class="w-full px-4 py-2 bg-blue-600 text-white border border-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?= isset($errors['lastname']) ? 'border-red-500' : '' ?>"
                    required
                    maxlength="255">
                <?php if (isset($errors['price'])): ?>
                    <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['price']) ?></p>
                <?php endif; ?>
            </div>

            <!-- stock -->
             <div>
                <label for="stock" class="block text-sm font-medium text-gray-500 mb-2v">
                    Stock <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="<?= htmlspecialchars($old['stock'] ?? '') ?>"
                    class="w-full px-4 py-2 bg-blue-600 text-white border border-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?= isset($errors['lastname']) ? 'border-red-500' : '' ?>"
                    required
                    maxlength="255">
                <?php if (isset($errors['stock'])): ?>
                    <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['stock']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-500 mb-2v">
                    Description
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full px-4 py-2 bg-blue-600 text-white border border-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent "><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
            </div>

            <!-- Platforme -->
             <div>
                <label for="platform" class="block text-sm font-medium text-gray-500 mb-2v">
                    Platforme <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="platform"
                    name="platform"
                    value="<?= htmlspecialchars($old['platform'] ?? '') ?>"
                    class="w-full px-4 py-2 bg-blue-600 text-white border border-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?= isset($errors['lastname']) ? 'border-red-500' : '' ?>"
                    required
                    maxlength="255">
                <?php if (isset($errors['platform'])): ?>
                    <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['platform']) ?></p>
                <?php endif; ?>
            </div>

            <!-- genre -->
             <div>
                <label for="brandname" class="block text-sm font-medium text-gray-500 mb-2v">
                    Genre <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="brandname"
                    name="brandname"
                    value="<?= htmlspecialchars($old['brandname'] ?? '') ?>"
                    class="w-full px-4 py-2 bg-blue-600 text-white border border-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?= isset($errors['lastname']) ? 'border-red-500' : '' ?>"
                    required
                    maxlength="255">
                <?php if (isset($errors['brandname'])): ?>
                    <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['brandname']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Media Upload (Optional) -->
            <div>
                <label for="media" class="block text-sm font-medium text-gray-500 mb-2v">
                    Images
                </label>
                <div class="space-y-4">
                    <div class="flex items-center justify-center w-full">
                        <label for="media" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Cliquez pour uploader</span> ou glissez-déposez
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WebP jusqu'à 10MB (max 10 fichiers)</p>
                            </div>
                            <input
                                type="file"
                                id="media"
                                name="media[]"
                                multiple
                                accept="image/jpeg,image/png,image/gif,image/webp"
                                class="hidden"
                                onchange="previewImages(this)">
                        </label>
                    </div>

                    <!-- Preview des images sélectionnées -->
                    <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-4 gap-4 hidden">
                        <!-- Les previews seront ajoutées ici par JavaScript -->
                    </div>
                </div>
            </div>

            <script>
                let fileIndex = 0;
                const fileMap = new Map(); // Map pour suivre les fichiers avec leurs index

                function previewImages(input) {
                    const preview = document.getElementById('imagePreview');

                    if (input.files && input.files.length > 0) {
                        preview.classList.remove('hidden');

                        // Réinitialiser la map et le preview
                        fileMap.clear();
                        preview.innerHTML = '';
                        fileIndex = 0;

                        Array.from(input.files).forEach((file) => {
                            if (file.type.startsWith('image/')) {
                                const currentIndex = fileIndex++;
                                fileMap.set(currentIndex, file);

                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const div = document.createElement('div');
                                    div.className = 'relative border border-gray-200 rounded-lg overflow-hidden';
                                    div.setAttribute('data-index', currentIndex);
                                    div.innerHTML = `
                                    <img src="${e.target.result}" alt="${file.name}" class="w-full h-32 object-cover">
                                    <button type="button" onclick="removeImage(${currentIndex})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                        ×
                                    </button>
                                    <p class="text-xs text-gray-600 p-1 truncate" title="${file.name}">${file.name}</p>
                                `;
                                    preview.appendChild(div);
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    } else {
                        preview.classList.add('hidden');
                        fileMap.clear();
                    }
                }

                function removeImage(index) {
                    const input = document.getElementById('media');
                    fileMap.delete(index);

                    // Reconstruire la liste des fichiers
                    const dt = new DataTransfer();
                    fileMap.forEach((file) => {
                        dt.items.add(file);
                    });
                    input.files = dt.files;

                    // Réafficher les previews
                    previewImages(input);
                }
            </script>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-800 to-green-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                    Créer
                </button>
                <a
                    href="/adminmodif"
                    class="w-full bg-gradient-to-r from-blue-800 to-red-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>